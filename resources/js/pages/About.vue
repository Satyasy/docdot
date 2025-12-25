<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import { useScrollAnimation } from '@/composables/useScrollAnimation';

useScrollAnimation();

const team = [
    {
        name: 'Dr. Sarah Wijaya',
        role: 'Medical Advisor',
        image: 'https://i.pravatar.cc/200?img=32',
    },
    {
        name: 'Budi Santoso',
        role: 'Founder & CEO',
        image: 'https://i.pravatar.cc/200?img=12',
    },
    {
        name: 'Rina Kusuma',
        role: 'Lead Developer',
        image: 'https://i.pravatar.cc/200?img=25',
    },
    {
        name: 'Ahmad Fauzi',
        role: 'AI Engineer',
        image: 'https://i.pravatar.cc/200?img=8',
    },
];

const values = [
    {
        icon: 'mdi:shield-check',
        title: 'Terpercaya',
        description: 'Informasi kesehatan yang akurat dan terverifikasi oleh tenaga medis profesional.',
    },
    {
        icon: 'mdi:lock',
        title: 'Privasi Terjaga',
        description: 'Data kesehatan Anda dilindungi dengan enkripsi tingkat tinggi.',
    },
    {
        icon: 'mdi:access-point',
        title: 'Mudah Diakses',
        description: 'Akses layanan kesehatan kapan saja dan di mana saja.',
    },
    {
        icon: 'mdi:heart',
        title: 'Peduli',
        description: 'Kami berkomitmen untuk meningkatkan kualitas kesehatan masyarakat Indonesia.',
    },
];
</script>

<template>
    <Head title="Tentang Kami - DocDot" />

    <div class="min-h-screen font-[Poppins]" style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%)">
        <Navbar />

        <!-- Hero Section -->
        <section class="px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-5xl text-center">
                <h1 class="scroll-animate text-[36px] font-bold text-[#1b1b18] lg:text-[48px]">
                    Tentang <span class="bg-gradient-to-r from-[#BF55FF] to-[#43B3FC] bg-clip-text text-transparent">DocDot</span>
                </h1>
                <p class="scroll-animate scroll-animate-delay-1 mx-auto mt-4 max-w-2xl text-[16px] text-[#1b1b18]/70 lg:text-[18px]">
                    DocDot adalah platform kesehatan digital yang membantu masyarakat Indonesia mendapatkan informasi dan konsultasi kesehatan yang mudah, cepat, dan terpercaya.
                </p>
            </div>
        </section>

        <!-- Story Section -->
        <section class="bg-white px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <div class="scroll-animate">
                        <h2 class="text-[28px] font-bold text-[#1b1b18] lg:text-[36px]">Cerita Kami</h2>
                        <p class="mt-4 text-[14px] leading-relaxed text-[#1b1b18]/70 lg:text-[16px]">
                            DocDot lahir dari keprihatinan akan akses kesehatan yang masih terbatas di Indonesia. Banyak masyarakat yang kesulitan mendapatkan informasi kesehatan yang akurat atau harus menempuh jarak jauh untuk konsultasi medis.
                        </p>
                        <p class="mt-4 text-[14px] leading-relaxed text-[#1b1b18]/70 lg:text-[16px]">
                            Dengan memanfaatkan teknologi AI dan database medis yang komprehensif, DocDot hadir sebagai solusi untuk memberikan akses kesehatan yang lebih mudah dan terjangkau bagi semua orang.
                        </p>
                        <div class="mt-8 flex flex-wrap gap-8">
                            <div>
                                <p class="text-[32px] font-bold text-[#43B3FC]">10K+</p>
                                <p class="text-[14px] text-[#1b1b18]/60">Pengguna Aktif</p>
                            </div>
                            <div>
                                <p class="text-[32px] font-bold text-[#BF55FF]">50K+</p>
                                <p class="text-[14px] text-[#1b1b18]/60">Konsultasi</p>
                            </div>
                            <div>
                                <p class="text-[32px] font-bold text-[#F4AFE9]">100+</p>
                                <p class="text-[14px] text-[#1b1b18]/60">Artikel Kesehatan</p>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-animate scroll-animate-delay-2">
                        <img 
                            src="/images/hero.png" 
                            alt="DocDot App" 
                            class="w-full max-w-md mx-auto"
                            style="filter: drop-shadow(0 25px 50px rgba(141, 208, 252, 0.3))"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <h2 class="scroll-animate mb-12 text-center text-[28px] font-bold text-[#1b1b18] lg:text-[36px]">
                    Nilai-Nilai Kami
                </h2>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div 
                        v-for="(value, index) in values" 
                        :key="value.title"
                        class="scroll-animate rounded-2xl bg-white p-6"
                        :class="`scroll-animate-delay-${index + 1}`"
                    >
                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-r from-[#F4AFE9]/30 to-[#8DD0FC]/30">
                            <Icon :icon="value.icon" class="h-7 w-7 text-[#43B3FC]" />
                        </div>
                        <h3 class="text-[18px] font-semibold text-[#1b1b18]">{{ value.title }}</h3>
                        <p class="mt-2 text-[14px] text-[#1b1b18]/70">{{ value.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="bg-white px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <h2 class="scroll-animate mb-4 text-center text-[28px] font-bold text-[#1b1b18] lg:text-[36px]">
                    Tim Kami
                </h2>
                <p class="scroll-animate mx-auto mb-12 max-w-2xl text-center text-[14px] text-[#1b1b18]/70 lg:text-[16px]">
                    Dibangun oleh tim profesional yang berdedikasi untuk meningkatkan kesehatan masyarakat Indonesia
                </p>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div 
                        v-for="(member, index) in team" 
                        :key="member.name"
                        class="scroll-animate text-center"
                        :class="`scroll-animate-delay-${index + 1}`"
                    >
                        <img 
                            :src="member.image" 
                            :alt="member.name"
                            class="mx-auto h-32 w-32 rounded-full object-cover ring-4 ring-white shadow-lg"
                        />
                        <h3 class="mt-4 text-[16px] font-semibold text-[#1b1b18]">{{ member.name }}</h3>
                        <p class="text-[13px] text-[#1b1b18]/60">{{ member.role }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="px-6 py-16 lg:px-12">
            <div class="mx-auto max-w-4xl">
                <div class="scroll-animate rounded-3xl bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] p-8 text-center lg:p-12">
                    <h2 class="text-[24px] font-bold text-white lg:text-[32px]">
                        Mulai Perjalanan Kesehatan Anda
                    </h2>
                    <p class="mx-auto mt-4 max-w-xl text-[14px] text-white/90 lg:text-[16px]">
                        Bergabunglah dengan ribuan pengguna DocDot dan dapatkan akses ke konsultasi kesehatan AI, artikel terpercaya, dan katalog obat lengkap.
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <Link 
                            href="/register"
                            class="rounded-full bg-white px-8 py-3 text-[14px] font-medium text-[#1b1b18] transition-all hover:shadow-lg"
                        >
                            Daftar Gratis
                        </Link>
                        <Link 
                            href="/consultation"
                            class="rounded-full border-2 border-white px-8 py-3 text-[14px] font-medium text-white transition-all hover:bg-white hover:text-[#1b1b18]"
                        >
                            Coba Konsultasi
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <Footer />
    </div>
</template>
