<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import { Icon } from '@iconify/vue';
import { computed } from 'vue';

interface Article {
    id: number;
    title: string;
    slug: string;
    content: string;
    category: string;
    source: string | null;
    published_at: string;
}

interface Props {
    article: Article;
    relatedArticles: Article[];
}

const props = defineProps<Props>();

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
</script>

<template>
    <Head :title="article.title + ' - DocDot'" />
    <div class="min-h-screen overflow-x-hidden" style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%);">
        <Navbar />

        <!-- Article Header -->
        <section class="px-6 pt-12 pb-8 lg:px-12">
            <div class="mx-auto max-w-4xl">
                <!-- Breadcrumb -->
                <div class="mb-6 flex items-center gap-2 text-[14px] text-[#1b1b18]/60">
                    <Link href="/" class="hover:text-[#1b1b18]">Home</Link>
                    <Icon icon="mdi:chevron-right" class="h-4 w-4" />
                    <Link href="/article" class="hover:text-[#1b1b18]">Artikel</Link>
                    <Icon icon="mdi:chevron-right" class="h-4 w-4" />
                    <span class="text-[#1b1b18]">{{ article.category }}</span>
                </div>

                <!-- Category Badge -->
                <span 
                    class="mb-4 inline-block rounded-full px-4 py-1.5 text-[12px] font-medium text-white"
                    :class="getCategoryColor(article.category).includes('bg-') ? getCategoryColor(article.category) : 'bg-gradient-to-r ' + getCategoryColor(article.category)"
                >
                    {{ article.category }}
                </span>

                <!-- Title -->
                <h1 class="mb-4 text-[36px] font-bold leading-tight text-[#1b1b18]">
                    {{ article.title }}
                </h1>

                <!-- Meta -->
                <div class="flex items-center gap-4 text-[14px] text-[#1b1b18]/60">
                    <span class="flex items-center gap-1">
                        <Icon icon="mdi:calendar" class="h-4 w-4" />
                        {{ formatDate(article.published_at) }}
                    </span>
                    <span v-if="article.source" class="flex items-center gap-1">
                        <Icon icon="mdi:link-variant" class="h-4 w-4" />
                        {{ article.source }}
                    </span>
                </div>
            </div>
        </section>

        <!-- Article Content -->
        <section class="px-6 pb-16 lg:px-12">
            <div class="mx-auto max-w-4xl">
                <div class="rounded-[30px] bg-white/70 p-8 backdrop-blur-sm lg:p-12">
                    <div 
                        class="prose prose-lg max-w-none text-[#1b1b18] prose-headings:text-[#1b1b18] prose-p:text-[#1b1b18]/80 prose-a:text-[#FF7CEA] prose-strong:text-[#1b1b18]"
                        v-html="article.content"
                    ></div>
                </div>

                <!-- Back Button -->
                <div class="mt-8 flex justify-center">
                    <Link 
                        href="/article" 
                        class="flex items-center gap-2 rounded-full border border-[#1b1b18]/20 bg-white px-6 py-3 text-[14px] font-medium text-[#1b1b18] transition-all hover:bg-[#1b1b18] hover:text-white"
                    >
                        <Icon icon="mdi:arrow-left" class="h-5 w-5" />
                        Kembali ke Artikel
                    </Link>
                </div>
            </div>
        </section>

        <!-- Related Articles -->
        <section v-if="relatedArticles.length > 0" class="bg-white px-6 py-16 lg:px-12">
            <h2 class="mb-10 text-center text-[32px] font-semibold text-[#1b1b18]">Artikel Terkait</h2>
            
            <div class="mx-auto flex max-w-6xl gap-6">
                <Link 
                    v-for="related in relatedArticles" 
                    :key="related.id"
                    :href="`/article/${related.slug}`"
                    class="flex-1 overflow-hidden rounded-xl bg-[#F8F8F8] transition-transform hover:scale-[1.02]"
                >
                    <div class="p-5">
                        <div class="mb-3 flex items-center gap-3">
                            <span 
                                class="rounded-full px-3 py-1 text-[10px] font-medium text-white"
                                :class="getCategoryColor(related.category).includes('bg-') ? getCategoryColor(related.category) : 'bg-gradient-to-r ' + getCategoryColor(related.category)"
                            >
                                {{ related.category }}
                            </span>
                            <span class="flex items-center gap-1 text-[11px] text-[#1b1b18]/60">
                                <Icon icon="mdi:calendar" class="h-3 w-3" />
                                {{ formatDate(related.published_at) }}
                            </span>
                        </div>
                        <h3 class="text-[16px] font-semibold leading-tight text-[#1b1b18]">
                            {{ related.title }}
                        </h3>
                    </div>
                </Link>
            </div>
        </section>

        <Footer />
    </div>
</template>
