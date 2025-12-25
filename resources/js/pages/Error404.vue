<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
</script>

<template>
    <Head title="404 - Halaman Tidak Ditemukan" />

    <div 
        class="flex min-h-screen flex-col items-center justify-center px-6 font-[Poppins]"
        style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%)"
    >
        <div class="text-center">
            <!-- 404 Illustration -->
            <div class="relative mx-auto mb-8 w-64">
                <div class="text-[150px] font-bold leading-none text-white/50">404</div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="rounded-full bg-white p-6 shadow-2xl">
                        <Icon icon="mdi:emoticon-sad-outline" class="h-20 w-20 text-[#BF55FF]" />
                    </div>
                </div>
            </div>

            <!-- Message -->
            <h1 class="mb-4 text-[28px] font-bold text-[#1b1b18] lg:text-[36px]">
                Halaman Tidak Ditemukan
            </h1>
            <p class="mx-auto mb-8 max-w-md text-[14px] text-[#1b1b18]/70 lg:text-[16px]">
                Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin halaman telah dipindahkan atau dihapus.
            </p>

            <!-- Actions -->
            <div class="flex flex-wrap justify-center gap-4">
                <Link 
                    href="/"
                    class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-6 py-3 text-[14px] font-medium text-white transition-all hover:shadow-lg"
                >
                    <Icon icon="mdi:home" class="h-5 w-5" />
                    Kembali ke Beranda
                </Link>
                <Link 
                    href="/consultation"
                    class="inline-flex items-center gap-2 rounded-full border-2 border-[#1b1b18] px-6 py-3 text-[14px] font-medium text-[#1b1b18] transition-all hover:bg-[#1b1b18] hover:text-white"
                >
                    <Icon icon="mdi:chat-outline" class="h-5 w-5" />
                    Konsultasi
                </Link>
            </div>

            <!-- Quick Links -->
            <div class="mt-12">
                <p class="mb-4 text-[13px] text-[#1b1b18]/60">Atau kunjungi halaman populer:</p>
                <div class="flex flex-wrap justify-center gap-3">
                    <Link 
                        href="/article" 
                        class="rounded-full bg-white px-4 py-2 text-[13px] text-[#1b1b18] transition-all hover:bg-[#F8F8F8]"
                    >
                        📰 Artikel
                    </Link>
                    <Link 
                        href="/drug-catalog" 
                        class="rounded-full bg-white px-4 py-2 text-[13px] text-[#1b1b18] transition-all hover:bg-[#F8F8F8]"
                    >
                        💊 Katalog Obat
                    </Link>
                    <Link 
                        href="/about" 
                        class="rounded-full bg-white px-4 py-2 text-[13px] text-[#1b1b18] transition-all hover:bg-[#F8F8F8]"
                    >
                        ℹ️ Tentang Kami
                    </Link>
                    <Link 
                        href="/contact" 
                        class="rounded-full bg-white px-4 py-2 text-[13px] text-[#1b1b18] transition-all hover:bg-[#F8F8F8]"
                    >
                        📧 Hubungi Kami
                    </Link>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="pointer-events-none fixed inset-0 overflow-hidden">
            <div class="absolute -top-24 -left-24 h-48 w-48 rounded-full bg-[#F4AFE9]/20 blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 h-48 w-48 rounded-full bg-[#8DD0FC]/20 blur-3xl"></div>
        </div>
    </div>
</template>
