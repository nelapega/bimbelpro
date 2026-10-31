
<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
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
        description: 'Silakan masuk menggunakan akun BimbelPro Anda.',
    },
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <Head title="Login BimbelPro" />

    <div
        v-if="status"
        class="mb-4 text-center text-sm font-medium text-green-600"
    >
        {{ status }}
    </div>

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold tracking-tight">
            BimbelPro
        </h1>

        <p class="mt-2 text-sm text-muted-foreground">
            Sistem Informasi Manajemen Bimbingan Belajar
        </p>

        <p class="mt-4 text-sm text-muted-foreground">
            Silakan masuk untuk melanjutkan ke akun Anda.
        </p>
    </div>

    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-6">

            <div class="grid gap-2">
                <Label for="email">Email</Label>

                <Input
                    id="email"
                    type="email"
                    name="email"
                    required
                    v-focus
                    :tabindex="1"
                    autocomplete="email"
                    placeholder="Masukkan email Anda"
                />

                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <Label for="password">Password</Label>

                    <TextLink
                        v-if="canResetPassword"
                        :href="request()"
                        class="text-sm"
                        :tabindex="5"
                    >
                        Lupa password?
                    </TextLink>
                </div>

                <PasswordInput
                    id="password"
                    name="password"
                    required
                    :tabindex="2"
                    autocomplete="current-password"
                    placeholder="Masukkan password"
                />

                <InputError :message="errors.password" />
            </div>

            <div class="flex items-center">
                <Label
                    for="remember"
                    class="flex items-center space-x-3"
                >
                    <Checkbox
                        id="remember"
                        name="remember"
                        :tabindex="3"
                    />

                    <span>Ingat saya</span>
                </Label>
            </div>

            <Button
                type="submit"
                class="mt-2 w-full"
                :tabindex="4"
                :disabled="processing"
                data-test="login-button"
            >
                <Spinner v-if="processing" />
                {{ processing ? 'Memproses...' : 'Masuk' }}
            </Button>

        </div>

        <div class="text-center text-sm text-muted-foreground">
            Akun BimbelPro dibuat oleh admin.
            Hubungi pengelola jika belum memiliki akun.
        </div>
    </Form>
</template>
