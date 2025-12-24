<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import Navbar from '@/components/Navbar.vue';

interface User {
    name: string;
    email: string;
    phone: string | null;
    email_verified_at: string | null;
    created_at: string;
}

interface Props {
    user: User;
}

const props = defineProps<Props>();

const formatDate = (date: string) => {
    return new Date(date).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    });
};
</script>

<template>
    <Head title="Profile - DocDot" />

    <div
        class="min-h-screen"
        style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%)"
    >
        <Navbar />

        <div class="px-6 py-12 lg:px-12">
            <div class="mx-auto max-w-2xl">
                <!-- Profile Card -->
                <div class="rounded-3xl bg-white/50 p-8 backdrop-blur-sm">
                    <!-- Avatar -->
                    <div class="mb-8 flex flex-col items-center">
                        <div class="flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC]">
                            <Icon icon="mdi:account" class="h-14 w-14 text-white" />
                        </div>
                        <h1 class="mt-4 text-[24px] font-bold text-[#1b1b18]">{{ user.name }}</h1>
                        <p class="text-[14px] text-[#1b1b18]/60">Member since {{ formatDate(user.created_at) }}</p>
                    </div>

                    <!-- Info List -->
                    <div class="space-y-4">
                        <!-- Full Name -->
                        <div class="flex items-center gap-4 rounded-xl bg-white p-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#F4AFE9]/20">
                                <Icon icon="mdi:account-outline" class="h-5 w-5 text-[#F4AFE9]" />
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18]/50">Full Name</p>
                                <p class="text-[15px] font-medium text-[#1b1b18]">{{ user.name }}</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-center gap-4 rounded-xl bg-white p-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#8DD0FC]/20">
                                <Icon icon="mdi:email-outline" class="h-5 w-5 text-[#8DD0FC]" />
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18]/50">Email</p>
                                <p class="text-[15px] font-medium text-[#1b1b18]">{{ user.email }}</p>
                            </div>
                            <div v-if="user.email_verified_at" class="flex items-center gap-1 rounded-full bg-green-100 px-3 py-1">
                                <Icon icon="mdi:check-circle" class="h-4 w-4 text-green-600" />
                                <span class="text-[11px] font-medium text-green-600">Verified</span>
                            </div>
                            <div v-else class="flex items-center gap-1 rounded-full bg-yellow-100 px-3 py-1">
                                <Icon icon="mdi:alert-circle" class="h-4 w-4 text-yellow-600" />
                                <span class="text-[11px] font-medium text-yellow-600">Not Verified</span>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-center gap-4 rounded-xl bg-white p-4">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DDB4F6]/20">
                                <Icon icon="mdi:phone-outline" class="h-5 w-5 text-[#DDB4F6]" />
                            </div>
                            <div class="flex-1">
                                <p class="text-[12px] text-[#1b1b18]/50">Phone Number</p>
                                <p class="text-[15px] font-medium text-[#1b1b18]">
                                    {{ user.phone || 'Not provided' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
