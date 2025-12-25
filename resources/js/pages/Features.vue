<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import { Icon } from '@iconify/vue';
</script>

<template>
    <Head title="Features" />
    <div class="min-h-screen overflow-x-hidden" style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%);">
        <Navbar />

        <!-- Hero Section -->
        <section class="relative overflow-hidden px-6 pt-8 lg:px-12">
            <!-- Background gradient blob -->
            <div class="absolute top-20 left-1/2 -translate-x-1/2 h-[500px] w-[800px] rounded-full bg-gradient-to-r from-[#8DD0FC]/30 via-[#DDB4F6]/20 to-[#F4AFE9]/30 blur-3xl"></div>

            <div class="relative z-10 mx-auto max-w-4xl pt-16 text-center">
                <!-- Floating card top right -->
                <div class="absolute top-4 -right-40 rounded-full bg-white px-6 py-3 text-[16px] font-normal shadow-lg">
                    Ayo mulai sekarang!
                </div>

                <h1 class="text-[56px] font-semibold leading-tight text-[#1b1b18]">
                    Get trusted insights about your<br />symptoms with <span style="background: linear-gradient(to right, #C360FF 0%, #54BBFF 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">DocDot</span>
                </h1>

                <p class="mt-6 text-[20px] font-light text-[#1b1b18]/80">
                    Describe what you're feeling, DocDot will help decode it for you.
                </p>

                <!-- Floating card left -->
                <div class="absolute bottom-50 -left-50 rounded-xl bg-white px-5 py-3 shadow-lg">
                    <p class="text-[14px] font-semibold text-[#1b1b18]">Konsultasi Sekarang! 🌟 9.10</p>
                </div>

                <!-- Get Started Button -->
                <button class="mt-8 inline-flex items-center gap-2 rounded-full border-2 border-[#1b1b18] px-8 py-3 text-[18px] font-medium text-[#1b1b18] transition-colors hover:bg-[#1b1b18] hover:text-white">
                    Get Started
                    <Icon icon="mdi:arrow-right" class="h-5 w-5" />
                </button>

                <!-- Chat Input Box with gradient border -->
                <div class="mx-auto mt-12 w-[600px] overflow-hidden rounded-xl p-[2px]" style="background: linear-gradient(to left, #8DD0FC 0%, #DDB4F6 100%);">
                    <div class="overflow-hidden rounded-xl bg-white px-6 py-4">
                        <input 
                            type="text" 
                            placeholder="Type your symptoms here..."
                            class="w-full border-none bg-transparent text-[16px] text-[#1b1b18] placeholder-[#1b1b18]/40 outline-none focus:outline-none focus:ring-0"
                        />
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <button class="flex items-center gap-2 text-[13px] text-[#54BBFF]">
                                    <Icon icon="mdi:auto-fix" class="h-4 w-4" />
                                    Identify your symptoms
                                </button>
                                <button class="flex items-center gap-2 text-[13px] text-[#1b1b18]/60">
                                    <Icon icon="mdi:image-outline" class="h-4 w-4" />
                                    Consult by uploading a photo
                                </button>
                            </div>
                            <button class="flex h-8 w-8 items-center justify-center text-[#54BBFF] transition-colors hover:text-[#43A8E8]">
                                <Icon icon="mdi:send" class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How does it work Section -->
        <section class="relative px-6 py-8 lg:px-12 mt-30">
            <div class="mx-auto max-w-6xl overflow-visible rounded-[30px] px-16 pb-16 pt-8" style="background: rgba(255, 255, 255, 0.4);">
                <h2 class="mb-8 text-center text-[36px] font-semibold text-[#1b1b18]">How does it work?</h2>
                
                <div class="flex items-start justify-center gap-8">
                    <!-- Card 1 -->
                    <div class="mt-8 h-[300px] w-[260px] overflow-hidden rounded-[20px] bg-white p-6 text-center shadow-sm">
                        <Icon icon="mingcute:search-line" class="mx-auto mb-4 h-10 w-10 text-[#9EC9FB]" />
                        <h3 class="mb-3 text-[16px] font-semibold text-[#1b1b18]">Input Gejala atau Pertanyaan</h3>
                        <p class="text-[13px] leading-relaxed text-[#1b1b18]/70">
                            Pengguna cukup mengetik keluhan atau pertanyaan kesehatan, misalnya "sakit kepala", "demam sejak kemarin", atau "tips pola makan sehat untuk remaja."
                        </p>
                    </div>

                    <!-- Card 2 (higher) -->
                    <div class="-mt-4 h-[300px] w-[260px] overflow-hidden rounded-[20px] bg-white p-6 text-center shadow-sm">
                        <Icon icon="mage:robot-wink" class="mx-auto mb-4 h-10 w-10 text-[#9EC9FB]" />
                        <h3 class="mb-3 text-[16px] font-semibold text-[#1b1b18]">Analisis dengan AI Medis</h3>
                        <p class="text-[13px] leading-relaxed text-[#1b1b18]/70">
                            Aido memproses input dengan teknologi AI, membandingkan dengan data medis terpercaya, lalu memberikan informasi seputar kemungkinan penyebab, tips perawatan awal, dan rekomendasi gaya hidup.
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="mt-8 h-[300px] w-[260px] overflow-hidden rounded-[20px] bg-white p-6 text-center shadow-sm">
                        <Icon icon="mdi:clipboard-text-outline" class="mx-auto mb-4 h-10 w-10 text-[#CCBAF8]" />
                        <h3 class="mb-3 text-[16px] font-semibold text-[#1b1b18]">Saran & Rekomendasi Lanjutan</h3>
                        <p class="text-[13px] leading-relaxed text-[#1b1b18]/70">
                            Aido menampilkan hasil analisis dalam bahasa yang mudah dipahami. Jika gejala serius, chatbot akan menyarankan pengguna untuk segera berkonsultasi dengan tenaga medis profesional.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial Section -->
        <section class="mt-16 w-full py-12 mb-50" style="background: rgba(255, 255, 255, 0.3);">
            <div class="px-6 lg:px-12">
                <h2 class="mb-10 text-left text-[32px] font-semibold text-[#1b1b18]">
                    Testimonial dari Pengguna <span class="text-[#54BBFF]">Aido</span>
                </h2>
                
                <div class="flex justify-between gap-6">
                    <!-- Card 1 -->
                    <div class="flex-1 rounded-[20px] bg-[#FAF1FF] p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/48?img=11" class="h-12 w-12 rounded-full object-cover" />
                                <div>
                                    <p class="text-[16px] font-semibold text-[#1b1b18]">User2345</p>
                                    <p class="text-[12px] text-[#1b1b18]/60">@msamjdjshf</p>
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
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco .
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="flex-1 rounded-[20px] bg-[#FAF1FF] p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/48?img=12" class="h-12 w-12 rounded-full object-cover" />
                                <div>
                                    <p class="text-[16px] font-semibold text-[#1b1b18]">User2345</p>
                                    <p class="text-[12px] text-[#1b1b18]/60">@msamjdjshf</p>
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
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco .
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="flex-1 rounded-[20px] bg-[#FAF1FF] p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="https://i.pravatar.cc/48?img=13" class="h-12 w-12 rounded-full object-cover" />
                                <div>
                                    <p class="text-[16px] font-semibold text-[#1b1b18]">User2345</p>
                                    <p class="text-[12px] text-[#1b1b18]/60">@msamjdjshf</p>
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
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco .
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <Footer />
    </div>
</template>
