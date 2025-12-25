<script setup lang="ts">
import { ref, onMounted, nextTick, computed } from 'vue';
import { Head, usePage, router } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';
import { marked } from 'marked';

// Configure marked for safe rendering
marked.setOptions({
    breaks: true,
    gfm: true,
});

// Render markdown to HTML
const renderMarkdown = (text: string): string => {
    return marked.parse(text) as string;
};

interface Message {
    id: number;
    sender: 'user' | 'ai';
    message: string;
    created_at: string;
}

interface Session {
    id: string;
    title: string;
    created_at: string;
}

interface Props {
    sessions: Session[];
}

const props = defineProps<Props>();
const page = usePage();

const currentSession = ref<Session | null>(null);
const messages = ref<Message[]>([]);
const newMessage = ref('');
const isLoading = ref(false);
const chatContainer = ref<HTMLElement | null>(null);

const user = computed(() => (page.props.auth as any)?.user);
const isLoggedIn = computed(() => !!user.value);

// Create new session
const createSession = async () => {
    try {
        const response = await axios.post('/consultation/session');
        currentSession.value = response.data.session;
        messages.value = [];
        return true;
    } catch (error) {
        console.error('Failed to create session:', error);
        return false;
    }
};

// Load messages for a session
const loadMessages = async (session: Session) => {
    currentSession.value = session;
    try {
        const response = await axios.get(`/consultation/session/${session.id}/messages`);
        messages.value = response.data.messages;
        await nextTick();
        scrollToBottom();
    } catch (error) {
        console.error('Failed to load messages:', error);
    }
};

// Send message
const sendMessage = async () => {
    if (!newMessage.value.trim() || isLoading.value) return;

    // If not logged in, save prompt and redirect to login
    if (!isLoggedIn.value) {
        localStorage.setItem('pendingPrompt', newMessage.value);
        router.visit('/login');
        return;
    }

    // Create session if not exists
    if (!currentSession.value) {
        const created = await createSession();
        if (!created) return;
    }

    const messageText = newMessage.value;
    newMessage.value = '';
    isLoading.value = true;

    // Add user message immediately
    messages.value.push({
        id: Date.now(),
        sender: 'user',
        message: messageText,
        created_at: new Date().toISOString(),
    });

    await nextTick();
    scrollToBottom();

    try {
        const response = await axios.post(`/consultation/session/${currentSession.value!.id}/message`, {
            message: messageText,
        });

        // Replace temp message with real one and add AI response
        messages.value.pop();
        messages.value.push(response.data.user_message);
        messages.value.push(response.data.ai_message);

        await nextTick();
        scrollToBottom();
    } catch (error) {
        console.error('Failed to send message:', error);
        messages.value.pop();
        messages.value.push({
            id: Date.now(),
            sender: 'ai',
            message: 'Maaf, terjadi kesalahan. Silakan coba lagi.',
            created_at: new Date().toISOString(),
        });
    } finally {
        isLoading.value = false;
    }
};

const scrollToBottom = () => {
    if (chatContainer.value) {
        chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
    }
};

const handleKeydown = (e: KeyboardEvent) => {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
};

// Process pending prompt after login
const processPendingPrompt = async () => {
    const pendingPrompt = localStorage.getItem('pendingPrompt');
    if (pendingPrompt && isLoggedIn.value) {
        localStorage.removeItem('pendingPrompt');
        newMessage.value = pendingPrompt;
        
        // Auto submit after a short delay
        await nextTick();
        sendMessage();
    }
};

onMounted(async () => {
    if (isLoggedIn.value) {
        // Check for pending prompt first
        const pendingPrompt = localStorage.getItem('pendingPrompt');
        
        if (pendingPrompt) {
            // Create new session and process pending prompt
            await createSession();
            processPendingPrompt();
        } else if (props.sessions.length === 0) {
            await createSession();
        } else {
            await loadMessages(props.sessions[0]);
        }
    }
});
</script>

