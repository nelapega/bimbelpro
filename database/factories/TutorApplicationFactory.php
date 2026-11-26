<?php

namespace Database\Factories;

use App\Models\TutorApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TutorApplication>
 */
class TutorApplicationFactory extends Factory
{
    protected $model = TutorApplication::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'education' => 'S1 Pendidikan - Universitas Negeri',
            'subject_specialization' => 'Matematika SMA',
            'experience_years' => '2 tahun',
            'motivation' => 'Berkomitmen mendidik siswa berprestasi di bidang sains.',
            'status' => 'menunggu',
        ];
    }
}
