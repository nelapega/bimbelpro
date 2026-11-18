<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class TutorUserSeeder extends Seeder
{
    public function run(): void
    {
        $password = config('bimbelpro.tutor.password');

        if (empty($password)) {
            throw new RuntimeException(
                'BIMBELPRO_TUTOR_PASSWORD belum diatur di file .env.'
            );
        }

        $tutor = User::firstOrNew([
            'email' => config('bimbelpro.tutor.email'),
        ]);

        $tutor->name = config('bimbelpro.tutor.name');
        $tutor->password = $password;
        $tutor->role = 'tutor';
        $tutor->email_verified_at = now();

        $tutor->save();
    }
}
