<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { ref, computed, watch } from 'vue';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';

interface Session {
    id: string;
    title: string;
    created_at: string;
    updated_at: string;
    messages_count: number;
}

interface PaginatedSessions {
    data: Session[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    links: Array<{ url: string | null; label: string; active: boolean }>;
}

interface Props {
    sessions: PaginatedSessions;
    stats: {
        total_sessions: number;
        total_messages: number;
        this_month_sessions: number;
    };
    filters: {
        search: string;
        date: string;
    };
}

const props = defineProps<Props>();

const searchQuery = ref(props.filters.search);
const dateFilter = ref(props.filters.date);
const showDeleteModal = ref(false);
const sessionToDelete = ref<Session | null>(null);
const isDeleting = ref(false);

// Debounced search
let searchTimeout: ReturnType<typeof setTimeout>;
watch(searchQuery, (value) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        applyFilters();
    }, 500);
});

watch(dateFilter, () => {
    applyFilters();
});

const applyFilters = () => {
    router.get('/chat-history', {
        search: searchQuery.value || undefined,
        date: dateFilter.value || undefined,
    }, {
        preserveState: true,
        preserveScroll: true,
    });
};

const clearFilters = () => {
    searchQuery.value = '';
    dateFilter.value = '';
    router.get('/chat-history');
};

const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    });
};

const formatTime = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
    });
};

const getRelativeTime = (dateString: string) => {
    const date = new Date(dateString);
    const now = new Date();
    const diffMs = now.getTime() - date.getTime();
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);

    if (diffMins < 1) return 'Baru saja';
    if (diffMins < 60) return `${diffMins} menit yang lalu`;
    if (diffHours < 24) return `${diffHours} jam yang lalu`;
    if (diffDays < 7) return `${diffDays} hari yang lalu`;
    return formatDate(dateString);
};

const confirmDelete = (session: Session) => {
    sessionToDelete.value = session;
    showDeleteModal.value = true;
};

