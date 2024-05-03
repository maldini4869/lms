<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'code' => 'AGM',
                'name' => 'Agama',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'BND',
                'name' => 'Bahasa Indonesia',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'BNG',
                'name' => 'Bahasa Inggris',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'BIO',
                'name' => 'Biologi',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'EKO',
                'name' => 'Ekonomi',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'FIS',
                'name' => 'Fisika',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'GEO',
                'name' => 'Geografi',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'KIM',
                'name' => 'Kimia',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'MKM',
                'name' => 'Matematika Minat',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'MKW',
                'name' => 'Matematika Wajib',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'PKW',
                'name' => 'Pendidikan Kewirausahaan',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'PJK',
                'name' => 'Penjaskes',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'PKN',
                'name' => 'PKN',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'SJM',
                'name' => 'Sejarah Minat',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'SJW',
                'name' => 'Sejarah Wajib',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'SNM',
                'name' => 'Seni Musik',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'SNR',
                'name' => 'Seni Rupa',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'code' => 'SOS',
                'name' => 'Sosiologi',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];

        // Using Query Builder
        $this->db->table('subject')->insertBatch($data);
    }
}
