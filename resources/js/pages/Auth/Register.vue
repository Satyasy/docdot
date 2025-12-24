<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { ref } from 'vue';

const showPassword = ref(false);
const showConfirmPassword = ref(false);

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/register');
};
</script>

<template>
    <Head title="Sign Up" />
    <div class="flex h-screen items-center overflow-hidden" style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%);">
        <!-- Left Side - Sign Up Form -->
        <div class="flex flex-1 items-center pl-16">
            <div class="w-[550px] rounded-[30px] bg-white/50 p-10">
                <h1 class="text-[32px] font-bold text-[#1b1b18]" style="font-style: italic;">Sign up</h1>
                <p class="mt-1 text-[13px] text-[#1b1b18]/70">Let's get you all st up so you can access your personal account.</p>

                <form @submit.prevent="submit" class="mt-5 space-y-4">
                    <!-- First Name & Last Name -->
                    <div class="flex gap-3">
                        <div class="flex-1">
                            <label class="mb-1 block text-[11px] text-[#1b1b18]/60">First Name</label>
                            <input 
                                v-model="form.first_name"
                                type="text" 
                                placeholder="John"
                                class="w-full rounded-lg border border-[#1b1b18]/20 bg-transparent px-3 py-2 text-[13px] text-[#1b1b18] outline-none focus:border-[#43B3FC] focus:ring-0"
                            />
                            <p v-if="form.errors.first_name" class="mt-1 text-[11px] text-red-500">{{ form.errors.first_name }}</p>
                        </div>
                        <div class="flex-1">
                            <label class="mb-1 block text-[11px] text-[#1b1b18]/60">Last Name</label>
                            <input 
                                v-model="form.last_name"
                                type="text" 
                                placeholder="Doe"
                                class="w-full rounded-lg border border-[#1b1b18]/20 bg-transparent px-3 py-2 text-[13px] text-[#1b1b18] outline-none focus:border-[#43B3FC] focus:ring-0"
                            />
                            <p v-if="form.errors.last_name" class="mt-1 text-[11px] text-red-500">{{ form.errors.last_name }}</p>
                        </div>
                    </div>

                    <!-- Email & Phone Number -->
                    <div class="flex gap-3">
                        <div class="flex-1">
                            <label class="mb-1 block text-[11px] text-[#1b1b18]/60">Email</label>
                            <input 
                                v-model="form.email"
                                type="email" 
                                placeholder="john.doe@gmail.com"
                                class="w-full rounded-lg border border-[#1b1b18]/20 bg-transparent px-3 py-2 text-[13px] text-[#1b1b18] outline-none focus:border-[#43B3FC] focus:ring-0"
                            />
                            <p v-if="form.errors.email" class="mt-1 text-[11px] text-red-500">{{ form.errors.email }}</p>
                        </div>
                        <div class="flex-1">
                            <label class="mb-1 block text-[11px] text-[#1b1b18]/60">Phone Number</label>
                            <input 
                                v-model="form.phone"
                                type="tel" 
                                placeholder="08123456789"
                                class="w-full rounded-lg border border-[#1b1b18]/20 bg-transparent px-3 py-2 text-[13px] text-[#1b1b18] outline-none focus:border-[#43B3FC] focus:ring-0"
                            />
                            <p v-if="form.errors.phone" class="mt-1 text-[11px] text-red-500">{{ form.errors.phone }}</p>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="mb-1 block text-[11px] text-[#1b1b18]/60">Password</label>
                        <div class="relative">
                            <input 
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'" 
                                placeholder="••••••••••••••••••••"
                                class="w-full rounded-lg border border-[#1b1b18]/20 bg-transparent px-3 py-2 pr-10 text-[13px] text-[#1b1b18] outline-none focus:border-[#43B3FC] focus:ring-0"
                            />
                            <button 
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#1b1b18]/40"
                            >
                                <Icon :icon="showPassword ? 'mdi:eye' : 'mdi:eye-off'" class="h-4 w-4" />
                            </button>
                        </div>
                        <p v-if="form.errors.password" class="mt-1 text-[11px] text-red-500">{{ form.errors.password }}</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="mb-1 block text-[11px] text-[#1b1b18]/60">Confirm Password</label>
                        <div class="relative">
                            <input 
                                v-model="form.password_confirmation"
                                :type="showConfirmPassword ? 'text' : 'password'" 
                                placeholder="••••••••••••••••••••"
                                class="w-full rounded-lg border border-[#1b1b18]/20 bg-transparent px-3 py-2 pr-10 text-[13px] text-[#1b1b18] outline-none focus:border-[#43B3FC] focus:ring-0"
                            />
                            <button 
                                type="button"
                                @click="showConfirmPassword = !showConfirmPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#1b1b18]/40"
                            >
                                <Icon :icon="showConfirmPassword ? 'mdi:eye' : 'mdi:eye-off'" class="h-4 w-4" />
                            </button>
                        </div>
                        <p v-if="form.errors.password_confirmation" class="mt-1 text-[11px] text-red-500">{{ form.errors.password_confirmation }}</p>
                    </div>

                    <!-- Agree Terms -->
                    <div class="flex items-center gap-2">
                        <input 
                            type="checkbox" 
                            class="h-3 w-3 rounded border-[#1b1b18]/20"
                        />
                        <span class="text-[12px] text-[#1b1b18]">
                            I agree to all the <a href="#" class="text-[#FF7CEA]">Terms</a> and <a href="#" class="text-[#FF7CEA]">Privacy Policies</a>
                        </span>
                    </div>

                    <!-- Create Account Button -->
                    <button 
                        type="submit"
                        :disabled="form.processing"
                        class="w-full rounded-lg bg-[#8DD0FC] py-2 text-[14px] font-medium text-white transition-colors hover:bg-[#7BC5F0] disabled:opacity-50"
                    >
                        {{ form.processing ? 'Loading...' : 'Create account' }}
                    </button>

                    <!-- Login link -->
                    <p class="text-center text-[12px] text-[#1b1b18]">
                        Already have an account? <Link href="/login" class="text-[#FF7CEA]">Login</Link>
                    </p>

                    <!-- Divider -->
                    <div class="flex items-center gap-3">
                        <div class="h-px flex-1 bg-[#1b1b18]/10"></div>
                        <span class="text-[11px] text-[#1b1b18]/40">Or Sign up with</span>
                        <div class="h-px flex-1 bg-[#1b1b18]/10"></div>
                    </div>

                    <!-- Social Login -->
                    <div class="flex gap-3">
                        <button type="button" class="flex flex-1 items-center justify-center gap-2 rounded-lg border border-[#1b1b18]/10 bg-white py-2 transition-colors hover:bg-[#f5f5f5]">
                            <Icon icon="logos:facebook" class="h-4 w-4" />
                        </button>
                        <button type="button" class="flex flex-1 items-center justify-center gap-2 rounded-lg border border-[#1b1b18]/10 bg-white py-2 transition-colors hover:bg-[#f5f5f5]">
                            <Icon icon="logos:google-icon" class="h-4 w-4" />
                        </button>
                        <button type="button" class="flex flex-1 items-center justify-center gap-2 rounded-lg border border-[#1b1b18]/10 bg-white py-2 transition-colors hover:bg-[#f5f5f5]">
                            <Icon icon="logos:apple" class="h-4 w-4" />
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side - Robot Image -->
        <div class="relative flex flex-1 items-center justify-start pl-8">
            <!-- Purple circle background -->
            <div class="absolute left-0 top-1/2 h-[400px] w-[400px] -translate-y-1/2 rounded-full bg-[#DDB4F6]/50"></div>
            <img src="/images/login.png" alt="Robot" class="relative z-10 h-[500px] w-auto" />
        </div>
    </div>
</template>
