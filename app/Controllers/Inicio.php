<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\RolesModel;
use App\Models\PisosModel;
use App\Models\SalonesModel;
use App\Models\ApartamentosModel;

class Inicio extends BaseController{
	
	//public $empresa;
//	protected $productoModel, $compraModel, $clientesModel;
	protected $usuarios, $salones, $roles, $pisos, $apartamentos;
	protected $rol, $login;
	protected $session;

	public function __construct(){	
	//	echo $this->empresa->empresaRuc . "<br/>";;		
		$this->session = session();
		$this->usuarios = new UsuariosModel();
        $this->salones  = new SalonesModel();
		$this->pisos    = new PisosModel();
        $this->roles    = new RolesModel();
        $this->apartamentos= new ApartamentosModel();
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
		// $totalCompras = $this->usuarios->totalCompras();
		$totalCompras  = count($this->usuarios->where('activo', 1)->findAll());
		$totalCompras=993414;
		$totalProductos= count($this->pisos->findAll());

		//Cuando habilite la fecha se debe invocar de la siguiente forma
		//$totalCompras = $this->comprasModel->totalCompras(date('Y-m-d')); //2020-11-28
		//$totalProductos= $this->productoModel->totalProductos();
		//$stockMinProd = $this->productoModel->stockMinimoProductos();

		$empresa = $this->configEmpresa();
		//$stockMinProd = $empresa->empresaStockMinProd;

		//$clientes = $this->clientesModel->inicioClientes();

		$usuarios = $this->usuarios->where('activo', 1)->findAll();
	
		$datos = [
			 // 'totalProductos' => $totalProductos,
			 'totalProductos' => $totalProductos,
			 'totalCompras' => $totalCompras,
			 'stockMinProd' => 99,
			// 'stockMinProd' => $stockMinProd,
			// 'clientes'     => $clientes,

			'id_piso' => $this->request->getPost('id_piso'),
			'id_rol' => $this->request->getPost('id_rol'),
			'id_salon' => $this->request->getPost('id_salon'),            
			'id_apartamento' => $this->request->getPost('id_apartamento'),       
			'usuarios'		=> $usuarios,
		];
		echo view('header');
		echo view('inicio', $datos);
		//echo view('MiDashboard', $datos);
		echo view('footer');
	}
}