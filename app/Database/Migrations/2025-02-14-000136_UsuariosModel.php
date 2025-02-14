<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuariosModel extends Migration
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
			'usuario' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false
            ],			
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true
            ],			
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'telefono' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
            ],			
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '130',
                'null' => false,
                'unique' => true
            ],
           'id_rol' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
            ],			
            'id_piso' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
            ],						
            'id_apartamento' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],			
            'id_salon' => [
                'type' => 'INT',
                'constraint' => 3,
                'null' => false,
            ],
            'horario_desde' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'horario_hasta' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],			
            'activo' => [
                'type' => 'tinyint',
                'constraint' => 1,
                'unsigned' => true,
            ],		
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true,
            ],		
            'created_at datetime default current_timestamp',
        ]); 
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('usuarios');
        }

        public function down()
        {
                $this->forge->dropTable('usuarios');
        }

}
