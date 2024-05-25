<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'code' => 'X IPA 1',
                'grade' => 10,
                'major' => 'IPA',
                'order' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'X IPA 2',
                'grade' => 10,
                'major' => 'IPA',
                'order' => 2,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'X IPA 3',
                'grade' => 10,
                'major' => 'IPA',
                'order' => 3,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'X IPA 4',
                'grade' => 10,
                'major' => 'IPA',
                'order' => 4,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'X IPS 1',
                'grade' => 10,
                'major' => 'IPS',
                'order' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'X IPS 2',
                'grade' => 10,
                'major' => 'IPS',
                'order' => 2,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'X IPS 3',
                'grade' => 10,
                'major' => 'IPS',
                'order' => 3,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'X IPS 4',
                'grade' => 10,
                'major' => 'IPS',
                'order' => 4,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XI IPA 1',
                'grade' => 11,
                'major' => 'IPA',
                'order' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XI IPA 2',
                'grade' => 11,
                'major' => 'IPA',
                'order' => 2,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XI IPA 3',
                'grade' => 11,
                'major' => 'IPA',
                'order' => 3,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XI IPA 4',
                'grade' => 11,
                'major' => 'IPA',
                'order' => 4,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XI IPS 1',
                'grade' => 11,
                'major' => 'IPS',
                'order' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XI IPS 2',
                'grade' => 11,
                'major' => 'IPS',
                'order' => 2,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XI IPS 3',
                'grade' => 11,
                'major' => 'IPS',
                'order' => 3,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XI IPS 4',
                'grade' => 11,
                'major' => 'IPS',
                'order' => 4,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XII IPA 1',
                'grade' => 12,
                'major' => 'IPA',
                'order' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XII IPA 2',
                'grade' => 12,
                'major' => 'IPA',
                'order' => 2,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XII IPA 3',
                'grade' => 12,
                'major' => 'IPA',
                'order' => 3,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XII IPA 4',
                'grade' => 12,
                'major' => 'IPA',
                'order' => 4,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XII IPS 1',
                'grade' => 12,
                'major' => 'IPS',
                'order' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XII IPS 2',
                'grade' => 12,
                'major' => 'IPS',
                'order' => 2,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XII IPS 3',
                'grade' => 12,
                'major' => 'IPS',
                'order' => 3,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'code' => 'XII IPS 4',
                'grade' => 12,
                'major' => 'IPS',
                'order' => 4,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ]
        ];

        // Using Query Builder
        $this->db->table('classes')->insertBatch($data);
    }
}
