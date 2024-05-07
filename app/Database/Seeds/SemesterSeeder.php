<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SemesterSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'semester' => 1,
                'semester_year' => '2020-2021',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
            [
                'semester' => 2,
                'semester_year' => '2021-2022',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
            [
                'semester' => 3,
                'semester_year' => '2022-2023',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
        ];

        // Using Query Builder
        $this->db->table('semester')->insertBatch($data);
    }
}
