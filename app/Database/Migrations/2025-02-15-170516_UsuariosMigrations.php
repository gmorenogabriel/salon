<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuariosMigrations extends Migration
{
    public function up() 
    {
	$this->forge->addField([
            'id_usuario' => [
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
                'constraint'=> 3,
                'unsigned' => true,
                'null'     => true, 
            ],			
            'id_piso' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
                'null'     => true, 
            ],						
            'id_apartamento' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
                'null'     => true, 
            ],			
            'id_salon' => [
                'type' => 'INT',
                'constraint' => 3,
                'unsigned' => true,
                'null' => true,
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
        // Definir clave primaria
        //$this->forge->addPrimaryKey('id_usuario');
        $this->forge->addKey('id_usuario', true);

        // Definimos clave foránea
        $this->forge->addForeignKey('id_rol', 'roles', 'id_rol', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_piso', 'pisos', 'id_piso', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_salon', 'salones',  'id_salon', 'CASCADE', 'SET NULL');
       // $this->forge->addForeignKey('id_apartamento', 'apartamentos',  'id_apartamento', 'CASCADE', 'SET NULL');        
        
        // Creamos la Tabla
        $this->forge->createTable('usuarios');
        }

        public function down()
        {
            $this->forge->dropForeignKey('usuarios', 'usuarios_id_rol_foreign');
            $this->forge->dropForeignKey('usuarios', 'usuarios_id_piso_foreign');
            $this->forge->dropForeignKey('usuarios', 'usuarios_id_salon_foreign');
            $this->forge->dropTable('usuarios');
        }

}