<template>
    <Head title="Konsultasi - DocDot" />

    <div class="min-h-screen" style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%)">
        <Navbar />

        <div class="flex h-[calc(100vh-80px)] flex-col px-6 pb-6 lg:px-12">
            <!-- Chat Messages Area -->
            <div 
                ref="chatContainer"
                class="flex-1 overflow-y-auto py-8"
            >
                <div class="mx-auto max-w-4xl space-y-6">
                    <!-- Welcome message if no messages -->
                    <div v-if="messages.length === 0" class="flex flex-col items-center justify-center py-20">
                        <h2 class="mb-2 text-2xl font-semibold text-[#1b1b18]">
                            Hallo{{ user?.name ? `, ${user.name}` : '' }}!
                        </h2>
                        <p class="text-[#1b1b18]/70">Ceritakan gejala atau keluhan kesehatan Anda</p>
                        <p v-if="!isLoggedIn" class="mt-2 text-sm text-[#1b1b18]/50">
                            Silakan login untuk memulai konsultasi
                        </p>
                    </div>

                    <!-- Messages -->
                    <template v-for="msg in messages" :key="msg.id">
                        <!-- User Message (right side with tail at top) -->
                        <div v-if="msg.sender === 'user'" class="flex justify-end">
                            <div class="relative max-w-[70%]">
                                <div class="rounded-2xl rounded-tr-md bg-[#8DD0FC]/50 px-5 py-4">
                                    <p class="text-[15px] text-[#1b1b18]">{{ msg.message }}</p>
                                </div>
                                <!-- Tail pointing right top -->
                                <div 
                                    class="absolute -right-2 top-0 h-4 w-4 bg-[#8DD0FC]/50"
                                    style="clip-path: polygon(0 0, 100% 0, 0 100%)"
                                ></div>
                            </div>
                        </div>

                        <!-- AI Message (left side with tail at top) -->
                        <div v-else class="flex justify-start">
                            <div class="relative max-w-[70%]">
                                <div class="rounded-2xl rounded-tl-md bg-[#DDB4F6]/50 px-5 py-4">
                                    <div 
                                        class="prose prose-sm max-w-none text-[15px] text-[#1b1b18] prose-p:my-2 prose-ul:my-2 prose-ol:my-2 prose-li:my-0.5 prose-headings:text-[#1b1b18] prose-strong:text-[#1b1b18] prose-em:text-[#1b1b18]"
                                        v-html="renderMarkdown(msg.message)"
                                    ></div>
                                    <!-- Disclaimer -->
                                    <div class="mt-3 border-t border-[#1b1b18]/10 pt-2">
                                        <p class="flex items-center gap-1.5 text-[11px] italic text-[#1b1b18]/60">
                                            <Icon icon="mdi:information-outline" class="h-3.5 w-3.5 flex-shrink-0" />
                                            <span>Informasi ini hanya sebagai referensi dan tidak menggantikan konsultasi dengan dokter profesional.</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- Tail pointing left top -->
                                <div 
                                    class="absolute -left-2 top-0 h-4 w-4 bg-[#DDB4F6]/50"
                                    style="clip-path: polygon(0 0, 100% 0, 100% 100%)"
                                ></div>
                            </div>
                        </div>
                    </template>

                    <!-- Loading indicator -->
                    <div v-if="isLoading" class="flex justify-start">
                        <div class="relative">
                            <div class="rounded-2xl rounded-tl-md bg-[#DDB4F6]/50 px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="h-2 w-2 animate-bounce rounded-full bg-[#1b1b18]/50" style="animation-delay: 0ms"></div>
                                    <div class="h-2 w-2 animate-bounce rounded-full bg-[#1b1b18]/50" style="animation-delay: 150ms"></div>
                                    <div class="h-2 w-2 animate-bounce rounded-full bg-[#1b1b18]/50" style="animation-delay: 300ms"></div>
                                </div>
                            </div>
                            <!-- Tail pointing left top -->
                            <div 
                                class="absolute -left-2 top-0 h-4 w-4 bg-[#DDB4F6]/50"
                                style="clip-path: polygon(0 0, 100% 0, 100% 100%)"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="mx-auto w-full max-w-4xl">
                <div class="rounded-2xl bg-white p-4 shadow-lg">
                    <div class="mb-3">
                        <textarea
                            v-model="newMessage"
                            @keydown="handleKeydown"
                            placeholder="Type your symptoms here..."
                            rows="2"
                            class="w-full resize-none border-none bg-transparent text-[15px] text-[#1b1b18] placeholder-[#1b1b18]/50 focus:outline-none"
                        ></textarea>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button class="flex items-center gap-2 text-[13px] text-[#1b1b18]/70 transition-colors hover:text-[#1b1b18]">
                                <Icon icon="mdi:magnify" class="h-5 w-5" />
                                Identify your symptoms
                            </button>
                            <button class="flex items-center gap-2 text-[13px] text-[#1b1b18]/70 transition-colors hover:text-[#1b1b18]">
                                <Icon icon="mdi:image-plus" class="h-5 w-5" />
                                Consult by uploading a photo of your condition
                            </button>
                        </div>
                        
                        <button 
                            @click="sendMessage"
                            :disabled="!newMessage.trim() || isLoading"
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] transition-opacity hover:opacity-90 disabled:opacity-50"
                        >
                            <Icon icon="mdi:send" class="h-5 w-5 text-white" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
