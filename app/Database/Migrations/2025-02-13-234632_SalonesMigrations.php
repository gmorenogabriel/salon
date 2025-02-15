<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SalonesMigrations extends Migration
{
    public function up()
    {
    $this->forge->addField([
            'id_salon' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
                'auto_increment' => true,
                'null' => true,
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],			
             'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id_salon');
        $this->forge->createTable('salones');
        }

        public function down()
        {
                $this->forge->dropTable('salones');
        }

}
