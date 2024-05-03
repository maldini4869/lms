<?php

namespace App\Database\Seeds;

class DataSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $this->call('RoleSeeder');
        $this->call('UserSeeder');
        $this->call('AdminSeeder');
        $this->call('TeacherSeeder');
        $this->call('SubjectSeeder');
        $this->call('TeacherSubjectSeeder');
        $this->call('ClassSeeder');
        $this->call('StudentSeeder');
    }
}
