<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApartamentosMigrations extends Migration
{
    public function up()
    {
     $this->forge->addField([
            'id_apartamento' => [
                'type'              => 'INT',
                'constraint'        => 3,
                'unsigned'          => true,
                'auto_increment'    => true,
                'null'              => true,       
            ],
			'apartamento' => [
                'type' => 'VARCHAR',
                'constraint' => 3,
                'null'     => true, 
            ],	
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],			
             'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id_apartamento');
        $this->forge->createTable('apartamentos');
        }

        public function down()
        {
                $this->forge->dropTable('apartamentos');
        }

}
