<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TodosLosSeeder extends Seeder
{
    public function run()
    {
        echo "Ejecutando RolesSeeder...";
        $this->call('RolesSeeder');

        echo "Ejecutando SalonesSeeder...";
        $this->call('SalonesSeeder');

        echo "Ejecutando PisosSeeder...";
        $this->call('PisosSeeder');

        echo "Ejecutando ApartamentosSeeder...";
        $this->call('ApartamentosSeeder');
        
        echo "Ejecutando UsuariossSeeder...";
        $this->call('UsuariosSeeder');
    }
}
