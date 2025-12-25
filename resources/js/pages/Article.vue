<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import { Icon } from '@iconify/vue';
import { ref, watch } from 'vue';
import { useScrollAnimation } from '@/composables/useScrollAnimation';

useScrollAnimation();

interface Article {
    id: number;
    title: string;
    slug: string;
    content: string;
    category: string;
    source: string | null;
    published_at: string;
}

interface PaginatedArticles {
    data: Article[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    links: { url: string | null; label: string; active: boolean }[];
}

interface Props {
    articles: PaginatedArticles;
    featuredArticle: Article | null;
    popularArticles: Article[];
    categories: Record<string, number>;
    currentCategory: string | null;
    searchQuery: string | null;
}

const props = defineProps<Props>();

const searchInput = ref(props.searchQuery || '');
const selectedCategory = ref(props.currentCategory || '');

const allCategories = [
    'Berita & Update Kesehatan',
    'Edukasi Kesehatan',
    'Tips & Gaya Hidup Sehat',
    'Pencegahan & Perawatan',
];

const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    });
};

const getCategoryColor = (category: string) => {
    const colors: Record<string, string> = {
        'Berita & Update Kesehatan': 'from-[#F4AFE9] to-[#8DD0FC]',
        'Edukasi Kesehatan': 'bg-[#FF7CEA]',
        'Tips & Gaya Hidup Sehat': 'from-[#8DD0FC] to-[#43B3FC]',
        'Pencegahan & Perawatan': 'from-[#DDB4F6] to-[#F4AFE9]',
    };
    return colors[category] || 'from-[#F4AFE9] to-[#8DD0FC]';
};

const truncateContent = (content: string, length: number = 150) => {
    const stripped = content.replace(/<[^>]*>/g, '');
    return stripped.length > length ? stripped.substring(0, length) + '...' : stripped;
};

const filterByCategory = (category: string) => {
    selectedCategory.value = category;
    router.get('/article', {
        category: category || undefined,
        search: searchInput.value || undefined,
    }, {
        preserveState: true,
        preserveScroll: true,
    });
};

const handleSearch = () => {
    router.get('/article', {
        category: selectedCategory.value || undefined,
        search: searchInput.value || undefined,
    }, {
        preserveState: true,
        preserveScroll: true,
    });
};

const handleSearchKeydown = (e: KeyboardEvent) => {
    if (e.key === 'Enter') {
        handleSearch();
    }
};
</script>

