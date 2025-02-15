<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory; // Importar faker


class RolesSeeder extends Seeder
{
    public function run()
    {
        
        $data = [
            [
                'id_rol'     => 1,
                'descripcion' => 'Presidente',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id_rol'     => 2,
                'descripcion' => 'Gerente',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'id_rol'     => 3,
                'descripcion' => 'Administrador',
                'created_at'  => date('Y-m-d H:i:s'),
            ],            
            [
                'id_rol'     => 4,
                'descripcion' => 'Jefe',
                'created_at'  => date('Y-m-d H:i:s'),
            ], 
            // Para el sistema es fundamental que los usuarios sean identificados 
            // con el "id_rol"=5, de esta forma no pueden realizar modificaciones
            // a la base solo consultar el calendario           
            [
                'id_rol'     => 5,
                'descripcion' => 'Usuarios comunes',
                'created_at'  => date('Y-m-d H:i:s'),
            ],
        ];
      // Insertamos en la BDatos
      $builder = $this->db->table('roles');
      $builder->insertBatch($data);
    }        
}