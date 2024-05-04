<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSchedule extends Migration
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
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'class_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'teacher_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'teacher_subject_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'semester' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'day' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'start_period' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'end_period' => [
                'type'       => 'INT',
                'constraint' => 11,
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
        $this->forge->addUniqueKey('code');
        $this->forge->addForeignKey('class_id', 'class', 'id');
        $this->forge->addForeignKey('teacher_id', 'teacher', 'id');
        $this->forge->addForeignKey('teacher_subject_id', 'teacher_subject', 'id');
        $this->forge->createTable('schedule');
    }

    public function down()
    {
        $this->forge->dropTable('schedule');
    }
}