<template>
    <Head title="Article" />
    <div class="min-h-screen overflow-x-hidden" style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%);">
        <Navbar />

        <!-- Hero Section -->
        <section class="relative px-6 pt-16 pb-12 lg:px-12">
            <!-- Floating badge left -->
            <div class="absolute top-52 left-24 z-10 hidden rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-6 py-2 text-[14px] font-medium text-white lg:block">
                DocDot
            </div>

            <!-- Floating badge right -->
            <div class="absolute top-32 right-24 z-10 hidden rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-6 py-2 text-[14px] font-medium text-white lg:block">
                DocDot
            </div>

            <div class="mx-auto max-w-4xl text-center">
                <h1 class="scroll-animate text-[36px] font-semibold leading-tight text-[#1b1b18] lg:text-[56px]">
                    Cara lebih baik untuk belajar<br />soal <span style="background: linear-gradient(to right, #BF55FF 0%, #43B3FC 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">kesehatan</span>, setiap hari
                </h1>

                <p class="mt-6 text-[16px] font-light text-[#1b1b18]/80 lg:text-[20px]">
                    Temukan jawaban dan wawasan seputar kesehatan di artikel-artikel<br class="hidden lg:block" />pilihan kami. Singkat, jelas, terpercaya!
                </p>

                <!-- Search Box -->
                <div class="mx-auto mt-10 w-full max-w-[550px] overflow-hidden rounded-full border border-[#E0E0E0] bg-white px-6 py-3 lg:mt-16">
                    <div class="flex items-center justify-between">
                        <input 
                            v-model="searchInput"
                            @keydown="handleSearchKeydown"
                            type="text" 
                            placeholder="Butuh info? Ketik topik di sini..."
                            class="w-full border-none bg-transparent text-[15px] text-[#1b1b18] placeholder-[#1b1b18]/40 outline-none focus:outline-none focus:ring-0"
                        />
                        <button @click="handleSearch" class="flex-shrink-0">
                            <Icon icon="mdi:magnify" class="h-6 w-6 text-[#DDB4F6] transition-colors hover:text-[#8DD0FC]" />
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kategori Artikel Section -->
        <section class="bg-white px-6 py-12 lg:px-12">
            <h2 class="scroll-animate mb-8 text-center text-[28px] font-semibold text-[#1b1b18] lg:text-[36px]">Kategori Artikel</h2>
            
            <!-- Category Tabs -->
            <div class="mb-10 flex flex-wrap justify-center gap-3 lg:gap-4">
                <button 
                    @click="filterByCategory('')"
                    :class="[
                        'rounded-full px-4 py-2 text-[13px] font-medium transition-all lg:px-6 lg:text-[14px]',
                        !selectedCategory 
                            ? 'bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] text-white' 
                            : 'border border-[#1b1b18]/20 bg-white text-[#1b1b18] hover:border-[#8DD0FC]'
                    ]"
                >
                    Semua
                </button>
                <button 
                    v-for="category in allCategories"
                    :key="category"
                    @click="filterByCategory(category)"
                    :class="[
                        'rounded-full px-4 py-2 text-[13px] font-medium transition-all lg:px-6 lg:text-[14px]',
                        selectedCategory === category 
                            ? 'bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] text-white' 
                            : 'border border-[#1b1b18]/20 bg-white text-[#1b1b18] hover:border-[#8DD0FC]'
                    ]"
                >
                    {{ category }}
                </button>
            </div>

            <!-- Featured Article & Latest Articles -->
            <div v-if="featuredArticle && articles.data.length > 0" class="mx-auto max-w-6xl">
                <div class="flex flex-col gap-6 lg:h-[450px] lg:flex-row">
                    <!-- Main Article (Left) -->
                    <Link 
                        :href="`/article/${featuredArticle.slug}`"
                        class="relative h-[300px] flex-[2] overflow-hidden rounded-[20px] transition-transform hover:scale-[1.01] lg:h-full"
                        style="background: linear-gradient(to right, #F4AFE9 0%, #8DD0FC 100%);"
                    >
                        <div class="h-full w-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC]"></div>
                        <!-- Full shadow overlay -->
                        <div class="absolute inset-0" style="background: linear-gradient(to top, #005A94 0%, #007BCD 33%, rgba(141, 208, 252, 0.3) 66%, rgba(141, 208, 252, 0) 100%);"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span 
                                class="mb-2 inline-block rounded-full px-3 py-1 text-[11px] font-medium text-white"
                                :class="getCategoryColor(featuredArticle.category).includes('bg-') ? getCategoryColor(featuredArticle.category) : 'bg-gradient-to-r ' + getCategoryColor(featuredArticle.category)"
                            >
                                {{ featuredArticle.category }}
                            </span>
                            <h3 class="text-[18px] font-semibold leading-tight text-white lg:text-[20px]">
                                {{ featuredArticle.title }}
                            </h3>
                            <p class="mt-2 flex items-center gap-1 text-[12px] text-white/80">
                                <Icon icon="mdi:calendar" class="h-4 w-4" />
                                {{ formatDate(featuredArticle.published_at) }}
                            </p>
                        </div>
                    </Link>

                    <!-- Right Articles -->
                    <div class="flex flex-1 flex-col gap-3">
                        <Link 
                            v-for="article in articles.data.slice(0, 3)" 
                            :key="article.id"
                            :href="`/article/${article.slug}`"
                            class="flex flex-1 gap-4 overflow-hidden rounded-[15px] bg-[#F8F8F8] p-3 transition-all hover:bg-[#F0F0F0]"
                        >
                            <div class="relative h-full w-[100px] flex-shrink-0 overflow-hidden rounded-[10px] lg:w-[140px]">
                                <div class="h-full w-full bg-gradient-to-r from-[#F4AFE9]/30 to-[#8DD0FC]/30"></div>
                                <div class="absolute inset-0 rounded-[10px]" style="background: linear-gradient(to top, rgba(0, 90, 148, 0.5) 0%, rgba(0, 123, 205, 0.3) 50%, transparent 100%);"></div>
                            </div>
                            <div class="flex flex-1 flex-col justify-center">
                                <span 
                                    class="mb-1 inline-block w-fit rounded-full px-3 py-1 text-[10px] font-medium text-white"
                                    :class="getCategoryColor(article.category).includes('bg-') ? getCategoryColor(article.category) : 'bg-gradient-to-r ' + getCategoryColor(article.category)"
                                >
                                    {{ article.category }}
                                </span>
                                <h4 class="line-clamp-2 text-[13px] font-semibold leading-tight text-[#1b1b18] lg:text-[14px]">
                                    {{ article.title }}
                                </h4>
                                <p class="mt-1 flex items-center gap-1 text-[11px] text-[#1b1b18]/60">
                                    <Icon icon="mdi:calendar" class="h-3 w-3" />
                                    {{ formatDate(article.published_at) }}
                                </p>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="mx-auto max-w-2xl py-16 text-center">
                <Icon icon="mdi:newspaper-variant-outline" class="mx-auto h-20 w-20 text-[#1b1b18]/20" />
                <h3 class="mt-4 text-[20px] font-semibold text-[#1b1b18]">Belum Ada Artikel</h3>
                <p class="mt-2 text-[14px] text-[#1b1b18]/60">
                    {{ searchQuery ? 'Tidak ditemukan artikel dengan kata kunci tersebut.' : 'Artikel akan segera hadir.' }}
                </p>
                <button 
                    v-if="searchQuery || selectedCategory"
                    @click="filterByCategory('')"
                    class="mt-4 rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-6 py-2 text-[14px] font-medium text-white"
                >
                    Lihat Semua Artikel
                </button>
            </div>
        </section>

        <!-- Artikel Terpopuler Section -->
        <section v-if="popularArticles.length > 0" class="px-6 py-16 lg:px-12">
            <h2 class="scroll-animate mb-10 text-center text-[28px] font-semibold text-[#1b1b18] lg:text-[36px]">Artikel Terpopuler</h2>
            
            <div class="scroll-animate scroll-animate-delay-1 mx-auto grid max-w-6xl gap-6 md:grid-cols-2 lg:grid-cols-3">
                <Link 
                    v-for="article in popularArticles" 
                    :key="article.id"
                    :href="`/article/${article.slug}`"
                    class="overflow-hidden rounded-xl bg-white transition-transform hover:scale-[1.02]"
                >
                    <div class="h-[200px] w-full bg-gradient-to-r from-[#F4AFE9]/30 to-[#8DD0FC]/30"></div>
                    <div class="p-5">
                        <div class="mb-3 flex flex-wrap items-center gap-2">
                            <span 
                                class="rounded-full px-3 py-1 text-[10px] font-medium text-white"
                                :class="getCategoryColor(article.category).includes('bg-') ? getCategoryColor(article.category) : 'bg-gradient-to-r ' + getCategoryColor(article.category)"
                            >
                                {{ article.category }}
                            </span>
                            <span class="flex items-center gap-1 text-[11px] text-[#1b1b18]/60">
                                <Icon icon="mdi:calendar" class="h-3 w-3" />
                                {{ formatDate(article.published_at) }}
                            </span>
                        </div>
                        <h3 class="mb-2 line-clamp-2 text-[16px] font-semibold leading-tight text-[#1b1b18]">
                            {{ article.title }}
                        </h3>
                        <p class="mb-4 line-clamp-3 text-[12px] leading-relaxed text-[#1b1b18]/70">
                            {{ truncateContent(article.content) }}
                        </p>
                        <span class="rounded-full border border-[#1b1b18]/20 px-4 py-2 text-[12px] font-medium text-[#1b1b18]">
                            Selengkapnya
                        </span>
                    </div>
                </Link>
            </div>
        </section>

        <!-- All Articles Grid -->
        <section v-if="articles.data.length > 3" class="scroll-animate bg-white px-6 py-16 lg:px-12">
            <h2 class="mb-10 text-center text-[28px] font-semibold text-[#1b1b18] lg:text-[36px]">Semua Artikel</h2>
            
            <div class="mx-auto grid max-w-6xl gap-6 md:grid-cols-2 lg:grid-cols-3">
                <Link 
                    v-for="article in articles.data.slice(3)" 
                    :key="article.id"
                    :href="`/article/${article.slug}`"
                    class="overflow-hidden rounded-xl bg-[#F8F8F8] transition-all hover:bg-[#F0F0F0]"
                >
                    <div class="p-5">
                        <div class="mb-3 flex flex-wrap items-center gap-2">
                            <span 
                                class="rounded-full px-3 py-1 text-[10px] font-medium text-white"
                                :class="getCategoryColor(article.category).includes('bg-') ? getCategoryColor(article.category) : 'bg-gradient-to-r ' + getCategoryColor(article.category)"
                            >
                                {{ article.category }}
                            </span>
                            <span class="flex items-center gap-1 text-[11px] text-[#1b1b18]/60">
                                <Icon icon="mdi:calendar" class="h-3 w-3" />
                                {{ formatDate(article.published_at) }}
                            </span>
                        </div>
                        <h3 class="mb-2 line-clamp-2 text-[16px] font-semibold leading-tight text-[#1b1b18]">
                            {{ article.title }}
                        </h3>
                        <p class="line-clamp-2 text-[12px] leading-relaxed text-[#1b1b18]/70">
                            {{ truncateContent(article.content, 100) }}
                        </p>
                    </div>
                </Link>
            </div>

            <!-- Pagination -->
            <div v-if="articles.last_page > 1" class="mt-10 flex justify-center gap-2">
                <template v-for="link in articles.links" :key="link.label">
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
        </section>
        <section class="scroll-animate px-6 py-16 lg:px-12">
            <h2 class="mb-10 text-center text-[36px] font-semibold text-[#1b1b18]">5 Tips Kesehatan Harian</h2>
            
            <div class="mx-auto flex max-w-6xl items-center justify-between px-8">
                <!-- Robot Image -->
                <div class="flex-shrink-0">
                    <img src="/images/tips.png" alt="Robot" class="h-[420px] w-auto" />
                </div>

                <!-- Tips List -->
                <div class="mr-16 flex w-[480px] flex-col gap-3">
                    <div class="flex h-[56px] items-stretch overflow-hidden rounded-xl">
                        <div class="flex w-[75px] items-center justify-center bg-white">
                            <span class="text-[24px] font-bold text-[#F4AFE9]">01</span>
                        </div>
                        <div class="flex flex-1 items-center bg-[#FFD3F8] px-5">
                            <span class="text-[16px] font-medium text-[#1b1b18]">Konsumsi Makanan Seimbang 🥗</span>
                        </div>
                    </div>
                    <div class="flex h-[56px] items-stretch overflow-hidden rounded-xl">
                        <div class="flex w-[75px] items-center justify-center bg-white">
                            <span class="text-[24px] font-bold text-[#F4AFE9]">02</span>
                        </div>
                        <div class="flex flex-1 items-center bg-[#FFD3F8] px-5">
                            <span class="text-[16px] font-medium text-[#1b1b18]">Rutin Berolahraga 🏃</span>
                        </div>
                    </div>
                    <div class="flex h-[56px] items-stretch overflow-hidden rounded-xl">
                        <div class="flex w-[75px] items-center justify-center bg-white">
                            <span class="text-[24px] font-bold text-[#F4AFE9]">03</span>
                        </div>
                        <div class="flex flex-1 items-center bg-[#FFD3F8] px-5">
                            <span class="text-[16px] font-medium text-[#1b1b18]">Istirahat yang cukup 😴</span>
                        </div>
                    </div>
                    <div class="flex h-[56px] items-stretch overflow-hidden rounded-xl">
                        <div class="flex w-[75px] items-center justify-center bg-white">
                            <span class="text-[24px] font-bold text-[#F4AFE9]">04</span>
                        </div>
                        <div class="flex flex-1 items-center bg-[#FFD3F8] px-5">
                            <span class="text-[16px] font-medium text-[#1b1b18]">Minum Air yang Cukup 💧</span>
                        </div>
                    </div>
                    <div class="flex h-[56px] items-stretch overflow-hidden rounded-xl">
                        <div class="flex w-[75px] items-center justify-center bg-white">
                            <span class="text-[24px] font-bold text-[#F4AFE9]">05</span>
                        </div>
                        <div class="flex flex-1 items-center bg-[#FFD3F8] px-5">
                            <span class="text-[16px] font-medium text-[#1b1b18]">Kelola Stres dengan Baik 🧘</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ingin mengtahui Gejala Section -->
        <section class="mt-16 px-6 pt-40 pb-16 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <div class="relative flex h-[400px] items-center rounded-[30px] bg-gradient-to-r from-[#8DD0FC] to-[#DDB4F6] px-10">
                    <!-- Stripes di pojok kanan bawah (inside card with clip) -->
                    <div class="absolute inset-0 overflow-hidden rounded-[30px]">
                        <div class="absolute bottom-16 -right-17 h-[50px] w-[500px] rounded-l-full bg-white/20" style="transform: rotate(-35deg); transform-origin: bottom right;"></div>
                    </div>

                    <div class="absolute right-24 top-16 z-10 max-w-sm">
                        <h2 class="flex items-center gap-3 text-[32px] font-bold text-[#1b1b18]">
                            Ingin mengtahui
                            <Icon icon="carbon:circle-dash" class="h-8 w-8 text-[#1b1b18]" />
                        </h2>
                        <h3 class="text-[32px] font-bold text-[#1b1b18]">
                            <span class="text-[#43B3FC]">Gejala</span> anda?
                        </h3>
                        <p class="mt-3 text-[18px] font-light text-[#1b1b18]/80">
                            Yuk Periksa menggunakan<br />Chatbot Sekarang juga!
                        </p>
                        <Link href="/consultation" class="mt-5 inline-flex w-fit items-center justify-between gap-6 rounded-full border-2 border-[#1b1b18] bg-white px-6 py-2 text-[16px] font-medium text-[#1b1b18] transition-colors hover:bg-[#1b1b18] hover:text-white">
                            Chatbot
                            <Icon icon="mdi:arrow-top-right" class="h-5 w-5" />
                        </Link>
                    </div>
                    <div class="absolute left-10 -top-32 z-20">
                        <img src="/images/gejala.png" alt="Gejala" class="w-[600px] max-w-none" />
                    </div>
                </div>
            </div>
        </section>

        <Footer />
    </div>
</template>
