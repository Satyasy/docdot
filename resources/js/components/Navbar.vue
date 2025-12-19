<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

interface NavItem {
    label: string;
    href: string;
    active?: boolean;
}

const navItems: NavItem[] = [
    { label: 'Home', href: '/', active: true },
    { label: 'Features', href: '/features' },
    { label: 'Article', href: '/article' },
    { label: 'Consultation', href: '/consultation' },
];
</script>

<template>
    <nav class="relative w-full bg-white px-6 py-4 lg:px-12">
        <div class="mx-auto flex max-w-7xl items-center justify-between">
            <div class="text-[32px] font-bold text-[#1b1b18]">DocDot</div>

            <ul class="hidden items-center gap-8 md:flex">
                <li v-for="item in navItems" :key="item.label">
                    <Link
                        :href="item.href"
                        :class="[
                            'text-[25px] transition-colors',
                            item.active
                                ? 'bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] bg-clip-text font-semibold text-transparent'
                                : 'font-normal text-[#1b1b18] hover:text-[#F4AFE9]',
                        ]"
                    >
                        {{ item.label }}
                    </Link>
                </li>
            </ul>

            <Link
                href="/login"
                class="rounded-[20px] bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-14 py-3 text-[25px] font-normal text-[#1b1b18] transition-opacity hover:opacity-90"
            >
                Sign In
            </Link>
        </div>
        <div class="absolute bottom-0 left-0 h-[1px] w-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC]"></div>
    </nav>
</template>
