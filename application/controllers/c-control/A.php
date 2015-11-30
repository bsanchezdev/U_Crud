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
                     ->init("default")->init("pagos");
    }
    
    public function index() {
        $this->pag();
    }
    
    public function pag() {
        
       
       // $config["uri_segment"]      =4;
        $config['base_url']         = base_url()."c-control/A/pag";
        $this->u_crud
           ->use_db("default")
           ->query("select banco_ripley_carga.RUT,
                    banco_ripley_carga.DV,
                    banco_ripley_carga.NOMBRE,
                    banco_ripley_carga.direcc,
                    banco_ripley_carga.OPERACION,
                    banco_ripley_carga.CUOTA 
                    from banco_ripley_carga")
           ->set_config_pag($config)->set_id_links("g1");
          
          $data["grid_1"]=$this->u_crud->show(false);
          $this->load->view("u_crud/tab_1",$data);
        if(count($this->uri->rsegments)<3):
          $this->grid2();  
        endif;
          
        }
        
        public function grid2() {
        $config['base_url']         = base_url()."c-control/A/grid2"  ;
        $this->u_crud
           ->use_db("pagos")
           ->query("SELECT
                pagtmo_in_copy.id,
                pagtmo_in_copy.fecha_data,
                pagtmo_in_copy.rut_emp,
                pagtmo_in_copy.operacion,
                pagtmo_in_copy.rut_deudor,
                pagtmo_in_copy.dv,
                pagtmo_in_copy.fecha_pago
                FROM
                pagtmo_in_copy
            ")
           ->set_config_pag($config)->set_id_links("g2");
          
          $data["grid_2"]=$this->u_crud->show(false);
          $this->load->view("u_crud/tab_2",$data);
            
        }
    
}
