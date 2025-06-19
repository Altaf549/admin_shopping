<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAboutUsTable extends Migration
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
            'uniqcode' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'unique'     => true,
            ],
            'description' => [
                'type'       => 'TEXT',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'default'    => 'CURRENT_TIMESTAMP',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_about_us');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_about_us');
    }
}
