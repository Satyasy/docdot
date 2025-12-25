<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <footer class="relative mt-16">
        <!-- Wave SVG di atas -->
        <div class="absolute -top-20 left-0 right-0">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" class="h-24 w-full">
                <defs>
                    <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#8DD0FC" />
                        <stop offset="100%" stop-color="#DDB4F6" />
                    </linearGradient>
                </defs>
                <path d="M0,60 C150,100 350,0 500,50 C650,100 800,20 1000,60 C1150,90 1300,30 1440,60 L1440,120 L0,120 Z" fill="url(#waveGradient)" opacity="0.3" />
                <path d="M0,80 C200,40 400,100 600,60 C800,20 1000,90 1200,50 C1350,20 1400,70 1440,80 L1440,120 L0,120 Z" fill="url(#waveGradient)" opacity="0.5" />
                <path d="M0,90 C100,70 300,110 500,80 C700,50 900,100 1100,70 C1250,50 1350,90 1440,90 L1440,120 L0,120 Z" fill="url(#waveGradient)" opacity="0.7" />
            </svg>
        </div>

        <!-- Footer Content -->
        <div class="bg-gradient-to-r from-[#8DD0FC] to-[#DDB4F6] px-6 pt-16 pb-6 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <div class="flex flex-wrap justify-between gap-8">
                    <!-- DocDot -->
                    <div class="max-w-[200px]">
                        <img src="/images/logo.png" alt="DocDot" class="mb-4 h-16 w-auto" />
                        <p class="text-[14px] leading-relaxed text-[#1b1b18]/80">
                            Teman cerdas Anda untuk informasi kesehatan terpercaya.
                        </p>
                    </div>

                    <!-- Menu -->
                    <div>
                        <h3 class="mb-4 text-[20px] font-bold text-[#1b1b18]">Menu</h3>
                        <ul class="space-y-2 text-[14px] text-[#1b1b18]/80">
                            <li><Link href="/" class="hover:text-[#1b1b18]">Home</Link></li>
                            <li><Link href="/article" class="hover:text-[#1b1b18]">Article</Link></li>
                            <li><Link href="/drug-catalog" class="hover:text-[#1b1b18]">Drug Catalog</Link></li>
                            <li><Link href="/consultation" class="hover:text-[#1b1b18]">Consultation</Link></li>
                        </ul>
                    </div>

                    <!-- Bantuan & Panduan -->
                    <div>
                        <h3 class="mb-4 text-[20px] font-bold text-[#1b1b18]">Bantuan & Panduan</h3>
                        <ul class="space-y-2 text-[14px] text-[#1b1b18]/80">
                            <li><Link href="/about" class="hover:text-[#1b1b18]">Tentang Kami</Link></li>
                            <li><Link href="/contact" class="hover:text-[#1b1b18]">Hubungi Kami</Link></li>
                            <li><Link href="/terms-of-service" class="hover:text-[#1b1b18]">Syarat & Ketentuan</Link></li>
                            <li><Link href="/privacy-policy" class="hover:text-[#1b1b18]">Kebijakan Privasi</Link></li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div>
                        <h3 class="mb-4 text-[20px] font-bold text-[#1b1b18]">Kontak</h3>
                        <div class="space-y-2 text-[14px] text-[#1b1b18]/80">
                            <p class="flex items-center gap-2">
                                <Icon icon="mdi:phone" class="h-4 w-4" />
                                +62 812-3456-7890
                            </p>
                            <p class="flex items-center gap-2">
                                <Icon icon="mdi:email" class="h-4 w-4" />
                                support@docdot.id
                            </p>
                        </div>
                        <!-- Social Icons -->
                        <div class="mt-4 flex gap-3">
                            <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-black">
                                <Icon icon="ic:baseline-tiktok" class="h-5 w-5 text-white" />
                            </a>
                            <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-[#f9ce34] via-[#ee2a7b] to-[#6228d7]">
                                <Icon icon="mdi:instagram" class="h-5 w-5 text-white" />
                            </a>
                            <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-[#1877F2]">
                                <Icon icon="mdi:facebook" class="h-5 w-5 text-white" />
                            </a>
                            <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-black">
                                <Icon icon="mdi:twitter" class="h-5 w-5 text-white" />
                            </a>
                        </div>
                    </div>
                </div>

                <!-- All Right Reserved -->
                <div class="mt-8 border-t border-[#1b1b18]/10 pt-4">
                    <p class="flex items-center justify-center gap-2 text-[12px] text-[#1b1b18]/60">
                        <Icon icon="mdi:copyright" class="h-4 w-4" />
                        {{ new Date().getFullYear() }} DocDot. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>
