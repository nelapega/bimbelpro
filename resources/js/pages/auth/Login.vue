<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineOptions({
    layout: {
        title: 'Masuk ke BimbelPro',
        description: 'Gunakan akun terdaftar Anda untuk mengelola bimbingan belajar.',
    },
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <Head title="Masuk | BimbelPro" />

    <!-- SUCCESS MESSAGE -->
    <div
        v-if="status"
        class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700"
    >
        {{ status }}
    </div>

    <!-- LOGIN FORM -->
    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-5">

            <!-- EMAIL -->
            <div class="grid gap-2">
                <Label for="email" class="text-xs font-bold text-slate-700">
                    Alamat Email
                </Label>

                <Input
                    id="email"
                    type="email"
                    name="email"
                    required
                    v-focus
                    :tabindex="1"
                    autocomplete="email"
                    placeholder="nama@bimbelpro.com"
                    class="h-12 rounded-xl border-slate-200 bg-white px-4 text-sm shadow-none transition placeholder:text-slate-400 focus-visible:border-purple-500 focus-visible:ring-purple-100"
                />

                <InputError :message="errors.email" />
            </div>

            <!-- PASSWORD -->
            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <Label for="password" class="text-xs font-bold text-slate-700">
                        Kata Sandi
                    </Label>

                    <TextLink
                        v-if="canResetPassword"
                        :href="request()"
                        class="text-xs font-semibold text-purple-600 transition hover:text-purple-800"
                        :tabindex="5"
                    >
                        Lupa sandi?
                    </TextLink>
                </div>

                <PasswordInput
                    id="password"
                    name="password"
                    required
                    :tabindex="2"
                    autocomplete="current-password"
                    placeholder="Masukkan kata sandi akun"
                    class="h-12 rounded-xl border-slate-200 focus-visible:border-purple-500 focus-visible:ring-purple-100"
                />

                <InputError :message="errors.password" />
            </div>

            <!-- REMEMBER ME -->
            <div class="flex items-center gap-2">
                <Checkbox id="remember" name="remember" :tabindex="3" />
                <Label for="remember" class="cursor-pointer text-xs font-medium text-slate-500">
                    Ingat saya di perangkat ini
                </Label>
            </div>

            <!-- LOGIN BUTTON -->
            <Button
                type="submit"
                class="mt-2 h-12 w-full rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-sm font-bold text-white shadow-lg shadow-purple-500/25 transition hover:brightness-110"
                :tabindex="4"
                :disabled="processing"
                data-test="login-button"
            >
                <Spinner v-if="processing" />
                {{ processing ? 'Memverifikasi Akun...' : 'Masuk ke Sistem' }}
            </Button>
        </div>

        <!-- BOTTOM INFORMATION & CALON TUTOR CTA -->
        <div class="rounded-2xl border border-purple-100 bg-purple-50/70 p-4">
            <div class="flex items-start gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-purple-200/70 text-purple-700">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z" />
                        <path d="m9 12 2 2 4-4" />
                    </svg>
                </div>

                <div>
                    <p class="text-xs font-bold text-purple-950">
                        Khusus Pengguna Terdaftar
                    </p>
                    <p class="mt-1 text-[11px] leading-5 text-purple-800/80">
                        Akun Admin dan Tutor diterbitkan oleh sistem BimbelPro. Belum memiliki akun pengajar?
                    </p>
                    <div class="mt-2">
                        <Link href="/daftar-tutor" class="text-xs font-extrabold text-purple-700 hover:text-purple-900 underline">
                            Ajukan Pendaftaran Jadi Calon Tutor →
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </Form>
</template>
