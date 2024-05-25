<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_id' => 3,
            'nisn' => '1823456002',
            'class_id' => 1,
            'created_at'    => Time::now(),
            'updated_at'    => Time::now(),
        ];

        // Using Query Builder
        $this->db->table('students')->insert($data);
    }
}
