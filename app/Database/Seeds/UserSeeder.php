<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'maldini@example.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'full_name' => 'Admin Maldini',
                'role_id' => 1,
                'profile_picture' => 'undraw_profile.svg',
                'phone_number' => '081285483572',
                'is_active' => 1,
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
            [
                'email' => 'eko@example.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'full_name' => 'Susilo Eko',
                'role_id' => 2,
                'profile_picture' => 'undraw_profile.svg',
                'phone_number' => '081285483572',
                'is_active' => 1,
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
            [
                'email' => 'pradyanti@example.com',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'full_name' => 'Pradyanti',
                'role_id' => 3,
                'profile_picture' => 'undraw_profile.svg',
                'phone_number' => '081285483572',
                'is_active' => 1,
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
