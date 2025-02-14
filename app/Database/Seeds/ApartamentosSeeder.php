<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory; // Importar faker

class ApartamentosSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $apartamentos = [];
        $group     = [];

        for($i =1; $i <14; $i++){
            
            $created_at = $faker->dateTime();
            $update_at  = $faker->dateTimeBetween($created_at);
		
			for($x =1; $x <5; $x++){
			 switch ($x) {
				case 1:
						$letra = "A";
						break;
					case 2:
						$letra = "B";
						break;
					case 3:
						$letra = "C";
						break;
					case 4:
						$letra = "D";
						break;						
					default:
						$letra = "Desconocido";
				}
				$apartamentos[] = [
				
						'apartamento' => $i.$letra,
						'descripcion' => 'Apartamento ' . $i.$letra,
						'created_at'  => $created_at->format('Y-m-d H:i:s'), //$faker->dateTime(),
			 //			'fecha_edit' => $update_at->format('Y-m-d H:i:s'), //$faker->dateTime(),
				];
			}
		}
        // Insertamos en la BDatos
        $builder = $this->db->table('apartamentos');
        $builder->insertBatch($apartamentos);
    }
    /*
     Una vez finalizado para subir los datos a la Base
     se debe ejecutar:
     php spark db:seed apartamentosSeeder
    */
}