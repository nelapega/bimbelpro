
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { login } from '@/routes';
</script>

<template>
    <Head title="Pendaftaran Tidak Tersedia | BimbelPro" />

    <div class="flex min-h-screen items-center justify-center bg-[#F5F7FC] px-5 py-10">
        <div class="w-full max-w-md rounded-2xl border border-slate-100 bg-white p-8 text-center shadow-xl shadow-blue-100/40">

            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                <svg
                    class="h-9 w-9"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z" />
                    <path d="m9 12 2 2 4-4" />
                </svg>
            </div>

            <h1 class="text-2xl font-extrabold text-[#142B55]">
                Pendaftaran Tidak Tersedia
            </h1>

            <p class="mt-4 text-sm leading-7 text-slate-500">
                Akun BimbelPro dibuat langsung oleh Administrator.
                Silakan hubungi pengelola bimbingan belajar untuk
                mendapatkan akun.
            </p>

            <Link
                :href="login()"
                class="mt-8 inline-flex w-full justify-center rounded-xl bg-blue-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-100 transition hover:bg-blue-700"
            >
                Kembali ke Login
            </Link>

            <p class="mt-8 text-[10px] text-slate-400">
                © {{ new Date().getFullYear() }} BimbelPro.
                All rights reserved.
            </p>
        </div>
    </div>
</template>
