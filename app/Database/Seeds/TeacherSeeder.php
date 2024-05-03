<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_id' => 2,
            'nip' => '199205142023052008',
            'created_at'    => Time::now(),
            'updated_at'    => Time::now(),
        ];

        // Using Query Builder
        $this->db->table('teacher')->insert($data);
    }
}
