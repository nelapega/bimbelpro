<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { BookOpen, CalendarClock, CreditCard, Trophy, ArrowRight, Bell } from '@lucide/vue';
</script>

<template>
    <Head title="Dashboard - BimbelPro" />

    <AppLayout>
        <div class="flex-1 p-8 bg-[#F8FAFC] min-h-screen">
            
            <!-- Bagian Header (Selamat Datang) -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#1E293B]">Selamat Datang, Nayla! 👋</h1>
                <p class="text-[#64748B] mt-1">Semangat terus belajar di BimbelPro!</p>
            </div>

            <!-- Banner Pengingat Jadwal -->
            <div class="bg-gradient-to-r from-[#3B82F6] to-[#2563EB] rounded-2xl p-6 text-white mb-8 flex justify-between items-center shadow-lg">
                <div class="flex items-center gap-6">
                    <div class="bg-white/20 p-4 rounded-xl">
                        <BookOpen class="w-12 h-12 text-white" />
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold mb-2">Jangan lupa kelas Matematika hari ini ya!</h2>
                        <div class="flex items-center gap-2 text-blue-100">
                            <CalendarClock class="w-4 h-4" />
                            <span>Selasa, 28 Oktober 2025 - 16.00 WIB</span>
                        </div>
                    </div>
                </div>
                <button class="bg-white text-blue-600 px-6 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors flex items-center gap-2">
                    Lihat Jadwal <ArrowRight class="w-4 h-4" />
                </button>
            </div>

            <!-- 4 Kartu Statistik -->
            <div class="grid grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-2">
                    <div class="bg-blue-100 w-12 h-12 rounded-xl flex items-center justify-center mb-2">
                        <BookOpen class="w-6 h-6 text-blue-600" />
                    </div>
                    <p class="text-sm font-medium text-gray-500">Kelas Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-800">3</h3>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-2">
                    <div class="bg-purple-100 w-12 h-12 rounded-xl flex items-center justify-center mb-2">
                        <CalendarClock class="w-6 h-6 text-purple-600" />
                    </div>
                    <p class="text-sm font-medium text-gray-500">Jadwal Mendatang</p>
                    <h3 class="text-2xl font-bold text-gray-800">2</h3>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-2">
                    <div class="bg-green-100 w-12 h-12 rounded-xl flex items-center justify-center mb-2">
                        <CreditCard class="w-6 h-6 text-green-600" />
                    </div>
                    <p class="text-sm font-medium text-gray-500">Pembayaran</p>
                    <h3 class="text-2xl font-bold text-gray-800">1</h3>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-2">
                    <div class="bg-orange-100 w-12 h-12 rounded-xl flex items-center justify-center mb-2">
                        <Trophy class="w-6 h-6 text-orange-600" />
                    </div>
                    <p class="text-sm font-medium text-gray-500">Rata-rata Nilai</p>
                    <h3 class="text-2xl font-bold text-gray-800">90</h3>
                </div>
            </div>

            <!-- Bagian Bawah: Kelas Saya & Pengumuman -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Kolom Kelas Saya -->
                <div class="col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Kelas Saya</h3>
                        <a href="#" class="text-sm text-blue-600 font-medium hover:underline flex items-center gap-1">Lihat Semua <ArrowRight class="w-3 h-3" /></a>
                    </div>
                    
                    <div class="border border-gray-100 rounded-xl p-5 flex items-center justify-between hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <BookOpen class="w-8 h-8 text-blue-600" />
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-lg">Matematika SMA</h4>
                                <p class="text-sm text-gray-500">Bersama Kak Rina</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-2 w-1/3">
                            <span class="text-sm font-bold text-blue-600">75%</span>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                            <button class="mt-2 bg-blue-600 text-white text-sm px-4 py-2 rounded-lg font-medium hover:bg-blue-700">Lanjut Belajar →</button>
                        </div>
                    </div>
                </div>

                <!-- Kolom Pengumuman -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2"><Bell class="w-5 h-5 text-gray-400"/> Pengumuman</h3>
                        <a href="#" class="text-sm text-blue-600 font-medium hover:underline flex items-center gap-1">Lihat Semua <ArrowRight class="w-3 h-3" /></a>
                    </div>
                    
                    <ul class="space-y-4">
                        <li class="flex gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mt-2"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Jadwal kelas IPA minggu ini</p>
                                <p class="text-xs text-gray-400 mt-1">27 Okt 2025</p>
                            </div>
                        </li>
                        <li class="flex gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mt-2"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Pembayaran bulan depan</p>
                                <p class="text-xs text-gray-400 mt-1">25 Okt 2025</p>
                            </div>
                        </li>
                        <li class="flex gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 mt-2"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Pengumuman lomba akademik</p>
                                <p class="text-xs text-gray-400 mt-1">20 Okt 2025</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </AppLayout>
</template>