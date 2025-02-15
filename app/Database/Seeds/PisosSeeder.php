<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory; // Importar faker

class PisosSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $pisos = [];
        $group     = [];

        for($i =1; $i <14; $i++){
            
            $created_at = $faker->dateTime();
            $update_at  = $faker->dateTimeBetween($created_at);

            $pisos[] = [
					'id_piso'       => $i,
					'descripcion'   => 'Piso ' . $i,
         			'created_at'    => $created_at->format('Y-m-d H:i:s'), //$faker->dateTime(),
         //			'fecha_edit' => $update_at->format('Y-m-d H:i:s'), //$faker->dateTime(),
            ];
        }
        // Insertamos en la BDatos
        $builder = $this->db->table('pisos');
        $builder->insertBatch($pisos);
    }
    /*
     Una vez finalizado para subir los datos a la Base
     se debe ejecutar:
     php spark db:seed PisosSeeder
    */
}

