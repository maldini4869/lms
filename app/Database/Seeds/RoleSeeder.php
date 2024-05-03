<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
            [
                'name' => 'Guru',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
            [
                'name' => 'Siswa',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
        ];

        // Using Query Builder
        $this->db->table('role')->insertBatch($data);
    }
}
