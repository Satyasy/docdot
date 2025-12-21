<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import { Icon } from '@iconify/vue';
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen overflow-x-hidden bg-white">
        <Navbar />

        <section class="relative overflow-hidden px-6 pt-8 lg:px-12">
            <div class="relative z-10 mx-auto flex max-w-7xl flex-col items-center gap-8 lg:flex-row lg:items-start lg:justify-between">
                <div class="max-w-xl pt-16">
                    <h1 class="text-[40px] font-semibold leading-tight text-[#1b1b18] lg:text-[48px]">
                        Lindungi Diri Anda<br />Lindungi Keluarga
                    </h1>
                    <p class="mt-4 text-[20px] font-light text-[#1b1b18]">
                        Konsultasikan Keluhan Kesehatan Anda<br />Langsung, dengan Dokter Terpercaya.
                    </p>
                    <button class="mt-8 flex items-center gap-2 rounded-full border-2 border-[#1b1b18] px-10 py-3 text-[20px] font-medium text-[#1b1b18] transition-colors hover:bg-[#1b1b18] hover:text-white">
                        ChatBot
                        <Icon icon="mdi:arrow-right" class="h-5 w-5" />
                    </button>
                </div>

                <div class="relative -translate-x-16">
                    <div class="absolute -top-4 -right-32 z-10 rounded-full bg-white px-6 py-3 text-[16px] font-normal shadow-lg">
                        Ayo mulai sekarang!
                    </div>
                    <img src="/images/hero.png" alt="App Preview" class="w-[550px]" style="filter: drop-shadow(0 25px 50px rgba(141, 208, 252, 0.5))" />
                    <div class="absolute bottom-48 -left-8 z-10 rounded-xl bg-white px-5 py-3 shadow-lg">
                        <p class="text-[14px] font-semibold text-[#1b1b18]">Konsultasi Sekarang! 🌟 9.10</p>
                    </div>
                </div>
            </div>

            <div class="relative -mt-36 h-[320px]">
                <svg class="absolute left-32 right-0 h-full" style="width: calc(100% + 50px)" viewBox="0 0 1400 280" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#8DD0FC" />
                            <stop offset="100%" stop-color="#DDB4F6" />
                        </linearGradient>
                    </defs>
                    <path d="M40,80 L1360,15 Q1400,10 1400,50 L1400,240 Q1400,280 1360,280 L40,280 Q0,280 0,240 L0,120 Q0,80 40,80 Z" fill="url(#gradient)" />
                </svg>

                <div class="relative z-10 px-12 pt-28 pb-12 pl-48">
                    <div class="mx-auto flex max-w-7xl items-start justify-between gap-24">
                        <div class="flex gap-24">
                            <div class="max-w-[320px]">
                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#5BA4D9]/20">
                                    <Icon icon="eos-icons:ai" class="h-8 w-8 text-[#2D7BB8]" />
                                </div>
                                <h3 class="text-[20px] font-bold text-[#1b1b18]">AI Consultation</h3>
                                <p class="mt-2 text-[14px] leading-relaxed text-[#1b1b18]/80">
                                    Konsultasikan keluhan penyakit Anda sekarang dan dapatkan solusi cepat dari MediBot, aman terpercaya.
                                </p>
                            </div>
                            <div class="max-w-[320px]">
                                <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/40">
                                    <Icon icon="fluent-mdl2:insights" class="h-8 w-8 text-[#2D7BB8]" />
                                </div>
                                <h3 class="text-[20px] font-bold text-[#1b1b18]">MediBot Insight</h3>
                                <p class="mt-2 text-[14px] leading-relaxed text-[#1b1b18]/80">
                                    Temukan berbagai artikel kesehatan terpercaya dan terbaru hanya di MediBot, untuk hidup lebih sehat.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col items-center">
                            <div class="rounded-xl bg-white px-8 py-4 shadow-lg">
                                <p class="text-[14px] font-normal text-[#1b1b18]">Periksa Kesehatan Anda</p>
                                <p class="flex items-center gap-1 text-[14px] font-normal text-[#1b1b18]">
                                    Sekarang!
                                    <Icon icon="mdi:magnify" class="h-4 w-4" />
                                </p>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex -space-x-8">
                                    <img src="https://i.pravatar.cc/48?img=1" class="h-12 w-12 rounded-full border-2 border-white object-cover" />
                                    <img src="https://i.pravatar.cc/48?img=2" class="h-12 w-12 rounded-full border-2 border-white object-cover" />
                                    <img src="https://i.pravatar.cc/48?img=3" class="h-12 w-12 rounded-full border-2 border-white object-cover" />
                                    <img src="https://i.pravatar.cc/48?img=4" class="h-12 w-12 rounded-full border-2 border-white object-cover" />
                                </div>
                                <div class="-ml-4 flex h-12 w-12 items-center justify-center rounded-full bg-white text-[14px] font-semibold text-[#1b1b18]">
                                    100+
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Bar Section -->
        <section class="px-6 py-16 lg:px-12">
            <div class="rounded-[30px] bg-gradient-to-r from-[#8DD0FC] to-[#DDB4F6] px-16 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl border-2 border-[#7D80DF] bg-transparent">
                            <Icon icon="mdi:clock-fast" class="h-8 w-8 text-[#43B3FC]" />
                        </div>
                        <span class="text-[18px] font-medium text-[#1b1b18]">Layanan yang cepat</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl border-2 border-[#7D80DF] bg-transparent">
                            <Icon icon="mingcute:hours-fill" class="h-8 w-8 text-[#43B3FC]" />
                        </div>
                        <span class="text-[18px] font-medium text-[#1b1b18]">24 Jam</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl border-2 border-[#7D80DF] bg-transparent">
                            <Icon icon="wpf:doctors-bag" class="h-8 w-8 text-[#43B3FC]" />
                        </div>
                        <span class="text-[18px] font-medium text-[#1b1b18]">Konsultasi Gratis</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mengapa harus DocDot Section -->
        <section class="px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <div class="relative flex items-center justify-between">
                    <div class="relative flex items-center">
                        <div class="relative h-[380px] w-[220px] rounded-[30px] bg-[#43B3FC]/10">
                            <div class="absolute top-1/2 left-1/2 h-[200px] w-[2px] -translate-x-1/2 -translate-y-1/2 bg-[#43B3FC]/40"></div>
                            <div class="absolute top-1/2 left-1/2 h-3 w-3 -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#43B3FC]/60"></div>
                            <div class="absolute top-1/2 -left-8 flex h-16 w-16 -translate-y-1/2 rotate-[-15deg] items-center justify-center rounded-[14px] bg-[#7DD3FC]">
                                <Icon icon="mdi:magnify" class="h-8 w-8 text-white" />
                            </div>
                            <Icon icon="mdi:magnify" class="absolute bottom-4 left-4 h-6 w-6 text-[#1b1b18]/30" />
                        </div>

                        <div class="relative -ml-16 max-w-md rounded-[30px] bg-white p-10" style="box-shadow: 0 10px 40px rgba(141, 208, 252, 0.4)">
                            <h2 class="mb-6 text-[24px] font-bold text-[#1b1b18]">Mengapa harus DocDot?</h2>
                            <div class="space-y-4">
                                <div class="border-l-2 border-[#43B3FC] pl-4">
                                    <p class="text-[14px] leading-relaxed text-[#1b1b18]/80">
                                        Hampir separuh hingga dua pertiga populasi Indonesia belum memahami informasi kesehatan dengan baik.
                                    </p>
                                </div>
                                <div class="border-l-2 border-[#43B3FC] pl-4">
                                    <p class="text-[14px] leading-relaxed text-[#1b1b18]/80">
                                        Di banyak wilayah global, lebih dari sepertiga hingga setengah populasi juga mengalami kondisi serupa.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-8">
                        <div class="flex items-center gap-6">
                            <div>
                                <p class="text-[56px] font-bold leading-none text-[#43B3FC]">33%</p>
                                <p class="text-[20px] font-medium text-[#43B3FC]">kesehatan<br />problematic</p>
                            </div>
                            <p class="max-w-[450px] text-[20px] font-light leading-relaxed text-[#1b1b18]">
                                Di antara pasien dengan penyakit kronis, sekitar 33% menunjukkan tingkat literasi kesehatan problematic dan 16,2% berada pada kategori inadequate, sehingga total ~49% memiliki literasi kesehatan yang kurang memadai.
                            </p>
                        </div>
                        <div class="flex items-center gap-6">
                            <div>
                                <p class="text-[56px] font-bold leading-none text-[#43B3FC]">26%</p>
                                <p class="text-[20px] font-medium text-[#43B3FC]">low health<br />literacy</p>
                            </div>
                            <p class="max-w-[450px] text-[20px] font-light leading-relaxed text-[#1b1b18]">
                                Analisis dari berbagai kategori menunjukkan bahwa rata-rata 26% populasi memiliki low health literacy, dengan marginal literacy juga signifikan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Rasakan Fitur Kesehatan Section -->
        <section class="bg-[#DDB4F6]/20 px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-7xl text-center">
                <h2 class="text-[36px] font-bold text-[#1b1b18]">
                    Rasakan <span class="text-[#CC79FF]">Fitur Kesehatan</span> Lengkap dengan<br />
                    Teknologi Pintar dari <span class="bg-gradient-to-r from-[#CC79FF] to-[#4FB9FF] bg-clip-text text-transparent">DocDot</span> Setiap Hari 🚀
                </h2>

                <div class="mt-12 flex items-stretch justify-center gap-6">
                    <div class="relative h-[180px] w-[400px] overflow-hidden rounded-[30px] bg-[#E2B2FF] p-6">
                        <div class="absolute -top-8 -bottom-8 left-[51%] w-[18%] rounded-[20px] bg-white/60" style="transform: skewX(-15deg);"></div>
                        <div class="absolute -top-8 -bottom-8 left-[69%] w-[18%] rounded-[20px] bg-white/30" style="transform: skewX(-15deg);"></div>
                        <div class="absolute -top-8 -bottom-8 left-[87%] w-[18%] rounded-[20px] bg-white/20" style="transform: skewX(-15deg);"></div>
                        <div class="relative z-10 mt-auto h-[110px] rounded-[20px] bg-white p-5">
                            <div class="flex items-start gap-3">
                                <img src="/images/time.png" alt="Time" class="h-12 w-12" />
                                <p class="text-left text-[14px] leading-relaxed text-[#1b1b18]/80">
                                    Tim kami siap merespon keluhan kesehatan mu dengan cepat, 24/7 tanpa harus menunggu lama.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="relative h-[180px] w-[400px] overflow-hidden rounded-[30px] bg-[#E2B2FF] p-6">
                        <div class="absolute -top-8 -bottom-8 left-[51%] w-[18%] rounded-[20px] bg-white/60" style="transform: skewX(-15deg);"></div>
                        <div class="absolute -top-8 -bottom-8 left-[69%] w-[18%] rounded-[20px] bg-white/30" style="transform: skewX(-15deg);"></div>
                        <div class="absolute -top-8 -bottom-8 left-[87%] w-[18%] rounded-[20px] bg-white/20" style="transform: skewX(-15deg);"></div>
                        <div class="relative z-10 mt-auto h-[110px] rounded-[20px] bg-white p-5">
                            <div class="flex items-start gap-3">
                                <img src="/images/chat.png" alt="Chat" class="h-12 w-12" />
                                <p class="text-left text-[14px] leading-relaxed text-[#1b1b18]/80">
                                    Konsultasi kesehatan tersedia kapan pun, siap melayani kamu siang dan malam tanpa henti.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="relative h-[180px] w-[400px] overflow-hidden rounded-[30px] bg-[#E2B2FF] p-6">
                        <div class="absolute -top-8 -bottom-8 left-[51%] w-[18%] rounded-[20px] bg-white/60" style="transform: skewX(-15deg);"></div>
                        <div class="absolute -top-8 -bottom-8 left-[69%] w-[18%] rounded-[20px] bg-white/30" style="transform: skewX(-15deg);"></div>
                        <div class="absolute -top-8 -bottom-8 left-[87%] w-[18%] rounded-[20px] bg-white/20" style="transform: skewX(-15deg);"></div>
                        <div class="relative z-10 mt-auto h-[110px] rounded-[20px] bg-white p-5">
                            <div class="flex items-start gap-3">
                                <img src="/images/talks.png" alt="Talks" class="h-12 w-12" />
                                <p class="text-left text-[14px] leading-relaxed text-[#1b1b18]/80">
                                    Nikmati layanan konsultasi kesehatan tanpa biaya, langsung dari rumah kamu.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pengingat Medibot Section -->
        <section class="bg-white px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <div class="flex items-start justify-between gap-12">
                    <div class="relative flex gap-8">
                        <div class="relative">
                            <div class="absolute -top-8 left-1/2 z-20 flex h-16 w-16 -translate-x-1/2 items-center justify-center rounded-full bg-white shadow-lg">
                                <Icon icon="mdi:stethoscope" class="h-8 w-8 text-[#CC79FF]" />
                            </div>

                            <div class="relative h-[280px] w-[280px] rounded-[30px] bg-[#E2B2FF]">
                                <div class="absolute top-0 right-0 h-full w-1/2 rounded-r-[30px] bg-[#D9A0F0]"></div>
                                <img src="/images/bot.png" alt="MediBot" class="absolute bottom-4 left-1/2 z-10 h-[220px] w-auto -translate-x-1/2" />
                            </div>

                            <div class="absolute top-16 -right-20 z-20 rounded-full bg-white px-8 py-3 shadow-lg">
                                <span class="text-[18px] font-semibold text-[#CC79FF]">Notification</span>
                            </div>
                        </div>

                        <div class="relative mt-40">
                            <div class="absolute -top-8 left-1/2 z-20 flex h-14 w-14 -translate-x-1/2 items-center justify-center rounded-full bg-white shadow-lg">
                                <Icon icon="hugeicons:tick-03" class="h-7 w-7 text-[#43B3FC]" />
                            </div>

                            <div class="relative h-[220px] w-[260px] overflow-hidden rounded-[20px] bg-[#83CEFF] p-6">
                                <div class="absolute top-0 bottom-0 left-[35%] w-[25%] bg-[#99D7FF]"></div>
                                <div class="absolute top-0 bottom-0 left-[60%] right-0 bg-[#ACDEFF]"></div>
                                <div class="relative z-10 flex h-full flex-col justify-center space-y-5">
                                    <div class="flex items-center gap-3">
                                        <Icon icon="hugeicons:tick-03" class="h-6 w-6 text-white" />
                                        <span class="text-[16px] font-light text-[#1b1b18]">Tips Kesehatan Harian</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <Icon icon="hugeicons:tick-03" class="h-6 w-6 text-white" />
                                        <span class="text-[16px] font-light text-[#1b1b18]">Pengingat Konsultasi</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <Icon icon="hugeicons:tick-03" class="h-6 w-6 text-white" />
                                        <span class="text-[16px] font-light text-[#1b1b18]">Ucapan Penyemangat</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-xl pt-8">
                        <h2 class="text-[32px] font-bold text-[#1b1b18]">Pengigat Medibot 🔔</h2>
                        <div class="mt-4 border-l-2 border-[#039BFF] pl-4">
                            <p class="text-[16px] leading-relaxed text-[#1b1b18]/80">
                                Fitur notification di MediBot berfungsi untuk memberikan pengingat dan informasi penting secara otomatis. Tujuannya agar pengguna lebih teratur dalam menjaga kesehatannya.
                            </p>
                        </div>

                        <h3 class="mt-8 text-[24px] font-bold text-[#1b1b18]">Siaga bersama Medibot</h3>
                        <div class="mt-4 border-l-2 border-[#BF55FF] pl-4">
                            <p class="text-[16px] leading-relaxed text-[#1b1b18]/80">
                                Dengan fitur notifikasi otomatis, MediBot selalu siap mengingatkanmu tentang jadwal kesehatan penting konsultasi, dan tips harian agar kamu tetap sehat dan terjaga setiap saat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Informasi Tepat Section -->
        <section class="mt-16 bg-white px-6 pt-40 pb-16 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <div class="relative flex h-[474px] items-center rounded-[30px] bg-gradient-to-r from-[#8DD0FC] to-[#DDB4F6] px-10">
                    <!-- Stripes di pojok kanan bawah (inside card with clip) -->
                    <div class="absolute inset-0 overflow-hidden rounded-[30px]">
                        <div class="absolute bottom-16 -right-17 h-[50px] w-[500px] rounded-l-full bg-white/20" style="transform: rotate(-35deg); transform-origin: bottom right;"></div>
                    </div>

                    <div class="absolute right-48 z-10 max-w-sm py-4">
                        <h2 class="flex items-center gap-3 text-[26px] font-bold text-[#1b1b18]">
                            Informasi Tepat
                            <Icon icon="mdi:fingerprint" class="h-7 w-7 text-[#1b1b18]" />
                        </h2>
                        <h3 class="text-[26px] font-bold text-[#1b1b18]">
                            Untuk <span class="text-[#7C3AED]">Hidup</span> Sehat
                        </h3>
                        <p class="mt-2 text-[15px] font-light text-[#1b1b18]/80">
                            Konten tepercaya untuk<br />mendukung kesehatan keluarga<br />Anda.
                        </p>
                        <button class="mt-4 flex items-center gap-2 rounded-full border-2 border-[#1b1b18] bg-white px-6 py-2 text-[15px] font-medium text-[#1b1b18] transition-colors hover:bg-[#1b1b18] hover:text-white">
                            Article
                            <Icon icon="mdi:arrow-top-right" class="h-4 w-4" />
                        </button>
                    </div>
                    <div class="absolute left-10 -top-32 z-20">
                        <img src="/images/informasi.png" alt="Informasi" class="w-[600px] max-w-none" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Ulasan Section -->
        <section class="bg-white px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <h2 class="mb-12 text-left text-[32px] font-bold text-[#1b1b18]">
                    Ulasan Nyata dari Pengguna MediBot
                </h2>

                <div class="flex justify-between gap-4">
                    <!-- Card 1 -->
                    <div class="w-[350px] rounded-[20px] bg-[#FAF1FF] p-6">
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
                    <div class="w-[350px] rounded-[20px] bg-[#FAF1FF] p-6">
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
                    <div class="w-[350px] rounded-[20px] bg-[#FAF1FF] p-6">
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
