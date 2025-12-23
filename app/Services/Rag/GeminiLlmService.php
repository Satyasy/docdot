<?php

namespace App\Services\Rag;

use App\Contracts\LlmServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiLlmService implements LlmServiceInterface
{
    private string $apiKey;
    private string $model;
    private string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta';
    private int $maxContextLength = 30720; // ~30k tokens for Gemini 1.5 Flash

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->model = config('services.gemini.llm_model', 'gemini-1.5-flash');
    }

    /**
     * Generate a response from the LLM
     */
    public function generate(string $prompt, ?string $systemPrompt = null, array $history = []): string
    {
        $contents = [];

        // Add conversation history
        foreach ($history as $message) {
            $contents[] = [
                'role' => $message['role'] === 'assistant' ? 'model' : 'user',
                'parts' => [['text' => $message['content']]],
            ];
        }

        // Add current prompt
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $prompt]],
        ];

        $payload = [
            'contents' => $contents,
            'generationConfig' => [
                'temperature' => 0.7,
                'topK' => 40,
                'topP' => 0.95,
                'maxOutputTokens' => 2048,
            ],
        ];

        // Add system instruction if provided
        if ($systemPrompt) {
            $payload['systemInstruction'] = [
                'parts' => [['text' => $systemPrompt]],
            ];
        }

        // Add safety settings
        $payload['safetySettings'] = [
            ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_ONLY_HIGH'],
            ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_ONLY_HIGH'],
            ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_ONLY_HIGH'],
            ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_ONLY_HIGH'],
        ];

        try {
            $response = Http::withOptions(['verify' => false])
                ->timeout(60)
                ->retry(3, 1000)
                ->withQueryParameters(['key' => $this->apiKey])
                ->post("{$this->baseUrl}/models/{$this->model}:generateContent", $payload);

            if ($response->failed()) {
                Log::error('Gemini LLM API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                throw new \RuntimeException('Gemini API request failed: ' . $response->body());
            }

            $result = $response->json();
            
            return $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
        } catch (\Exception $e) {
            Log::error('Gemini LLM exception', [
                'message' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Generate a response with context from retrieved documents
     */
    public function generateWithContext(string $query, array $contexts, ?string $systemPrompt = null): string
    {
        $contextText = implode("\n\n---\n\n", $contexts);

        $defaultSystemPrompt = <<<PROMPT
Kamu adalah asisten kesehatan AI yang membantu menjawab pertanyaan berdasarkan dokumen medis yang tersedia.

INSTRUKSI PENTING:
1. Jawab HANYA berdasarkan konteks yang diberikan
2. Jika informasi tidak ada dalam konteks, katakan dengan jujur bahwa kamu tidak menemukan informasi tersebut
3. Berikan jawaban dalam Bahasa Indonesia yang mudah dipahami
4. Jika ada informasi medis penting, sarankan untuk konsultasi dengan profesional kesehatan
5. Jangan membuat informasi atau diagnosis medis sendiri

KONTEKS DOKUMEN:
{$contextText}
PROMPT;

        $finalSystemPrompt = $systemPrompt ?? $defaultSystemPrompt;

        return $this->generate($query, $finalSystemPrompt);
    }

    /**
     * Stream a response (for real-time output)
     */
    public function stream(string $prompt, ?string $systemPrompt = null, callable $onChunk = null): void
    {
        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [['text' => $prompt]],
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'topK' => 40,
                'topP' => 0.95,
                'maxOutputTokens' => 2048,
            ],
        ];

        if ($systemPrompt) {
            $payload['systemInstruction'] = [
                'parts' => [['text' => $systemPrompt]],
            ];
        }

        try {
            $response = Http::withOptions(['verify' => false, 'stream' => true])
                ->timeout(120)
                ->withQueryParameters(['key' => $this->apiKey])
                ->post("{$this->baseUrl}/models/{$this->model}:streamGenerateContent", $payload);

            $body = $response->getBody();

            while (!$body->eof()) {
                $line = $body->read(1024);
                
                if ($onChunk && !empty($line)) {
                    // Parse SSE data
                    if (preg_match('/\"text\":\s*\"([^\"]+)\"/', $line, $matches)) {
                        $onChunk($matches[1]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Gemini stream exception', [
                'message' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Count tokens in text (approximate)
     */
    public function countTokens(string $text): int
    {
        try {
            $response = Http::withOptions(['verify' => false])
                ->timeout(30)
                ->withQueryParameters(['key' => $this->apiKey])
                ->post("{$this->baseUrl}/models/{$this->model}:countTokens", [
                    'contents' => [
                        [
                            'parts' => [['text' => $text]]
                        ]
                    ]
                ]);

            if ($response->successful()) {
                return $response->json()['totalTokens'] ?? 0;
            }
        } catch (\Exception $e) {
            Log::warning('Token count failed, using estimate', [
                'message' => $e->getMessage(),
            ]);
        }

        // Fallback: rough estimate (1 token ≈ 4 chars for English, ~2.5 for Indonesian)
        return (int) ceil(strlen($text) / 3);
    }

    /**
     * Get the model name
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * Get maximum context length
     */
    public function getMaxContextLength(): int
    {
        return $this->maxContextLength;
    }

    /**
     * Generate structured JSON response
     */
    public function generateJson(string $prompt, array $schema, ?string $systemPrompt = null): array
    {
        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [['text' => $prompt]],
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.3,
                'topK' => 40,
                'topP' => 0.95,
                'maxOutputTokens' => 2048,
                'responseMimeType' => 'application/json',
                'responseSchema' => $schema,
            ],
        ];

        if ($systemPrompt) {
            $payload['systemInstruction'] = [
                'parts' => [['text' => $systemPrompt]],
            ];
        }

        try {
            $response = Http::withOptions(['verify' => false])
                ->timeout(60)
                ->retry(3, 1000)
                ->withQueryParameters(['key' => $this->apiKey])
                ->post("{$this->baseUrl}/models/{$this->model}:generateContent", $payload);

            if ($response->failed()) {
                throw new \RuntimeException('Gemini API request failed: ' . $response->body());
            }

            $result = $response->json();
            $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? '{}';

            return json_decode($text, true) ?? [];
        } catch (\Exception $e) {
            Log::error('Gemini JSON generation exception', [
                'message' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
