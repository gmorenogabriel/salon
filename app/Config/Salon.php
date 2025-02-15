<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Salon extends BaseConfig
{
   // Access config class with namespace
   // public $config = config('Pager');
   // $config = config(\Config\Pager::class);
   // s$pageSize = $config->perPage;
   // dd($config);
    public $defaultGroupUsers   = 'Usuario';
    public $defaultRolUsers     = 5;
    public $regPerPage          = 1;
    //public $regPerPage = config('Pager');
    // public $siteEmail = 'webmaster@example.com';
    // ...
    public $defImgMinWidth  = 100;
    public $defImgMinHeight = 100;

    public $defImgMaxWidth  = 1024;
    public $defImgMaxHeight = 768;
	
	public $imgDefaultPath  = ROOTPATH . "public/uploads/";
	public $imgDefaultDest  = ROOTPATH . "public/uploads/covers/";
	public $imgDefaultTemp  = ROOTPATH . "public/uploads/temp/";

}
