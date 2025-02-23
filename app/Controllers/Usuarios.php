<?php namespace App\Controllers;
// Capitulo 5 Punto de venta con CI4, cajas, usuarios, inicio y cierre de sesión
use App\Controllers\BaseController;
// use ReflectionMethod;
use CodeIgniter\I18n\Time;
use App\Models\UsuariosModel;
use App\Models\RolesModel;
use App\Models\PisosModel;
use App\Models\SalonesModel;
use App\Models\ApartamentosModel;

use App\Config\Salon;

class Usuarios extends BaseController{
    protected $usuarios, $salones, $roles, $pisos, $apartamentos;
    protected $reglas, $reglasLogin, $reglasCambia;
    protected $configs, $fecha_hoy;
    protected $clase, $funcion;
    //protected $myTime;
    public $threshold = 4;

public function __construct(){

        $this->usuarios = new UsuariosModel();
        $this->salones  = new SalonesModel();
        $this->roles    = new RolesModel();
        $this->apartamentos= new ApartamentosModel();
        $this->configs = config('Salon');

      //  $this->cajas = new CajasModel();
      //  $this->roles = new RolesModel();
        // Obtenemos la Fecha del Sistema
        //$myTime = Time::now('America/Montevideo', 'la_UY');
        $today       = Time::createFromDate();            // Uses current year, month, and day
        $this->fecha_hoy  = $today->toLocalizedString('dd/MM/yyyy');   // March 9, 2016
        
        // Obtenemos el nombre del Controlador/Metodo
        $router = \Config\Services::router();
        //$_method = $router->methodName();
        $_controller = $router->controllerName();         
        $controlador = explode('\\', $_controller);
        $this->clase = $controlador[max(array_keys($controlador))] ;       
        $this->funcion= $router->methodName();

        helper(['form']);
        // Variables para nuestras reglas de validac.del Form
				
        $this->reglas = [
            'usuario' =>  [
                'rules' => 'required|is_unique[usuarios.usuario]',
                'errors' => [
                    'required'=> 'El campo {field} es obligatorio.',
                    'is_unique'=> 'El campo {field} debe ser único.'
                    ]
                ],
            'password' => [               
                'rules' => 'required',
                'errors' =>  [
                    'required'=> 'El campo {field} es obligatorio.'
                    ]
                ],
            'repassword' => [               
                'rules' => 'required|matches[password]',
                'errors' =>  [
                    'required'=> 'El campo {field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.'
                    ]
                ],
            'nombre' => [               
                'rules' => 'required',
                'errors' =>  [
                    'required'=> 'El campo {field} es obligatorio.'
                    ]
                ],                
            'id_rol' => [               
                'rules' => 'required',
                'errors' =>  [
                    'required'=> 'El campo {field} es obligatorio.'
                    ]
                ],                   
            'id_rol' => [               
                'rules' => 'required',
                'errors' =>  [
                    'required'=> 'El campo {field} es obligatorio.'
                    ]
                ]                 
            ];
            
        // Variables para nuestras reglasLogin de validac.del Form
        $this->reglasLogin = [
            'usuario' =>  [
                'rules' => 'required',
                'errors' => [
                    'required'=> 'El campo {field} es obligatorio.'
                    ]
                ],
            'password' => [               
                'rules' => 'required',
                'errors' =>  [
                    'required'=> 'El campo {field} es obligatorio.'
                    ]
                ]
            ];
        // Variables para cambio Password.
        $this->reglasCambia = [
            'password' =>  [
                'rules' => 'required',
                'errors' => [
                    'required'=> 'El campo {field} es obligatorio.'
                    ]
                ],
                'repassword' => [               
                    'rules' => 'required|matches[password]',
                    'errors' =>  [
                        'required'=> 'El campo {field} es obligatorio.',
                        'matches'=> 'Las contraseñas no coinciden.'
                    ]
                ]
            ];
    }
    public function index($activo = 1){

        // Si no está Logueado lo manda a IDENTIFICARSE
        if($this->session->has('id_usuario') === false) { 
            return redirect()->to(base_url('/')); 
        }
        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data = [
            'titulo' => $this->clase,
            'datos' => $usuarios
        ];
		echo view('header');
        echo view('usuarios/usuarios', $data);
        echo view('footer');
    }
    public function eliminados($activo = 0){
        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Usuarios eliminados', 'datos' => $usuarios];

        echo view('header');
        echo view('usuarios/eliminados', $data);
        echo view('footer');
    }
    public function nuevo(){
        $pisos        = $this->pisos->where('activo', 1)->findAll();
        $roles        = $this->roles->where('activo', 1)->findAll();
        $salones      = $this->salones->where('activo', 1)->findAll();          
        $apartamentos = $this->apartamentos->where('activo', 1)->findAll();                    
        $data = ['titulo' => 'Agregar usuario', 'salones' => $salones, 'roles' => $roles, 'pisos' => $pisos, 'apartamentos' => $apartamentos ];
        
        echo view('header');
        echo view('usuarios/nuevo', $data);
        echo view('footer');
    }
    public function insertar(){
        if($this->request->getMethod() == "post" && $this->validate($this->reglas)){
        
		  $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
          $this->usuarios->save([
			'usuario' => $this->request->getPost('usuario'),
			'password' => $hash,
			'nombre' => $this->request->getPost('nombre'), 
		    'id_piso' => $this->request->getPost('id_piso'),
			'id_rol' => $this->request->getPost('id_rol'),
			'id_salon' => $this->request->getPost('id_salon'),            
			'id_apartamento' => $this->request->getPost('id_apartamento'),             
			'activo' => 1
			]);
		  return redirect()->to(base_url() . '/usuarios');
	  }else{
		  // a $data se deben agregar todos los arrays por ejemplo Cajas y Roles
		  $pisos        = $this->pisos->where('activo', 1)->findAll();
		  $roles        = $this->roles->where('activo', 1)->findAll();
		  $salones      = $this->salones->where('activo', 1)->findAll();          
		  $apartamentos = $this->apartamentos->where('activo', 1)->findAll();                    
		  $data = ['titulo' => 'Agregar Unidad', 'validation' => $this->validator,
			'pisos'         => $pisos,
			'roles'         => $roles,
			'salones'       => $salones,            
			'apartamentos'  => $apartamentos,            
		];
		  echo view('header');
		  echo view('usuarios/nuevo', $data);
		  echo view('footer');
	  }        
    }