const deleteSession = async () => {
    if (!sessionToDelete.value) return;
    
    isDeleting.value = true;
    try {
        await fetch(`/consultation/session/${sessionToDelete.value.id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            },
        });
        
        router.reload({ only: ['sessions', 'stats'] });
        showDeleteModal.value = false;
        sessionToDelete.value = null;
    } catch (error) {
        console.error('Error deleting session:', error);
    } finally {
        isDeleting.value = false;
    }
};

const hasFilters = computed(() => searchQuery.value || dateFilter.value);
</script>

<template>
    <Head title="Riwayat Chat" />
    <div class="min-h-screen overflow-x-hidden" style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%);">
        <Navbar />

        <!-- Hero Section -->
        <section class="px-6 pt-12 pb-8 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <!-- Breadcrumb -->
                <nav class="mb-6 flex items-center gap-2 text-[14px]">
                    <Link href="/" class="text-[#1b1b18]/60 hover:text-[#1b1b18]">Beranda</Link>
                    <Icon icon="mdi:chevron-right" class="h-4 w-4 text-[#1b1b18]/40" />
                    <span class="text-[#1b1b18]">Riwayat Chat</span>
                </nav>

                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h1 class="text-[32px] font-bold text-[#1b1b18] lg:text-[42px]" style="font-style: italic;">
                            Riwayat <span class="bg-gradient-to-r from-[#BF55FF] to-[#43B3FC] bg-clip-text text-transparent">Konsultasi</span>
                        </h1>
                        <p class="mt-2 text-[16px] text-[#1b1b18]/70">
                            Lihat kembali semua sesi konsultasi kesehatan Anda
                        </p>
                    </div>
                    <Link 
                        href="/consultation"
                        class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-6 py-3 text-[14px] font-medium text-white shadow-lg transition-all hover:shadow-xl hover:scale-[1.02]"
                    >
                        <Icon icon="mdi:plus" class="h-5 w-5" />
                        Konsultasi Baru
                    </Link>
                </div>
            </div>
        </section>

        <!-- Stats Cards -->
        <section class="px-6 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Total Sessions -->
                    <div class="rounded-xl bg-white/70 p-5 backdrop-blur-sm">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC]">
                                <Icon icon="mdi:message-text-outline" class="h-6 w-6 text-white" />
                            </div>
                            <div>
                                <p class="text-[24px] font-bold text-[#1b1b18]">{{ stats.total_sessions }}</p>
                                <p class="text-[13px] text-[#1b1b18]/60">Total Sesi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Messages -->
                    <div class="rounded-xl bg-white/70 p-5 backdrop-blur-sm">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-r from-[#8DD0FC] to-[#43B3FC]">
                                <Icon icon="mdi:chat-processing-outline" class="h-6 w-6 text-white" />
                            </div>
                            <div>
                                <p class="text-[24px] font-bold text-[#1b1b18]">{{ stats.total_messages }}</p>
                                <p class="text-[13px] text-[#1b1b18]/60">Total Pesan</p>
                            </div>
                        </div>
                    </div>

                    <!-- This Month -->
                    <div class="rounded-xl bg-white/70 p-5 backdrop-blur-sm sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#FF7CEA]">
                                <Icon icon="mdi:calendar-month" class="h-6 w-6 text-white" />
                            </div>
                            <div>
                                <p class="text-[24px] font-bold text-[#1b1b18]">{{ stats.this_month_sessions }}</p>
                                <p class="text-[13px] text-[#1b1b18]/60">Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filters & Content -->
        <section class="px-6 py-8 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <!-- Filters -->
                <div class="mb-6 flex flex-col gap-4 rounded-xl bg-white p-4 sm:flex-row sm:items-center">
                    <!-- Search -->
                    <div class="relative flex-1">
                        <Icon icon="mdi:magnify" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-[#1b1b18]/40" />
                        <input 
                            v-model="searchQuery"
                            type="text"
                            placeholder="Cari berdasarkan judul..."
                            class="w-full rounded-lg border border-[#1b1b18]/10 bg-[#F8F8F8] py-3 pl-12 pr-4 text-[14px] outline-none focus:border-[#8DD0FC] focus:ring-0"
                        />
                    </div>

                    <!-- Date Filter -->
                    <div class="relative">
                        <Icon icon="mdi:calendar" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-[#1b1b18]/40" />
                        <input 
                            v-model="dateFilter"
                            type="date"
                            class="rounded-lg border border-[#1b1b18]/10 bg-[#F8F8F8] py-3 pl-12 pr-4 text-[14px] outline-none focus:border-[#8DD0FC] focus:ring-0"
                        />
                    </div>

                    <!-- Clear Filters -->
                    <button 
                        v-if="hasFilters"
                        @click="clearFilters"
                        class="flex items-center gap-2 rounded-lg border border-[#1b1b18]/10 px-4 py-3 text-[14px] text-[#1b1b18]/70 transition-colors hover:bg-[#F8F8F8]"
                    >
                        <Icon icon="mdi:filter-off" class="h-5 w-5" />
                        Reset
                    </button>
                </div>

                <!-- Sessions List -->
                <div v-if="sessions.data.length > 0" class="space-y-4">
                    <div 
                        v-for="session in sessions.data" 
                        :key="session.id"
                        class="group overflow-hidden rounded-xl bg-white transition-all hover:shadow-lg"
                    >
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <!-- Content -->
                            <Link 
                                :href="`/consultation?session=${session.id}`"
                                class="flex-1 p-5"
                            >
                                <div class="flex items-start gap-4">
                                    <!-- Icon -->
                                    <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-[#F4AFE9]/20 to-[#8DD0FC]/20">
                                        <Icon icon="mdi:message-text" class="h-5 w-5 text-[#8DD0FC]" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="mb-1 truncate text-[16px] font-semibold text-[#1b1b18] group-hover:text-[#43B3FC]">
                                            {{ session.title }}
                                        </h3>
                                        <div class="flex flex-wrap items-center gap-3 text-[12px] text-[#1b1b18]/60">
                                            <span class="flex items-center gap-1">
                                                <Icon icon="mdi:clock-outline" class="h-4 w-4" />
                                                {{ getRelativeTime(session.updated_at) }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <Icon icon="mdi:message-outline" class="h-4 w-4" />
                                                {{ session.messages_count }} pesan
                                            </span>
                                            <span class="hidden items-center gap-1 sm:flex">
                                                <Icon icon="mdi:calendar-outline" class="h-4 w-4" />
                                                {{ formatDate(session.created_at) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </Link>

                            <!-- Actions -->
                            <div class="flex items-center gap-2 border-t border-[#1b1b18]/5 px-5 py-3 sm:border-l sm:border-t-0">
                                <Link 
                                    :href="`/consultation?session=${session.id}`"
                                    class="flex items-center gap-2 rounded-lg bg-gradient-to-r from-[#F4AFE9]/10 to-[#8DD0FC]/10 px-4 py-2 text-[13px] font-medium text-[#1b1b18] transition-colors hover:from-[#F4AFE9]/20 hover:to-[#8DD0FC]/20"
                                >
                                    <Icon icon="mdi:eye-outline" class="h-4 w-4" />
                                    Lihat
                                </Link>
                                <button 
                                    @click="confirmDelete(session)"
                                    class="flex items-center gap-2 rounded-lg px-4 py-2 text-[13px] font-medium text-red-500 transition-colors hover:bg-red-50"
                                >
                                    <Icon icon="mdi:delete-outline" class="h-4 w-4" />
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="rounded-xl bg-white py-16 text-center">
                    <Icon icon="mdi:message-text-clock-outline" class="mx-auto h-20 w-20 text-[#1b1b18]/20" />
                    <h3 class="mt-4 text-[20px] font-semibold text-[#1b1b18]">
                        {{ hasFilters ? 'Tidak ada hasil' : 'Belum Ada Riwayat' }}
                    </h3>
                    <p class="mt-2 text-[14px] text-[#1b1b18]/60">
                        {{ hasFilters ? 'Coba ubah filter pencarian Anda.' : 'Mulai konsultasi pertama Anda sekarang!' }}
                    </p>
                    <Link 
                        v-if="!hasFilters"
                        href="/consultation"
                        class="mt-6 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-6 py-3 text-[14px] font-medium text-white"
                    >
                        <Icon icon="mdi:plus" class="h-5 w-5" />
                        Mulai Konsultasi
                    </Link>
                    <button 
                        v-else
                        @click="clearFilters"
                        class="mt-6 inline-flex items-center gap-2 rounded-full border border-[#1b1b18]/20 px-6 py-3 text-[14px] font-medium text-[#1b1b18]"
                    >
                        <Icon icon="mdi:filter-off" class="h-5 w-5" />
                        Reset Filter
                    </button>
                </div>

                <!-- Pagination -->
                <div v-if="sessions.last_page > 1" class="mt-8 flex justify-center gap-2">
                    <template v-for="link in sessions.links" :key="link.label">
                        <Link 
                            v-if="link.url"
                            :href="link.url"
                            :class="[
                                'flex h-10 w-10 items-center justify-center rounded-full text-[14px] transition-all',
                                link.active 
                                    ? 'bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] text-white' 
                                    : 'bg-white text-[#1b1b18] hover:bg-[#F0F0F0]'
                            ]"
                            v-html="link.label"
                            preserve-scroll
                        />
                        <span 
                            v-else
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-white/50 text-[14px] text-[#1b1b18]/40"
                            v-html="link.label"
                        />
                    </template>
                </div>
            </div>
        </section>

        <!-- Delete Confirmation Modal -->
        <Teleport to="body">
            <div 
                v-if="showDeleteModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                @click.self="showDeleteModal = false"
            >
                <div class="w-full max-w-md rounded-xl bg-white p-6">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                        <Icon icon="mdi:alert-circle" class="h-6 w-6 text-red-500" />
                    </div>
                    <h3 class="text-[18px] font-semibold text-[#1b1b18]">Hapus Sesi Konsultasi?</h3>
                    <p class="mt-2 text-[14px] text-[#1b1b18]/70">
                        Sesi "{{ sessionToDelete?.title }}" akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                    </p>
                    <div class="mt-6 flex gap-3">
                        <button 
                            @click="showDeleteModal = false"
                            class="flex-1 rounded-lg border border-[#1b1b18]/20 py-3 text-[14px] font-medium text-[#1b1b18] transition-colors hover:bg-[#F8F8F8]"
                        >
                            Batal
                        </button>
                        <button 
                            @click="deleteSession"
                            :disabled="isDeleting"
                            class="flex flex-1 items-center justify-center gap-2 rounded-lg bg-red-500 py-3 text-[14px] font-medium text-white transition-colors hover:bg-red-600 disabled:opacity-50"
                        >
                            <Icon v-if="isDeleting" icon="mdi:loading" class="h-5 w-5 animate-spin" />
                            {{ isDeleting ? 'Menghapus...' : 'Hapus' }}
                        </button>
                    </div>
                </div>
            </div>
        </Teleport>

        <Footer />
    </div>
</template>
