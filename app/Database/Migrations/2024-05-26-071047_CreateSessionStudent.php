<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSessionStudent extends Migration
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
            'session_id' => [
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
        $this->forge->addForeignKey('session_id', 'sessions', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('student_id', 'students', 'id', '', 'CASCADE');
        $this->forge->createTable('sessions_students');
    }

    public function down()
    {
        $this->forge->dropTable('sessions_students');
    }
}
