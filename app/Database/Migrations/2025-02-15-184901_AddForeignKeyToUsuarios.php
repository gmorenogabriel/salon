<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyToUsuarios extends Migration
{
    public function up()
    {
//        $this->forge->addForeignKey('id_rol', 'roles', 'id_rol', 'CASCADE', 'SET NULL');
//        $this->forge->addForeignKey('id_piso', 'pisos', 'id_piso', 'CASCADE', 'SET NULL');
    }
    
    public function down()
    {
 //       $this->forge->dropForeignKey('usuarios', 'fk_usuario_rol');
 //       $this->forge->dropForeignKey('pisos', 'fk_pisos_rol');
    }
    
}
