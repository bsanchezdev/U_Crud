<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of edit_box
 *
 * @author Desarrollo
 */
class Proceso extends CI_Controller{
    var $C_input=null;
    var $campos=null;
    var $data_original=null;
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->C_input=$this->input->post();
        $this->data_original=$this->C_input["data"];
        foreach ($this->C_input as $key => $value) {
            $this->C_input[$key]=trim($value,"|");
        }
        $this->data_t_array();
        }
    public function index()
    {
        
    }
    
    public function box()
    {
       
        $this->crear_campos();
        $data["campos"]=$this->campos;
        $data["data_original"]= $this->data_original;
        $data["controlador"]=$this->input->post("c");
        $data["controlador_edicion"]=$this->input->post("ce");
        $data["controlador_borrado"]=$this->input->post("cb");
        $data["controlador_creacion"]=$this->input->post("cc");
        
        
        $data["columnas"]=$this->input->post("columnas");
        $data["editable_cols"]=$this->input->post("editable_cols");
      $this->load->view("U_crud/modal",$data);
    }
    
    protected function data_t_array() {
        foreach ($this->C_input as $key => $value) {
            $this->C_input[$key] =  explode("|", $value);
         }
    }
    protected function crear_campos() {
         $campo="";
        foreach ($this->C_input["columnas"] as $key => $value) {
            if (in_array($value, $this->C_input["editable_cols"]))
            {
            $campo.="<div class='col-md-12'>"
                    . "<label>$value</label>"
                    . "<input class='form-control' type='text' name='$key' value='".$this->C_input["data"][$key]."' u_dev='data-field'/>"
                    . "</div>";
            }else
                {
             $campo.="<div class='col-md-12'>"
                    . "<label>$value</label>"
                    . "<input readonly class='form-control' type='text' name='$key' value='".$this->C_input["data"][$key]."' u_dev='data-field'/>"
                    . "</div>";   
                }
        }
          $this->campos=$campo;
    }
    
    public function edicion() {
        echo "proceso para guardar edicion";
    }
    
    public function borrado() {
     echo "proceso para borrar"; 
    }
    
}
