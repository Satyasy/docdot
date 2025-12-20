<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Navbar from '@/components/Navbar.vue';
import { BoltIcon, ClockIcon, BriefcaseIcon, MagnifyingGlassIcon, CpuChipIcon, LightBulbIcon, ArrowRightIcon } from '@heroicons/vue/24/outline';
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen bg-white">
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
                    <button
                        class="mt-8 flex items-center gap-2 rounded-full border-2 border-[#1b1b18] px-10 py-3 text-[20px] font-medium text-[#1b1b18] transition-colors hover:bg-[#1b1b18] hover:text-white"
                    >
                        ChatBot
                        <ArrowRightIcon class="h-5 w-5" />
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
                                <CpuChipIcon class="h-8 w-8 text-[#2D7BB8]" />
                            </div>
                            <h3 class="text-[20px] font-bold text-[#1b1b18]">AI Consultation</h3>
                            <p class="mt-2 text-[14px] leading-relaxed text-[#1b1b18]/80">
                                Konsultasikan keluhan penyakit Anda sekarang dan dapatkan solusi cepat dari MediBot, aman terpercaya.
                            </p>
                        </div>
                        <div class="max-w-[320px]">
                            <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/40">
                                <LightBulbIcon class="h-8 w-8 text-[#2D7BB8]" />
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
                                    <MagnifyingGlassIcon class="h-4 w-4" />
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

        <section class="px-6 py-16 lg:px-12">
            <div class="rounded-[30px] bg-gradient-to-r from-[#8DD0FC] to-[#DDB4F6] px-16 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl border-2 border-[#7D80DF] bg-transparent">
                            <BoltIcon class="h-6 w-6 text-[#43B3FC]" />
                        </div>
                        <span class="text-[18px] font-medium text-[#1b1b18]">Layanan yang cepat</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl border-2 border-[#7D80DF] bg-transparent">
                            <ClockIcon class="h-6 w-6 text-[#43B3FC]" />
                        </div>
                        <span class="text-[18px] font-medium text-[#1b1b18]">24 Jam</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl border-2 border-[#7D80DF] bg-transparent">
                            <BriefcaseIcon class="h-6 w-6 text-[#43B3FC]" />
                        </div>
                        <span class="text-[18px] font-medium text-[#1b1b18]">Konsultasi Gratis</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <div class="relative flex items-center justify-between">
                    <div class="relative flex items-center">
                        <div class="relative h-[380px] w-[220px] rounded-[30px] bg-[#43B3FC]/10">
                            <div class="absolute top-1/2 left-1/2 h-[200px] w-[2px] -translate-x-1/2 -translate-y-1/2 bg-[#43B3FC]/40"></div>
                            <div class="absolute top-1/2 left-1/2 h-3 w-3 -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#43B3FC]/60"></div>
                            <div class="absolute top-1/2 -left-8 flex h-16 w-16 -translate-y-1/2 rotate-[-15deg] items-center justify-center rounded-[14px] bg-[#7DD3FC]">
                                <MagnifyingGlassIcon class="h-8 w-8 text-white" />
                            </div>
                            <MagnifyingGlassIcon class="absolute bottom-4 left-4 h-6 w-6 text-[#1b1b18]/30" />
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

        <section class="px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-7xl text-center">
                <h2 class="text-[36px] font-bold text-[#1b1b18]">
                    Rasakan <span class="text-[#DDB4F6]">Fitur Kesehatan</span> Lengkap dengan<br />
                    Teknologi Pintar dari <span class="text-[#DDB4F6]">DocDot</span> Setiap Hari 🚀
                </h2>

                <div class="mt-12 flex items-stretch justify-center gap-6">
                    <div class="relative w-[320px] overflow-hidden rounded-[30px] bg-[#E8D4F8] p-6">
                        <div class="absolute top-0 right-0 h-full w-1/2 bg-[#D9B8F0]/50" style="transform: skewX(-15deg); transform-origin: top right;"></div>
                        <div class="relative z-10 mt-auto rounded-[20px] bg-white p-5">
                            <div class="flex items-start gap-3">
                                <img src="/images/time.png" alt="Time" class="h-12 w-12" />
                                <p class="text-left text-[14px] leading-relaxed text-[#1b1b18]/80">
                                    Tim kami siap merespon keluhan kesehatan mu dengan cepat, 24/7 tanpa harus menunggu lama.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-[320px] overflow-hidden rounded-[30px] bg-[#E8D4F8] p-6">
                        <div class="absolute top-0 right-0 h-full w-1/2 bg-[#D9B8F0]/50" style="transform: skewX(-15deg); transform-origin: top right;"></div>
                        <div class="relative z-10 mt-auto rounded-[20px] bg-white p-5">
                            <div class="flex items-start gap-3">
                                <img src="/images/chat.png" alt="Chat" class="h-12 w-12" />
                                <p class="text-left text-[14px] leading-relaxed text-[#1b1b18]/80">
                                    Konsultasi kesehatan tersedia kapan pun, siap melayani kamu siang dan malam tanpa henti.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="relative w-[320px] overflow-hidden rounded-[30px] bg-[#E8D4F8] p-6">
                        <div class="absolute top-0 right-0 h-full w-1/2 bg-[#D9B8F0]/50" style="transform: skewX(-15deg); transform-origin: top right;"></div>
                        <div class="relative z-10 mt-auto rounded-[20px] bg-white p-5">
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
    </div>
</template>
