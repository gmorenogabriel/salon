<?php

namespace  App\Models;
use CodeIgniter\Model;

class UsuariosModel extends Model{

    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['usuario','password', 'nombre', 'telefono', 'email', 'id_rol', 'id_piso', 'id_apartamento', 'id_salon', 'horario_desde', 'horario_hasta', 'activo'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}   

?>