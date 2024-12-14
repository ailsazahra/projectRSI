<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;


class AppointmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('appointments')->insert([
            [
                'mentor_name' => 'Jung Jaehyun',
                'expertise' => 'UI/UX DESIGN',
                'date' => '2024-11-20',
                'time_start' => '10:00:00',
                'time_end' => '12:00:00',
                'quota' => 5,
                'booked' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_name' => 'Kim Doyoung',
                'expertise' => 'Frontend Development',
                'date' => '2024-11-21',
                'time_start' => '13:00:00',
                'time_end' => '15:00:00',
                'quota' => 10,
                'booked' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_name' => 'Kim Dohoon',
                'expertise' => 'Backend Development',
                'date' => '2024-11-22',
                'time_start' => '09:00:00',
                'time_end' => '11:00:00',
                'quota' => 8,
                'booked' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_name' => 'Sim Jake',
                'expertise' => 'UI/UX DESIGN',
                'date' => '2024-11-20',
                'time_start' => '11:30:00',
                'time_end' => '13:30:00',
                'quota' => 6,
                'booked' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_name' => 'Lee Haechan',
                'expertise' => 'Frontend Development',
                'date' => '2024-11-21',
                'time_start' => '14:00:00',
                'time_end' => '16:00:00',
                'quota' => 4,
                'booked' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_name' => 'Kim Jungwoo',
                'expertise' => 'Backend Development',
                'date' => '2024-11-22',
                'time_start' => '10:30:00',
                'time_end' => '12:30:00',
                'quota' => 7,
                'booked' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_name' => 'Mark Lee',
                'expertise' => 'UI/UX DESIGN',
                'date' => '2024-11-20',
                'time_start' => '15:00:00',
                'time_end' => '17:00:00',
                'quota' => 10,
                'booked' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_name' => 'Chenle',
                'expertise' => 'Frontend Development',
                'date' => '2024-11-21',
                'time_start' => '12:00:00',
                'time_end' => '14:00:00',
                'quota' => 6,
                'booked' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_name' => 'Renjun',
                'expertise' => 'Backend Development',
                'date' => '2024-11-22',
                'time_start' => '08:00:00',
                'time_end' => '10:00:00',
                'quota' => 5,
                'booked' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_name' => 'Ningning',
                'expertise' => 'UI/UX DESIGN',
                'date' => '2024-11-20',
                'time_start' => '16:00:00',
                'time_end' => '18:00:00',
                'quota' => 6,
                'booked' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}
