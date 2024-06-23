<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SiteSettingSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'slug' => 'CURRENT_SEMESTER_ID',
                'value' => '1',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
            [
                'slug' => 'TOTAL_SESSION',
                'value' => '20',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ],
        ];

        // Using Query Builder
        $this->db->table('site_settings')->insertBatch($data);
    }
}
