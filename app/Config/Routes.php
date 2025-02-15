<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'Usuarios::login');

$routes->group('/',['namespace' => 'App\Controllers'],function($routes){
		// Web de Ingreso http://localhost:8084/salon/public/login
		$routes->get('testcontroller/test/(:any)', 		'TestController::test/$1');
        $routes->get('login',            				'Usuarios::login',    				['as' => 'usuarios']);   
		$routes->get('dash',             				'Dashboard::index',    				['as' => 'dash']); 
/*      --------- */		
        $routes->post('usuarios/valida', 				'Usuarios::valida',   				['as' => 'valida']);
        $routes->get('usuarios/nuevo',   				'Usuarios::nuevo',   				['as' => 'usuariosnuevo']);
		$routes->get('usuarios/editar/(:any)',			'Usuarios::editar/$1',				['as' => 'usuariossedit']);		
		$routes->get('usuarios/eliminados',       		'Usuarios::eliminados',   			['as' => 'usuarioselim']);		
		$routes->get('usuarios',         				'Usuarios::index',   				['as' => 'usuariosindex']);
		$routes->get('usuarios/logout',  				'Usuarios::logout',   				['as' => 'usuarioslogout']);
/*      --------- */			

		$routes->get('inicio',           				'Inicio::index',		['as' => 'inicio']);
});