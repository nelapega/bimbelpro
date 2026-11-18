<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $password = config('bimbelpro.admin.password');

        if (empty($password)) {
            throw new RuntimeException(
                'BIMBELPRO_ADMIN_PASSWORD belum diatur di file .env.'
            );
        }

        $admin = User::firstOrNew([
            'email' => config('bimbelpro.admin.email'),
        ]);

        $admin->name = config('bimbelpro.admin.name');
        $admin->password = $password;
        $admin->role = 'admin';
        $admin->email_verified_at = now();

        $admin->save();
    }
}
