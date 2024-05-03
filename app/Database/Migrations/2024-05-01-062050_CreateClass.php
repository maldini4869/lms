<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClass extends Migration
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
            'grade' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'major' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'order' => [
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
        $this->forge->createTable('class');
    }

    public function down()
    {
        $this->forge->dropTable('class');
    }
}
