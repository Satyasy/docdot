<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import { Icon } from '@iconify/vue';
</script>

<template>
    <Head title="Article" />
    <div class="min-h-screen overflow-x-hidden" style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%);">
        <Navbar />

        <!-- Hero Section -->
        <section class="relative px-6 pt-16 pb-12 lg:px-12">
            <!-- Floating badge left -->
            <div class="absolute top-52 left-24 z-10 rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-6 py-2 text-[14px] font-medium text-white">
                DocDot
            </div>

            <!-- Floating badge right -->
            <div class="absolute top-32 right-24 z-10 rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-6 py-2 text-[14px] font-medium text-white">
                DocDot
            </div>

            <div class="mx-auto max-w-4xl text-center">
                <h1 class="text-[56px] font-medium leading-tight text-[#1b1b18]" style="font-style: italic;">
                    Cara lebih baik untuk belajar<br />soal <span style="background: linear-gradient(to right, #BF55FF 0%, #43B3FC 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">kesehatan</span>, setiap hari
                </h1>

                <p class="mt-6 text-[20px] font-light text-[#1b1b18]/80">
                    Temukan jawaban dan wawasan seputar kesehatan di artikel-artikel<br />pilihan kami. Singkat, jelas, terpercaya!
                </p>

                <!-- Search Box -->
                <div class="mx-auto mt-16 w-[550px] overflow-hidden rounded-full border border-[#E0E0E0] bg-white px-6 py-3">
                    <div class="flex items-center justify-between">
                        <input 
                            type="text" 
                            placeholder="Butuh info? Ketik topik di sini..."
                            class="w-full border-none bg-transparent text-[15px] text-[#1b1b18] placeholder-[#1b1b18]/40 outline-none focus:outline-none focus:ring-0"
                        />
                        <Icon icon="mdi:magnify" class="h-6 w-6 text-[#DDB4F6]" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Kategori Artikel Section -->
        <section class="bg-white px-6 py-12 lg:px-12">
            <h2 class="mb-8 text-center text-[36px] font-semibold text-[#1b1b18]" style="font-style: italic;">Kategori Artikel</h2>
            
            <!-- Category Tabs -->
            <div class="mb-10 flex justify-center gap-4">
                <button class="rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-6 py-2 text-[14px] font-medium text-white">
                    Berita & Update Kesehatan
                </button>
                <button class="rounded-full border border-[#1b1b18]/20 bg-white px-6 py-2 text-[14px] font-medium text-[#1b1b18]">
                    Edukasi Kesehatan
                </button>
                <button class="rounded-full border border-[#1b1b18]/20 bg-white px-6 py-2 text-[14px] font-medium text-[#1b1b18]">
                    Tips & Gaya Hidup Sehat
                </button>
                <button class="rounded-full border border-[#1b1b18]/20 bg-white px-6 py-2 text-[14px] font-medium text-[#1b1b18]">
                    Pencegahan & Perawatan
                </button>
            </div>

            <!-- Articles Grid -->
            <div class="mx-auto max-w-6xl">
                <div class="flex h-[450px] gap-6">
                    <!-- Main Article (Left) -->
                    <div class="relative flex-[2] overflow-hidden rounded-[20px]" style="background: linear-gradient(to right, #F4AFE9 0%, #8DD0FC 100%);">
                        <img src="https://picsum.photos/600/450?random=1" alt="Article" class="h-full w-full object-cover" />
                        <!-- Full shadow overlay -->
                        <div class="absolute inset-0" style="background: linear-gradient(to top, #005A94 0%, #007BCD 33%, rgba(141, 208, 252, 0.3) 66%, rgba(141, 208, 252, 0) 100%);"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <span class="mb-2 inline-block rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-3 py-1 text-[11px] font-medium text-white">
                                Berita & Update Kesehatan
                            </span>
                            <h3 class="text-[20px] font-semibold leading-tight text-white">
                                Biosecurity Jadi Pertahanan Baru, Menkes: Ancaman Kesehatan Lebih Berbahaya dari Perang Militer
                            </h3>
                            <p class="mt-2 flex items-center gap-1 text-[12px] text-white/80">
                                <Icon icon="mdi:calendar" class="h-4 w-4" />
                                20 Agustus 2025
                            </p>
                        </div>
                    </div>

                    <!-- Right Articles -->
                    <div class="flex flex-1 flex-col gap-3">
                        <!-- Article 1 -->
                        <div class="flex flex-1 gap-4 overflow-hidden rounded-[15px] bg-[#F8F8F8] p-3">
                            <div class="relative h-full w-[140px] flex-shrink-0 overflow-hidden rounded-[10px]">
                                <img src="https://picsum.photos/140/130?random=2" alt="Article" class="h-full w-full object-cover" />
                                <div class="absolute inset-0 rounded-[10px]" style="background: linear-gradient(to top, rgba(0, 90, 148, 0.5) 0%, rgba(0, 123, 205, 0.3) 50%, transparent 100%);"></div>
                            </div>
                            <div class="flex flex-1 flex-col justify-center">
                                <span class="mb-1 inline-block w-fit rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-3 py-1 text-[10px] font-medium text-white">
                                    Berita & Update Kesehatan
                                </span>
                                <h4 class="text-[14px] font-semibold leading-tight text-[#1b1b18]">
                                    Ini Capaian dan Temuan dalam Program Cek Kesehatan Gratis 2025
                                </h4>
                                <p class="mt-1 flex items-center gap-1 text-[11px] text-[#1b1b18]/60">
                                    <Icon icon="mdi:calendar" class="h-3 w-3" />
                                    20 Agustus 2025
                                </p>
                            </div>
                        </div>

                        <!-- Article 2 -->
                        <div class="flex flex-1 gap-4 overflow-hidden rounded-[15px] bg-[#F8F8F8] p-3">
                            <div class="relative h-full w-[140px] flex-shrink-0 overflow-hidden rounded-[10px]">
                                <img src="https://picsum.photos/140/130?random=3" alt="Article" class="h-full w-full object-cover" />
                                <div class="absolute inset-0 rounded-[10px]" style="background: linear-gradient(to top, rgba(0, 90, 148, 0.5) 0%, rgba(0, 123, 205, 0.3) 50%, transparent 100%);"></div>
                            </div>
                            <div class="flex flex-1 flex-col justify-center">
                                <span class="mb-1 inline-block w-fit rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-3 py-1 text-[10px] font-medium text-white">
                                    Berita & Update Kesehatan
                                </span>
                                <h4 class="text-[14px] font-semibold leading-tight text-[#1b1b18]">
                                    53 Juta Anak Sekolah Bakal di Skrining Kesehatan Mulai Juli 2025
                                </h4>
                                <p class="mt-1 flex items-center gap-1 text-[11px] text-[#1b1b18]/60">
                                    <Icon icon="mdi:calendar" class="h-3 w-3" />
                                    20 Agustus 2025
                                </p>
                            </div>
                        </div>

                        <!-- Article 3 -->
                        <div class="flex flex-1 gap-4 overflow-hidden rounded-[15px] bg-[#F8F8F8] p-3">
                            <div class="relative h-full w-[140px] flex-shrink-0 overflow-hidden rounded-[10px]">
                                <img src="https://picsum.photos/140/130?random=4" alt="Article" class="h-full w-full object-cover" />
                                <div class="absolute inset-0 rounded-[10px]" style="background: linear-gradient(to top, rgba(0, 90, 148, 0.5) 0%, rgba(0, 123, 205, 0.3) 50%, transparent 100%);"></div>
                            </div>
                            <div class="flex flex-1 flex-col justify-center">
                                <span class="mb-1 inline-block w-fit rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-3 py-1 text-[10px] font-medium text-white">
                                    Berita & Update Kesehatan
                                </span>
                                <h4 class="text-[14px] font-semibold leading-tight text-[#1b1b18]">
                                    Pemerintah Kuatkan Implementasi Germas Tahun 2025
                                </h4>
                                <p class="mt-1 flex items-center gap-1 text-[11px] text-[#1b1b18]/60">
                                    <Icon icon="mdi:calendar" class="h-3 w-3" />
                                    20 Agustus 2025
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Artikel Terpopuler Section -->
        <section class="px-6 py-16 lg:px-12">
            <h2 class="mb-10 text-center text-[36px] font-semibold text-[#1b1b18]" style="font-style: italic;">Artikel Terpopuler</h2>
            
            <div class="mx-auto flex max-w-6xl gap-6">
                <!-- Card 1 -->
                <div class="flex-1 overflow-hidden rounded-xl bg-white">
                    <img src="https://picsum.photos/400/200?random=10" alt="Article" class="h-[200px] w-full object-cover" />
                    <div class="p-5">
                        <div class="mb-3 flex items-center gap-3">
                            <span class="rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-3 py-1 text-[10px] font-medium text-white">
                                Tips & Gaya Hidup Sehat
                            </span>
                            <span class="flex items-center gap-1 text-[11px] text-[#1b1b18]/60">
                                <Icon icon="mdi:calendar" class="h-3 w-3" />
                                20 Agustus 2025
                            </span>
                        </div>
                        <h3 class="mb-2 text-[16px] font-semibold leading-tight text-[#1b1b18]">
                            Pemerintah Kuatkan Implementasi Germas Tahun 2025
                        </h3>
                        <p class="mb-4 text-[12px] leading-relaxed text-[#1b1b18]/70">
                            Dilansir dari Penn Medicine, jika imun tubuh menurun maka Anda akan lebih mudah terserang penyakit. Penyakit tersebut misalnya flu, mudah terserang infeksi, menjadi mudah lelah, hingga meningkatkan stres.
                        </p>
                        <button class="rounded-full border border-[#1b1b18]/20 px-4 py-2 text-[12px] font-medium text-[#1b1b18]">
                            Selengkapnya
                        </button>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="flex-1 overflow-hidden rounded-xl bg-white">
                    <img src="https://picsum.photos/400/200?random=11" alt="Article" class="h-[200px] w-full object-cover" />
                    <div class="p-5">
                        <div class="mb-3 flex items-center gap-3">
                            <span class="rounded-full bg-[#FF7CEA] px-3 py-1 text-[10px] font-medium text-white">
                                Edukasi Kesehatan
                            </span>
                            <span class="flex items-center gap-1 text-[11px] text-[#FF7CEA]">
                                <Icon icon="mdi:calendar" class="h-3 w-3" />
                                30 Oktober 2024
                            </span>
                        </div>
                        <h3 class="mb-2 text-[16px] font-semibold leading-tight text-[#1b1b18]">
                            Tampak Mirip, Ketahui Beda Gejala Virus Corona dengan Flu Biasa
                        </h3>
                        <p class="mb-4 text-[12px] leading-relaxed text-[#1b1b18]/70">
                            Akhir-akhir ini, masyarakat diselimuti kekhawatiran akibat wabah virus Corona. Pasalnya, infeksi yang menyerang sistem pernapasan ini memiliki gejala yang mirip dengan flu biasa, namun bisa berakibat fatal.
                        </p>
                        <button class="rounded-full border border-[#1b1b18]/20 px-4 py-2 text-[12px] font-medium text-[#1b1b18]">
                            Selengkapnya
                        </button>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="flex-1 overflow-hidden rounded-xl bg-white">
                    <img src="https://picsum.photos/400/200?random=12" alt="Article" class="h-[200px] w-full object-cover" />
                    <div class="p-5">
                        <div class="mb-3 flex items-center gap-3">
                            <span class="rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-3 py-1 text-[10px] font-medium text-white">
                                Tips & Gaya Hidup Sehat
                            </span>
                            <span class="flex items-center gap-1 text-[11px] text-[#1b1b18]/60">
                                <Icon icon="mdi:calendar" class="h-3 w-3" />
                                20 Agustus 2025
                            </span>
                        </div>
                        <h3 class="mb-2 text-[16px] font-semibold leading-tight text-[#1b1b18]">
                            Panduan Pola Makan Sehat untuk Usia Remaja
                        </h3>
                        <p class="mb-4 text-[12px] leading-relaxed text-[#1b1b18]/70">
                            Sebelum menjalani rangkaian pola makan sehat untuk anak remaja, Ibu perlu tahu berbagai kandungan gizi yang ia butuhkan.
                        </p>
                        <button class="rounded-full border border-[#1b1b18]/20 px-4 py-2 text-[12px] font-medium text-[#1b1b18]">
                            Selengkapnya
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5 Tips Kesehatan Harian Section -->
        <section class="px-6 py-16 lg:px-12">
            <h2 class="mb-10 text-center text-[36px] font-semibold text-[#1b1b18]" style="font-style: italic;">5 Tips Kesehatan Harian</h2>
            
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
                        <button class="mt-5 flex items-center gap-2 rounded-full border-2 border-[#1b1b18] bg-white px-6 py-2 text-[16px] font-medium text-[#1b1b18] transition-colors hover:bg-[#1b1b18] hover:text-white">
                            Chatbot
                            <Icon icon="mdi:arrow-top-right" class="h-5 w-5" />
                        </button>
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
