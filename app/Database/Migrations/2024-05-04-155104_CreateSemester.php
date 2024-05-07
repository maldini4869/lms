<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSemester extends Migration
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
            'semester' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'semester_year' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->addUniqueKey('semester');
        $this->forge->createTable('semester');
    }

    public function down()
    {
        $this->forge->dropTable('semester');
    }
}
