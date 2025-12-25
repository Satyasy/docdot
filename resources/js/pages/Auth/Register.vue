<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
import { ref, computed } from 'vue';

const showPassword = ref(false);
const showConfirmPassword = ref(false);
const agreeTerms = ref(false);

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
});

const canSubmit = computed(() => agreeTerms.value && !form.processing);

const submit = () => {
    if (!agreeTerms.value) return;
    form.post('/register');
};
</script>

<template>
    <Head title="Sign Up" />
    <div class="flex min-h-screen items-center justify-center overflow-hidden px-4 py-8" style="background: linear-gradient(to left, rgba(141, 208, 252, 0.6) 0%, rgba(221, 180, 246, 0.6) 100%);">
        <!-- Centered Sign Up Form -->
        <div class="flex w-full max-w-5xl items-center justify-center gap-12">
            <!-- Left - Logo (hidden on mobile) -->
            <div class="relative hidden flex-shrink-0 items-center justify-center lg:flex">
                <div class="absolute h-[350px] w-[350px] rounded-full bg-[#DDB4F6]/30"></div>
                <div class="absolute h-[260px] w-[260px] rounded-full bg-[#8DD0FC]/20"></div>
                <img src="/images/logo.png" alt="DocDot" class="relative z-10 h-[220px] w-auto drop-shadow-2xl" />
            </div>

            <!-- Form Card -->
            <div class="w-full max-w-[500px] rounded-[30px] bg-white/50 p-8 backdrop-blur-sm lg:p-10">
                <h1 class="text-[28px] font-bold text-[#1b1b18] lg:text-[32px]">Sign up</h1>
                <p class="mt-1 text-[13px] text-[#1b1b18]/70">Let's get you all set up so you can access your personal account.</p>

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
                            v-model="agreeTerms"
                            type="checkbox" 
                            class="h-3 w-3 rounded border-[#1b1b18]/20 text-[#8DD0FC] focus:ring-[#8DD0FC]"
                        />
                        <span class="text-[12px] text-[#1b1b18]">
                            I agree to all the <a href="#" class="text-[#FF7CEA]">Terms</a> and <a href="#" class="text-[#FF7CEA]">Privacy Policies</a>
                        </span>
                    </div>

                    <!-- Create Account Button -->
                    <button 
                        type="submit"
                        :disabled="!canSubmit"
                        :class="[
                            'w-full rounded-lg py-2 text-[14px] font-medium transition-all duration-300',
                            canSubmit 
                                ? 'bg-gradient-to-r from-[#F4AFE9] to-[#8DD0FC] text-white shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98]' 
                                : 'bg-[#8DD0FC]/40 text-white/70 cursor-not-allowed'
                        ]"
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
                        <a 
                            href="/auth/google" 
                            class="flex flex-1 items-center justify-center gap-2 rounded-lg border border-[#1b1b18]/10 bg-white py-2 transition-all hover:bg-[#f5f5f5] hover:shadow-md"
                        >
                            <Icon icon="logos:google-icon" class="h-4 w-4" />
                            <span class="text-[12px] font-medium text-[#1b1b18]">Google</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
