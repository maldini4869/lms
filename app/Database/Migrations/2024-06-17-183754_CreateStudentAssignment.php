<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentAssignment extends Migration
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
            'session_item_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'student_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'grade' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'feedback' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
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
        $this->forge->addForeignKey('session_item_id', 'session_items', 'id', 'CASCADE');
        $this->forge->addForeignKey('student_id', 'students', 'id', '', 'CASCADE');
        $this->forge->createTable('student_assignments');
    }

    public function down()
    {
        $this->forge->dropTable('student_assignments');
    }
}
