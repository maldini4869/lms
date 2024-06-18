<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClassStudent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'semester_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'class_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'student_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('semester_id', 'semesters', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('class_id', 'classes', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('student_id', 'students', 'id', '', 'CASCADE');
        $this->forge->createTable('class_students');
    }

    public function down()
    {
        $this->forge->dropTable('class_students');
    }
}
