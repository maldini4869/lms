<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class TeacherSubjectSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'teacher_id' => 1,
                'subject_id' => 9,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'teacher_id' => 1,
                'subject_id' => 10,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];

        // Using Query Builder
        $this->db->table('teacher_subject')->insertBatch($data);
    }
}
