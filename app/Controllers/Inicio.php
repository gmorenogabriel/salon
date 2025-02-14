<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\ProductosModel;
use App\Models\ClientesModel;

class Inicio extends BaseController{
	
	//public $empresa;
	protected $productoModel, $compraModel, $clientesModel;
	protected $rol, $login;
	protected $session;

	public function __construct(){	
	//	echo $this->empresa->empresaRuc . "<br/>";;		
		$this->session = session();
		$this->compraModel = new ComprasModel;
		$this->productoModel = new ProductosModel;
		$this->clientesModel = new ClientesModel;
		
		// echo "<pre>";
		// $this->login=session('login');	
		// $this->rol=session('id_rol');
		// echo "Login: ";
		// print_r($this->login);
		// echo "<br>";
		// echo "Rol: ";
		// print_r($this->rol);
		// echo "<br>";
		//die();
	}
	 public function index(){	
		// Si no está Logueado lo manda a IDENTIFICARSE
		if($this->session->has('id_usuario') === false) { 
			return redirect()->to(base_url()); 
		}
		$totalCompras = $this->compraModel->totalCompras();

		//Cuando habilite la fecha se debe invocar de la siguiente forma
		//$totalCompras = $this->comprasModel->totalCompras(date('Y-m-d')); //2020-11-28
		$totalProductos= $this->productoModel->totalProductos();
		$stockMinProd = $this->productoModel->stockMinimoProductos();

		$empresa = $this->configEmpresa();
		$stockMinProd = $empresa->empresaStockMinProd;

		$clientes = $this->clientesModel->inicioClientes();
	
		$datos = [
			'totalProductos' => $totalProductos,
			'totalCompras' => $totalCompras,
			'stockMinProd' => $stockMinProd,
			'clientes'     => $clientes,
		];
		echo view('header');
		echo view('inicio', $datos);
		//echo view('MiDashboard', $datos);
		echo view('footer');
	}
}