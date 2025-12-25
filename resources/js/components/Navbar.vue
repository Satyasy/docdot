<script setup lang="ts">
import { Link, usePage, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Icon } from '@iconify/vue';

interface NavItem {
    label: string;
    href: string;
}

interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string | null;
    photo_profile: string | null;
}

const navItems: NavItem[] = [
    { label: 'Home', href: '/' },
    { label: 'Article', href: '/article' },
    { label: 'Drug Catalog', href: '/drug-catalog' },
    { label: 'Consultation', href: '/consultation' },
];

const page = usePage<{ auth: { user: User | null } }>();
const currentPath = computed(() => page.url);
const user = computed(() => page.props.auth?.user as User | null);
const isVerified = computed(() => user.value?.email_verified_at !== null);

const showDropdown = ref(false);
const showMobileMenu = ref(false);

const isActive = (href: string) => {
    if (href === '/') {
        return currentPath.value === '/';
    }
    return currentPath.value.startsWith(href);
};

const logout = () => {
    showDropdown.value = false;
    showMobileMenu.value = false;
    router.post('/logout');
};

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};

const toggleMobileMenu = () => {
    showMobileMenu.value = !showMobileMenu.value;
};
</script>

<template>
    <nav class="relative z-50 w-full bg-transparent px-6 py-4 lg:px-12">
        <div class="mx-auto flex max-w-7xl items-center justify-between">
            <Link href="/" class="flex items-center gap-2">
                <img src="/images/logo.png" alt="DocDot" class="h-12 w-auto lg:h-14" />
            </Link>

            <!-- Desktop Navigation -->
            <ul class="hidden items-center gap-6 lg:flex xl:gap-8">
                <li v-for="item in navItems" :key="item.label">
                    <Link
                        :href="item.href"
                        :class="[
                            'text-[18px] transition-colors xl:text-[20px]',
                            isActive(item.href)
                                ? 'bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] bg-clip-text font-semibold text-transparent'
                                : 'font-normal text-[#1b1b18] hover:text-[#F4AFE9]',
                        ]"
                    >
                        {{ item.label }}
                    </Link>
                </li>
            </ul>

            <div class="flex items-center gap-3">
                <!-- User Dropdown (when logged in AND verified) -->
                <div v-if="user && isVerified" class="relative z-50 hidden md:block">
                    <button 
                        @click="toggleDropdown"
                        class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] transition-opacity hover:opacity-90 lg:h-12 lg:w-12"
                    >
                        <img 
                            v-if="user.photo_profile" 
                            :src="'/storage/' + user.photo_profile" 
                            :alt="user.name" 
                            class="h-full w-full object-cover" 
                        />
                        <Icon v-else icon="mdi:account" class="h-5 w-5 text-[#1b1b18] lg:h-7 lg:w-7" />
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 z-50 mt-2 min-w-max overflow-hidden">
                        <Transition
                            enter-active-class="transition-all duration-300 ease-out"
                            enter-from-class="max-h-0 opacity-0"
                            enter-to-class="max-h-60 opacity-100"
                            leave-active-class="transition-all duration-200 ease-in"
                            leave-from-class="max-h-60 opacity-100"
                            leave-to-class="max-h-0 opacity-0"
                        >
                            <div 
                                v-if="showDropdown"
                                class="origin-top rounded-xl bg-white py-2 shadow-lg"
                            >
                                <div class="border-b border-gray-100 px-4 py-2">
                                    <p class="text-[14px] font-medium text-[#1b1b18]">{{ user.name }}</p>
                                    <p class="text-[12px] text-[#1b1b18]/60">{{ user.email }}</p>
                                </div>
                                <Link 
                                    href="/profile" 
                                    class="flex items-center gap-2 px-4 py-2 text-[14px] text-[#1b1b18] transition-colors hover:bg-[#F4AFE9]/20"
                                    @click="showDropdown = false"
                                >
                                    <Icon icon="mdi:account-outline" class="h-4 w-4" />
                                    Profile
                                </Link>
                                <Link 
                                    href="/health-dashboard" 
                                    class="flex items-center gap-2 px-4 py-2 text-[14px] text-[#1b1b18] transition-colors hover:bg-[#43B3FC]/20"
                                    @click="showDropdown = false"
                                >
                                    <Icon icon="mdi:heart-pulse" class="h-4 w-4" />
                                    Health Dashboard
                                </Link>
                                <Link 
                                    href="/chat-history" 
                                    class="flex items-center gap-2 px-4 py-2 text-[14px] text-[#1b1b18] transition-colors hover:bg-[#8DD0FC]/20"
                                    @click="showDropdown = false"
                                >
                                    <Icon icon="mdi:history" class="h-4 w-4" />
                                    Riwayat Chat
                                </Link>
                                <Link 
                                    href="/drug-catalog" 
                                    class="flex items-center gap-2 px-4 py-2 text-[14px] text-[#1b1b18] transition-colors hover:bg-[#DDB4F6]/20"
                                    @click="showDropdown = false"
                                >
                                    <Icon icon="mdi:pill" class="h-4 w-4" />
                                    Katalog Obat
                                </Link>
                                <button 
                                    @click="logout"
                                    class="flex w-full items-center gap-2 px-4 py-2 text-left text-[14px] text-red-500 transition-colors hover:bg-red-50"
                                >
                                    <Icon icon="mdi:logout" class="h-4 w-4" />
                                    Logout
                                </button>
                            </div>
                        </Transition>
                    </div>
                </div>

                <!-- Sign In Button (when not logged in OR not verified) - Desktop -->
                <Link
                    v-else
                    href="/login"
                    class="hidden rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-8 py-2 text-[16px] font-medium text-[#1b1b18] transition-opacity hover:opacity-90 md:block lg:px-10 lg:py-3 lg:text-[18px]"
                >
                    Sign In
                </Link>

                <!-- Mobile Menu Button -->
                <button 
                    @click="toggleMobileMenu"
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-r from-[#F4AFE9]/20 to-[#8DD0FC]/20 lg:hidden"
                >
                    <Icon :icon="showMobileMenu ? 'mdi:close' : 'mdi:menu'" class="h-6 w-6 text-[#1b1b18]" />
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 -translate-y-4"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-4"
        >
            <div 
                v-if="showMobileMenu"
                class="absolute left-0 right-0 top-full z-40 border-b border-[#F4AFE9]/30 bg-white/95 px-6 py-4 shadow-lg backdrop-blur-sm lg:hidden"
            >
                <!-- User info if logged in -->
                <div v-if="user && isVerified" class="mb-4 rounded-xl bg-gradient-to-r from-[#F4AFE9]/10 to-[#8DD0FC]/10 p-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC]">
                            <img 
                                v-if="user.photo_profile" 
                                :src="'/storage/' + user.photo_profile" 
                                :alt="user.name" 
                                class="h-full w-full object-cover" 
                            />
                            <Icon v-else icon="mdi:account" class="h-5 w-5 text-white" />
                        </div>
                        <div>
                            <p class="text-[14px] font-medium text-[#1b1b18]">{{ user.name }}</p>
                            <p class="text-[12px] text-[#1b1b18]/60">{{ user.email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <ul class="space-y-1">
                    <li v-for="item in navItems" :key="item.label">
                        <Link
                            :href="item.href"
                            @click="showMobileMenu = false"
                            :class="[
                                'flex items-center gap-3 rounded-xl px-4 py-3 text-[16px] transition-colors',
                                isActive(item.href)
                                    ? 'bg-gradient-to-r from-[#F4AFE9]/20 to-[#8DD0FC]/20 font-semibold text-[#1b1b18]'
                                    : 'font-normal text-[#1b1b18]/80 hover:bg-[#F8F8F8]',
                            ]"
                        >
                            {{ item.label }}
                        </Link>
                    </li>
                </ul>

                <!-- User Actions if logged in -->
                <div v-if="user && isVerified" class="mt-4 space-y-1 border-t border-[#1b1b18]/10 pt-4">
                    <Link 
                        href="/profile" 
                        @click="showMobileMenu = false"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-[16px] text-[#1b1b18]/80 transition-colors hover:bg-[#F8F8F8]"
                    >
                        <Icon icon="mdi:account-outline" class="h-5 w-5" />
                        Profile
                    </Link>
                    <Link 
                        href="/health-dashboard" 
                        @click="showMobileMenu = false"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-[16px] text-[#1b1b18]/80 transition-colors hover:bg-[#F8F8F8]"
                    >
                        <Icon icon="mdi:heart-pulse" class="h-5 w-5" />
                        Health Dashboard
                    </Link>
                    <Link 
                        href="/chat-history" 
                        @click="showMobileMenu = false"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 text-[16px] text-[#1b1b18]/80 transition-colors hover:bg-[#F8F8F8]"
                    >
                        <Icon icon="mdi:history" class="h-5 w-5" />
                        Riwayat Chat
                    </Link>
                    <button 
                        @click="logout"
                        class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-[16px] text-red-500 transition-colors hover:bg-red-50"
                    >
                        <Icon icon="mdi:logout" class="h-5 w-5" />
                        Logout
                    </button>
                </div>

                <!-- Sign In Button if not logged in -->
                <div v-else class="mt-4 border-t border-[#1b1b18]/10 pt-4">
                    <Link
                        href="/login"
                        @click="showMobileMenu = false"
                        class="flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] py-3 text-[16px] font-medium text-[#1b1b18]"
                    >
                        Sign In
                    </Link>
                </div>
            </div>
        </Transition>

        <div class="absolute bottom-0 left-0 h-[1px] w-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC]"></div>
    </nav>
</template>
