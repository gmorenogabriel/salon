<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PisosMigrations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_piso' => [
                'type'              => 'INT',
                'constraint'        => 3,
                'unsigned'          => true,
                'auto_increment'    => true,
                'null'              => true, 
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
        $this->forge->addPrimaryKey('id_piso');
        $this->forge->createTable('pisos');
        }

        public function down()
        {
                $this->forge->dropTable('pisos');
        }

}

