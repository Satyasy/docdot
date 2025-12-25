<script setup lang="ts">
import { ref, onMounted, nextTick, computed, watch } from 'vue';
import { Head, usePage, router } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import axios from 'axios';
import { marked } from 'marked';
import { useScrollAnimation } from '@/composables/useScrollAnimation';

useScrollAnimation();

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
const showChatMode = ref(false);

const user = computed(() => (page.props.auth as any)?.user);
const isLoggedIn = computed(() => !!user.value);

// Watch for messages to switch to chat mode
watch(messages, (newMessages) => {
    if (newMessages.length > 0) {
        showChatMode.value = true;
    }
}, { deep: true });

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
        if (response.data.messages.length > 0) {
            showChatMode.value = true;
        }
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
    showChatMode.value = true;

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

// Start new consultation
const startNewChat = () => {
    showChatMode.value = true;
};

// Process pending prompt after login
const processPendingPrompt = async () => {
    const pendingPrompt = localStorage.getItem('pendingPrompt');
    if (pendingPrompt && isLoggedIn.value) {
        localStorage.removeItem('pendingPrompt');
        newMessage.value = pendingPrompt;
        showChatMode.value = true;
        
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

        <!-- Landing Mode: Show when no messages and not in chat mode -->
        <div v-if="!showChatMode" class="overflow-x-hidden">
            <!-- Hero Section -->
            <section class="relative overflow-hidden px-6 pt-8 lg:px-12">
                <!-- Background gradient blob -->
                <div class="absolute top-20 left-1/2 -translate-x-1/2 h-[500px] w-[800px] rounded-full bg-gradient-to-r from-[#8DD0FC]/30 via-[#DDB4F6]/20 to-[#F4AFE9]/30 blur-3xl"></div>

                <div class="relative z-10 mx-auto max-w-4xl pt-16 text-center">
                    <!-- Floating card top right -->
                    <div class="scroll-animate absolute top-4 -right-40 hidden rounded-full bg-white px-6 py-3 text-[16px] font-normal shadow-lg lg:block">
                        Ayo mulai sekarang!
                    </div>

                    <h1 class="scroll-animate text-[36px] font-semibold leading-tight text-[#1b1b18] lg:text-[56px]">
                        Get trusted insights about your<br />symptoms with <span style="background: linear-gradient(to right, #C360FF 0%, #54BBFF 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">DocDot</span>
                    </h1>

                    <p class="scroll-animate scroll-animate-delay-1 mt-6 text-[18px] font-light text-[#1b1b18]/80 lg:text-[20px]">
                        Describe what you're feeling, DocDot will help decode it for you.
                    </p>

                    <!-- Floating card left -->
                    <div class="scroll-animate absolute bottom-50 -left-50 hidden rounded-xl bg-white px-5 py-3 shadow-lg lg:block">
                        <p class="text-[14px] font-semibold text-[#1b1b18]">Konsultasi Sekarang! 🌟 9.10</p>
                    </div>

                    <!-- Get Started Button -->
                    <button 
                        @click="startNewChat"
                        class="scroll-animate scroll-animate-delay-2 mt-8 inline-flex items-center gap-2 rounded-full border-2 border-[#1b1b18] px-8 py-3 text-[18px] font-medium text-[#1b1b18] transition-colors hover:bg-[#1b1b18] hover:text-white"
                    >
                        Get Started
                        <Icon icon="mdi:arrow-right" class="h-5 w-5" />
                    </button>

                    <!-- Chat Input Box with gradient border -->
                    <div class="scroll-animate scroll-animate-delay-3 mx-auto mt-12 w-full max-w-[600px] overflow-hidden rounded-xl p-[2px]" style="background: linear-gradient(to left, #8DD0FC 0%, #DDB4F6 100%);">
                        <div class="overflow-hidden rounded-xl bg-white px-6 py-4">
                            <input 
                                v-model="newMessage"
                                @keydown="handleKeydown"
                                type="text" 
                                placeholder="Type your symptoms here..."
                                class="w-full border-none bg-transparent text-[16px] text-[#1b1b18] placeholder-[#1b1b18]/40 outline-none focus:outline-none focus:ring-0"
                            />
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex flex-wrap items-center gap-4">
                                    <button class="flex items-center gap-2 text-[13px] text-[#54BBFF]">
                                        <Icon icon="mdi:auto-fix" class="h-4 w-4" />
                                        Identify your symptoms
                                    </button>
                                    <button class="hidden items-center gap-2 text-[13px] text-[#1b1b18]/60 sm:flex">
                                        <Icon icon="mdi:image-outline" class="h-4 w-4" />
                                        Consult by uploading a photo
                                    </button>
                                </div>
                                <button 
                                    @click="sendMessage"
                                    :disabled="!newMessage.trim()"
                                    class="flex h-8 w-8 items-center justify-center text-[#54BBFF] transition-colors hover:text-[#43A8E8] disabled:opacity-50"
                                >
                                    <Icon icon="mdi:send" class="h-5 w-5" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- How does it work Section -->
            <section class="relative px-6 py-8 lg:px-12 mt-30">
                <div class="scroll-animate mx-auto max-w-6xl overflow-visible rounded-[30px] px-8 pb-16 pt-8 lg:px-16" style="background: rgba(255, 255, 255, 0.4);">
                    <h2 class="mb-8 text-center text-[28px] font-semibold text-[#1b1b18] lg:text-[36px]">How does it work?</h2>
                    
                    <div class="flex flex-col items-center justify-center gap-8 lg:flex-row lg:items-start">
                        <!-- Card 1 -->
                        <div class="scroll-animate scroll-animate-delay-1 h-auto min-h-[280px] w-full max-w-[260px] overflow-hidden rounded-[20px] bg-white p-6 text-center shadow-sm lg:mt-8 lg:h-[300px]">
                            <Icon icon="mingcute:search-line" class="mx-auto mb-4 h-10 w-10 text-[#9EC9FB]" />
                            <h3 class="mb-3 text-[16px] font-semibold text-[#1b1b18]">Input Gejala atau Pertanyaan</h3>
                            <p class="text-[13px] leading-relaxed text-[#1b1b18]/70">
                                Pengguna cukup mengetik keluhan atau pertanyaan kesehatan, misalnya "sakit kepala", "demam sejak kemarin", atau "tips pola makan sehat untuk remaja."
                            </p>
                        </div>

                        <!-- Card 2 (higher) -->
                        <div class="scroll-animate scroll-animate-delay-2 h-auto min-h-[280px] w-full max-w-[260px] overflow-hidden rounded-[20px] bg-white p-6 text-center shadow-sm lg:-mt-4 lg:h-[300px]">
                            <Icon icon="mage:robot-wink" class="mx-auto mb-4 h-10 w-10 text-[#9EC9FB]" />
                            <h3 class="mb-3 text-[16px] font-semibold text-[#1b1b18]">Analisis dengan AI Medis</h3>
                            <p class="text-[13px] leading-relaxed text-[#1b1b18]/70">
                                DocDot memproses input dengan teknologi AI, membandingkan dengan data medis terpercaya, lalu memberikan informasi seputar kemungkinan penyebab, tips perawatan awal, dan rekomendasi gaya hidup.
                            </p>
                        </div>

                        <!-- Card 3 -->
                        <div class="scroll-animate scroll-animate-delay-3 h-auto min-h-[280px] w-full max-w-[260px] overflow-hidden rounded-[20px] bg-white p-6 text-center shadow-sm lg:mt-8 lg:h-[300px]">
                            <Icon icon="mdi:clipboard-text-outline" class="mx-auto mb-4 h-10 w-10 text-[#CCBAF8]" />
                            <h3 class="mb-3 text-[16px] font-semibold text-[#1b1b18]">Saran & Rekomendasi Lanjutan</h3>
                            <p class="text-[13px] leading-relaxed text-[#1b1b18]/70">
                                DocDot menampilkan hasil analisis dalam bahasa yang mudah dipahami. Jika gejala serius, chatbot akan menyarankan pengguna untuk segera berkonsultasi dengan tenaga medis profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonial Section -->
            <section class="mt-16 w-full py-12 mb-16" style="background: rgba(255, 255, 255, 0.3);">
                <div class="px-6 lg:px-12">
                    <h2 class="scroll-animate mb-10 text-left text-[28px] font-semibold text-[#1b1b18] lg:text-[32px]">
                        Testimonial dari Pengguna <span class="text-[#54BBFF]">DocDot</span>
                    </h2>
                    
                    <div class="scroll-animate scroll-animate-delay-1 flex flex-col justify-between gap-6 lg:flex-row">
                        <!-- Card 1 -->
                        <div class="flex-1 rounded-[20px] bg-[#FAF1FF] p-6">
                            <div class="mb-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/48?img=11" class="h-12 w-12 rounded-full object-cover" />
                                    <div>
                                        <p class="text-[16px] font-semibold text-[#1b1b18]">Andi Pratama</p>
                                        <p class="text-[12px] text-[#1b1b18]/60">@andipratama</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                </div>
                            </div>
                            <p class="text-[14px] leading-relaxed text-[#1b1b18]/80">
                                DocDot sangat membantu saya memahami gejala yang saya rasakan. Penjelasannya detail dan mudah dipahami, plus selalu mengingatkan untuk konsultasi ke dokter jika perlu.
                            </p>
                        </div>

                        <!-- Card 2 -->
                        <div class="flex-1 rounded-[20px] bg-[#FAF1FF] p-6">
                            <div class="mb-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/48?img=12" class="h-12 w-12 rounded-full object-cover" />
                                    <div>
                                        <p class="text-[16px] font-semibold text-[#1b1b18]">Siti Rahayu</p>
                                        <p class="text-[12px] text-[#1b1b18]/60">@sitirahayu</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                </div>
                            </div>
                            <p class="text-[14px] leading-relaxed text-[#1b1b18]/80">
                                Sebagai ibu rumah tangga, DocDot sangat berguna untuk mendapat informasi awal tentang kesehatan keluarga. Responnya cepat dan informatif!
                            </p>
                        </div>

                        <!-- Card 3 -->
                        <div class="flex-1 rounded-[20px] bg-[#FAF1FF] p-6">
                            <div class="mb-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/48?img=13" class="h-12 w-12 rounded-full object-cover" />
                                    <div>
                                        <p class="text-[16px] font-semibold text-[#1b1b18]">Budi Santoso</p>
                                        <p class="text-[12px] text-[#1b1b18]/60">@budisantoso</p>
                                    </div>
                                </div>
                                <div class="flex gap-1">
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star" class="h-4 w-4 text-[#FFD700]" />
                                    <Icon icon="mdi:star-half-full" class="h-4 w-4 text-[#FFD700]" />
                                </div>
                            </div>
                            <p class="text-[14px] leading-relaxed text-[#1b1b18]/80">
                                Fitur konsultasi 24 jam sangat membantu ketika butuh informasi kesehatan di malam hari. Terima kasih DocDot!
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <Footer />
        </div>

        <!-- Chat Mode: Show when in chat mode -->
        <div v-else class="flex h-[calc(100vh-80px)] flex-col px-6 pb-6 lg:px-12">
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
                        <div class="flex flex-wrap items-center gap-4">
                            <button class="flex items-center gap-2 text-[13px] text-[#1b1b18]/70 transition-colors hover:text-[#1b1b18]">
                                <Icon icon="mdi:magnify" class="h-5 w-5" />
                                Identify your symptoms
                            </button>
                            <button class="hidden items-center gap-2 text-[13px] text-[#1b1b18]/70 transition-colors hover:text-[#1b1b18] sm:flex">
                                <Icon icon="mdi:image-plus" class="h-5 w-5" />
                                Upload photo
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