    public function editar($id_usuario, $valid = null){
        $usuario        = $this->usuarios->where('id_usuario', $id_usuario)->where('activo', 1)->first();
        $pisos          = $this->pisos->where('activo', 1)->where('activo', 1)->first();
        $roles          = $this->roles->where('activo', 1)->findAll();
        $salones        = $this->salones->where('activo', 1)->findAll();          
        $apartamentos   = $this->apartamentos->where('activo', 1)->findAll();                    

        // a $data se deben agregar todos los arrays por ejemplo Cajas y Roles
        $pisos          = $this->pisos->where('activo', 1)->findAll();
        $roles          = $this->roles->where('activo', 1)->findAll();
        $salones        = $this->salones->where('activo', 1)->findAll();          
        $apartamentos   = $this->apartamentos->where('activo', 1)->findAll();                    
        $todosusu       = $this->usuarios->where('activo', 1)->findAll();

        if($valid != null){
            $data = [
                'titulo' => 'Editar '.$this->clase,
                'un_usuario' => $usuario,
                'todos_usuarios' => $todosusu,
                'validation' => $valid,
                'pisos' => $pisos,
                'roles' => $roles,
                'salones' => $salones,
                'apartamentos'  => $apartamentos, 
            ];
        }else {
            $data = [
                'titulo' => 'Editar '.$this->clase,
                'un_usuario' => $usuario,
                'todos_usuarios' => $todosusu,
                'pisos' => $pisos,
                'roles' => $roles,
                'salones' => $salones,
                'apartamentos'  => $apartamentos, 
        ];
        

            echo view('header');
            echo view('usuarios/editar', $data);
            echo view('footer');  
        }
    }
    public function actualizar(){
        if($this->request->getMethod() == "post" && $this->validate($this->reglas)){
            $this->usuarios->update($this->request->getPost('id'), ['nombre' =>
            $this->request->getPost('nombre'), 'nombre_corto' => $this->request->getPost('nombre_corto')
            ]);        
        //    return redirect()->to(base_url() . '/usuarios');
        $msgToast = [
            's2Titulo' => $this->clase,
            's2Texto'  => 'Ingreso Actualizado',
            's2Icono'  => 'success',
            's2Toast'  => 'true'
        ];
        $usuarios = $this->usuarios->findAll();
        $data = [ 
            'titulo' => $this->clase,
            'datos'  => $usuarios,
            'fecha'  => $this->fecha_hoy,
        ];    
        echo view('header');
        echo view('sweetalert2', $msgToast);            
        echo view($this->clase .'/'.$this->clase, $data);
        echo view('footer');

        } else {
          //  return $this->editar($this->request->getPost('id'), $this->validator);
          $msgToast = [
            's2Titulo' => $this->clase, 
            's2Texto' => 'No se validaron las reglas.',
            's2Icono' => 'warning',
            's2Toast' => 'true'
        ];
        $usuarios = $this->usuarios->where('activo',1)->findAll();
        $data = [ 
            'titulo' => $this->clase,
            'fecha'  => $this->fecha_hoy,
            'datos'  => $usuarios,
        ];

        echo view('header');
        echo view('sweetalert2', $msgToast);
        echo view($this->clase.'/'.$this->clase, $data);
        echo view('footer');
        }
    }
    public function eliminar($id)    {
        $this->usuarios->updte($id, ['activo' => 0]);
        return redirect()->to(base_url() . "/usuarios");
    }
    public function reingresar($id){
        $this->usuarios->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . "/usuarios");
    }
    public function login(){

       // echo "Usuarios / Login </br>";
       // echo " Clase </br>";
       // print_r ($this->clase);logs

        $data['error'] = 'Las contraseñas no coinciden';    
        echo view('login');
    }
    public function valida(){
        log_message('info', $this->clase . '/' . $this->funcion . ' Línea: ' . __LINE__ . "Ingrese a la funcion ");      
        $cache = cache();
        $test = cache('test');

		// Obtenemos el nombre del Controlador/Metodo
        $router = \Config\Services::router();
        $_method = $router->methodName();
        $_controller = $router->controllerName();         
        $controlador = explode('\\', $_controller) ;
        $this->clase = $controlador[max(array_keys($controlador))] ; 

$usuario  = $this->request->getPost('usuario');
$password = $this->request->getPost('password');
// Obtén los datos enviados por POST
$requestData = $this->request->getPost(esc(['usuario', 'password', 'activo']));
log_message('info', $this->clase . '/' . $this->funcion . ' Línea: ' . __LINE__ .  ' - Usuario: ' . $requestData['usuario']  . $requestData['password']);
d($requestData);
$datosUsuario = $this->usuarios->where('usuario', $usuario)->first();
     // Variables para nuestras reglasLogin de validac.del Form
        $reglasLogin = [
            'usuario' => 'required',
            'password' => 'required',
            ];
        
        log_message('info', $this->clase . '/' . $this->funcion . ' Línea: ' . __LINE__ . 'this->validate this->reglasLogin.');
        // if($this->request->getMethod() == "post" && $this->validate($this->reglasLogin)){
		if (! $this->validate($reglasLogin)){
            log_message('info', $this->clase . '/' . $this->funcion . ' Línea: ' . __LINE__ . ' - NO VALIDO LAS REGLAS.');      
		    return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
        }
            log_message('info', $this->clase . '/' . $this->funcion . ' Línea: ' . __LINE__ . ' - Reglas Validadas correctamente.');      
            $usuario  = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $datosUsuario = $this->usuarios->where('usuario', $usuario)->first();
            //dd($datosUsuario);
    // log_message('debug', 'Funcion valida - datosUsuario: ' . $datosUsuario['password']);
	echo "<pre>";
    echo " VALIDA </br>";
	echo  " despues del IFfunction valida" . "</br>";


var_dump( $datosUsuario);
echo "<pre>";
           
		//	d($datosUsuario['password']);
echo "</pre>";

log_message('info', $this->clase . '/' . $this->funcion . ' Línea: ' . __LINE__ . ' - Entramos a verificar la password.');      
                //Desciframos el Pass del Usuario
                if(password_verify($password, $datosUsuario['password'])){
                    // creamos a la variable de session
					d(' Usuario y Contraseñas VALIDADOS');
                    log_message('info', $this->clase . '/' . $this->funcion . ' Línea: ' . __LINE__ . ' - Usuario/Password verificadas.');      
                    $datosSesion = [
                        'id_usuario' => $datosUsuario['id_usuario'],
                        'nombre' => $datosUsuario['nombre'],
                        'id_piso' => $datosUsuario['id_piso'],
                        'id_rol' => $datosUsuario['id_rol'],
                        'id_salon' => $datosUsuario['id_salon'],
                        'id_apartamento' => $datosUsuario['id_apartamento'],
                        //<!-- agregado  -->
                        'login' => TRUE
                    ];
                   // $session = session();
                    $this->session->set($datosSesion);
                    // funciona la generacion de la Session
                    // echo "----datosSesion------------------ " . "\n";
                    // dd($datosSesion);
                    // echo "----session------------------ " . "\n";
                    // dd($session);
                return redirect()->to(base_url() . 'inicio');
				//return redirect()->to(base_url() . 'dash');
					//return redirect()->to(base_url() . 'dash');
                }else{
                    log_message('info', $this->clase . '/' . $this->funcion . ' Línea: ' . __LINE__ . ' - Usuario/Password NO Verificadas.');      
                    $data = [
                        'error' => 'Las contraseñas no coinciden',
                    ];    
                    echo view('login', $data);
                }
    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }
    public function cambia_password(){
        $session = session();
        $usuario = $this->usuarios->where('id_usuario', $session->id_usuario)->first();

        $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario];   
        echo view('header');
        echo view('usuarios/cambia_password', $data);
        echo view('footer');
    }
    public function actualizar_password(){
        if($this->request->getMethod() == "post" && $this->validate($this->reglasCambia)){
            $session = session();
            $idUsuario = $session->id_usuario;
            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $this->usuarios->update($idUsuario, ['password' => $hash]);

            $usuario = $this->usuarios->where('id_usuario', $session->id_usuario)->first();
    
            $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario, 'mensaje' => 'Contraseña actualizada'];   
            echo view('header');
            echo view('usuarios/cambia_password', $data);
            echo view('footer');
        }else{
            // Igual al Cambia_Password()
            $session = session();
            $usuario = $this->usuarios->where('id_usuario', $session->id_usuario)->first();
            $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario, 'validation' => $this->validator];  

            echo view('header');
            echo view('usuarios/cambia_password', $data);
            echo view('footer');
            }                
    }

}