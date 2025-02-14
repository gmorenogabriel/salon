<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PisosModel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
			'piso' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => false
            ],	
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],			
             'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pisos');
        }

        public function down()
        {
                $this->forge->dropTable('pisos');
        }

}

