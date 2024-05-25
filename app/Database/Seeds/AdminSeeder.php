<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_id' => 1,
            'created_at'    => Time::now(),
            'updated_at'    => Time::now(),
        ];

        // Using Query Builder
        $this->db->table('admins')->insert($data);
    }
}
