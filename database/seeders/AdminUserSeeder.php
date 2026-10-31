<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('bimbelpro.admin.email');
        $password = config('bimbelpro.admin.password');

        if (!$email || !$password) {
            $this->command?->warn(
                'Konfigurasi akun admin belum diisi.'
            );

            return;
        }

        $admin = User::firstOrNew([
            'email' => $email,
        ]);

        $admin->name = config(
            'bimbelpro.admin.name',
            'Admin BimbelPro'
        );

        $admin->password = $password;
        $admin->role = 'admin';
        $admin->email_verified_at = now();

        $admin->save();
    }
}