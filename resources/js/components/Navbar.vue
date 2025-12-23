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
}

const navItems: NavItem[] = [
    { label: 'Home', href: '/' },
    { label: 'Features', href: '/features' },
    { label: 'Article', href: '/article' },
    { label: 'Consultation', href: '/consultation' },
];

const page = usePage<{ auth: { user: User | null } }>();
const currentPath = computed(() => page.url);
const user = computed(() => page.props.auth?.user as User | null);

const showDropdown = ref(false);

const isActive = (href: string) => {
    if (href === '/') {
        return currentPath.value === '/';
    }
    return currentPath.value.startsWith(href);
};

const logout = () => {
    showDropdown.value = false;
    router.post('/logout');
};

const toggleDropdown = () => {
    showDropdown.value = !showDropdown.value;
};
</script>

<template>
    <nav class="relative z-50 w-full bg-transparent px-6 py-4 lg:px-12">
        <div class="mx-auto flex max-w-7xl items-center justify-between">
            <Link href="/" class="text-[32px] font-bold text-[#1b1b18]">DocDot</Link>

            <ul class="hidden items-center gap-8 md:flex">
                <li v-for="item in navItems" :key="item.label">
                    <Link
                        :href="item.href"
                        :class="[
                            'text-[25px] transition-colors',
                            isActive(item.href)
                                ? 'bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] bg-clip-text font-semibold text-transparent'
                                : 'font-normal text-[#1b1b18] hover:text-[#F4AFE9]',
                        ]"
                    >
                        {{ item.label }}
                    </Link>
                </li>
            </ul>

            <!-- User Dropdown (when logged in) -->
            <div v-if="user" class="relative z-50">
                <button 
                    @click="toggleDropdown"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] transition-opacity hover:opacity-90"
                >
                    <Icon icon="mdi:account" class="h-7 w-7 text-[#1b1b18]" />
                </button>
                
                <!-- Dropdown Menu -->
                <div class="absolute right-0 z-50 mt-2 w-48 overflow-hidden">
                    <Transition
                        enter-active-class="transition-all duration-300 ease-out"
                        enter-from-class="max-h-0 opacity-0"
                        enter-to-class="max-h-40 opacity-100"
                        leave-active-class="transition-all duration-200 ease-in"
                        leave-from-class="max-h-40 opacity-100"
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
                            class="block px-4 py-2 text-[14px] text-[#1b1b18] transition-colors hover:bg-[#F4AFE9]/20"
                            @click="showDropdown = false"
                        >
                            Profile
                        </Link>
                        <button 
                            @click="logout"
                            class="block w-full px-4 py-2 text-left text-[14px] text-red-500 transition-colors hover:bg-red-50"
                        >
                            Logout
                        </button>
                        </div>
                    </Transition>
                </div>
            </div>

            <!-- Sign In Button (when not logged in) -->
            <Link
                v-else
                href="/login"
                class="rounded-[20px] bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] px-14 py-3 text-[25px] font-normal text-[#1b1b18] transition-opacity hover:opacity-90"
            >
                Sign In
            </Link>
        </div>
        <div class="absolute bottom-0 left-0 h-[1px] w-full bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC]"></div>
    </nav>
</template>
