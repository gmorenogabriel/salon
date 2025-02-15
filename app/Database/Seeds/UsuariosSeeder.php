<?php

namespace App\Database\Seeds;
use Faker\Factory; // Importar faker

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
		$faker = Factory::create();
		$usuarios = [];
		$group     = [];
		
		
		// --------------------------------------
		// Administrador - id_rol = 1
		// --------------------------------------
		for($h=1; $h<2; $h++){
			

			$created_at = $faker->dateTime();
			$update_at  = $faker->dateTimeBetween($created_at);
			
			$datos = [
				[
				'id_usuario' 		=> 1,
				'usuario' 			=> 'presidente@gmail.com',
				'password' 			=>  password_hash('presidente', PASSWORD_DEFAULT), 
				'nombre'  			=> 'Administra Sistema',
				'telefono'			=> '099103769',
				'email'   			=> 'presidente@gmail.com',
				'id_rol'			=> 1,
				'id_piso'			=> 1,
				'id_apartamento'	=> 1,
				'id_salon'			=> 1,				
				'horario_desde'		=> null,				
				'horario_hasta'		=> null,				
				'activo'			=> 1,				
				'created_at'		=> date('Y-m-d H:i:s'),
				'updated_at'		=> null,
				'deleted_at'		=> null,	
				],
				[
				'id_usuario' 		=> 2,
				'usuario' 			=> 'admin@gmail.com',
				'password' 			=> password_hash('morega', PASSWORD_DEFAULT), 
				'nombre'  			=> 'Administra Sistema',
				'telefono'			=> '099103769',
				'email'   			=> 'gmorenogabriel@gmail.com',
				'id_rol'			=> 3,
				'id_piso'			=> 1,
				'id_apartamento'	=> 1,
				'id_salon'			=> 1,				
				'horario_desde'		=> null,				
				'horario_hasta'		=> null,				
				'activo'			=> 1,				
				'created_at'		=> date('Y-m-d H:i:s'),
				'updated_at'		=> null,
				'deleted_at'		=> null,	
				],
			];
		}	
		// Insertamos en la BDatos
		$builder = $this->db->table('usuarios');
		$builder->insertBatch($datos);
		
		// --------------------------------------	
		// Usuarios del Servicio - id_rol 5
		// --------------------------------------
		$id_usuario=5;
		for($y =5; $y <=5; $y++){

			$created_at = $faker->dateTime();
			$update_at  = $faker->dateTimeBetween($created_at);
			
				for($i =1; $i <=13; $i++){
		
					$created_at = $faker->dateTime();
					$update_at  = $faker->dateTimeBetween($created_at);
				
					for($x =1; $x <=4; $x++){
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
// El usuario hay que identificarlo por el correo verdadero,
// que tenga y no el NroApartamento
// Al momento de instalar deben pasar:
// usuario = correo
// nombre
// email   = correo

						$id_usuario+=1;
						// echo $id_usuario . "<br>";
						$usuarios[] = [
							'id_usuario'		=> $id_usuario,
							'usuario'			=> $i.$letra,
							'password'			=> password_hash('14demayo', PASSWORD_DEFAULT), 
							'nombre'			=> 'usuario ' . $i.$letra,
							'telefono'			=> '099',
							'email'				=> $i.$letra . '@gmail.com',
							'id_rol'			=> $y,
							'id_piso'			=> $i,
							'id_apartamento'	=> $i.$letra,
							'id_salon'			=> 1,
							'horario_desde'		=> null,
							'horario_hasta'		=> null,
							'activo'			=> 1,
							'created_at'		=> date('Y-m-d H:i:s'),
							'updated_at'		=> null,
							'deleted_at'		=> null,
						];	
					}
				}
			}
		// Insertamos en la BDatos
		$builder = $this->db->table('usuarios');
		$builder->insertBatch($usuarios);
	}
	/*
	Una vez finalizado para subir los datos a la Base
	se debe ejecutar:
	php spark db:seed usuariosSeeder
	*/
}