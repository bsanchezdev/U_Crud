<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of A
 *
 * @author Desarrollo
 */
class A extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->library("u_crud");
                $this->u_crud
                     ->init("default");
    }
    
    public function index() {
        $this->pag();
    }
    
    public function pag() {
        
        /*$this->u_crud
           ->use_db("ripley_sitrel")
           ->tabla("banco_ripley_carga")
           ->show();*/
     //    $configx['base_url']       = base_url()."fuckyeah"  ; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
	// $configx['total_rows']     = 12        ;//calcula el número de filas  
     //    $configx['per_page']       = 6               ; 
        $config["uri_segment"]      =3;
        $config['base_url']         = base_url()."c-control/A/pag";
        $this->u_crud
           ->use_db("default")
           ->query("select RUT,DV,NOMBRE from banco_ripley_carga")
          ->set_config_pag($config)
           ->show();
        }
    
}
