<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of U_Crud
 *
 * @author Desarrollo
 */
require_once SYSDIR.'/core/Model.php'; 
class U_Crud  extends CI_Model{
    
    var $db=null;
    var $tabla=null;
    var $obj=null;
    var $use_db=null;
    var $head_page="head_page";
    var $footer_page="footer_page";
    var $consulta_result=null;
    var $consulta=null;
    var $data_html=null;
    var $config=null;
    var $tfilas=0;
    var $tlinks=0;
    var $burl="";
    var $segment                =   4           ;
    var $col_edit               =   null        ;
    var $id_tab                 =   null        ;
    var $id_links               =   null        ;
    var $controlador            =   "c-control/proceso/"   ;
    var $controlador_edicion    =   "c-control/proceso/edicion"   ;
    var $controlador_creacion   =   "c-control/proceso/crear"   ;
    var $controlador_borrado    =   "c-control/proceso/borrado"   ;
    var $controlador_box        =   "c-control/proceso/box"   ;
    var $col_edit_data          =   null;
    var $col_edit_keys          = null;
    public function __construct() {
        $this->CI = get_instance()                                            ;
        $this->CI->load->helper("bootstrap");
          $this->load->library('pagination'); //Cargamos la librería de paginación
          
          $this->set_filas();
          $this->set_links();
          $this->set_url();
    }
   public function init($database=null) {
       //phpinfo();
      
        $this->db[$database]= $this->CI->load->database($database, TRUE);
        if($this->db[$database]!=null):
       // $this->db=$database                                                 ;
      //  var_dump($this);
        $this->CI->load->helper("sql_construct")                              ;
        $this->CI->load->helper("url")                                        ;
        else:
        show_error("Debe ud indicar el objeto BD",500,"Error U_Crud")   ;
        endif;
       return $this;
   }
   
   public function tabla($tabla) {
       $this->tabla=$tabla;
       return $this;
   }
   public function use_db($db)
   {
       $this->use_db=$this->db[$db];
       return $this;
   }
           
   public function setobj($obj) {
       $this->obj=$obj;
       
   }
   
   
   public function get_columnas()
   {
       if(isset($this->consulta)):
           $query = $this->use_db->query($this->consulta," limit 1,5");

foreach ($query->list_fields() as $field)
{
  $fields[]=$field;
} 
           else:
           $fields = $this->
               use_db->
               list_fields($this->tabla);
       endif;
     
       return $fields;
   }
   
   	function filas()
	{
             if(isset($this->consulta)):
                 
                 $consulta =$this->use_db->query($this->consulta);
                 else:
                 $consulta = $this->use_db->get($this->tabla);
		
             endif;
             return  $consulta->num_rows() ;
		
	}
   
        	function total_paginados($por_pagina,$segmento=1) 
        {
                    if($segmento==null):
                        $segmento=1;
                    endif;
                        
                    
           if(isset($this->consulta)):
               $this->consulta_result = $this->use_db->query($this->consulta." limit ".$segmento." , ".$por_pagina);
               $consulta = $this->consulta_result;
           elsE:
               $consulta = $this->use_db->get($this->tabla,$por_pagina,$segmento);
           endif;         
           // echo $this->use_db->last_query();
          
            if($consulta->num_rows()>0)
            {
                foreach($consulta->result() as $fila)
		{
		    $data[] = $fila;
		}
                    return $data;
            }
	}
        
        public function set_head_page($head_page="head_page")
        {
            $this->head_page=$head_page;
            return $this;
        }
        public function set_footer_page($footer_page="footer_page")
        {
            $this->footer_page=$footer_page;
            return $this;
        }
        
        public function query($sql,$pagina=0,$segmento=0)
        {
            $this->consulta=$sql;
             return $this;
        }
        
        public function set_url($burl='crud/A/pag/')
        {
            $this->burl=$burl;
        }
        
        public function set_filas($filas=5)
        {
            $this->tfilas=$filas;
        }
        
         public function set_links($links=5)
        {
            $this->tlinks=$links;
        }
        
        public function set_config_pag($conf=array())
        {
                $this->config['base_url']       = base_url().$this->burl  ; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$this->config['total_rows']     = $this->filas()        ;//calcula el número de filas  
		$this->config['per_page']       = $this->tfilas;               ; //Número de registros mostrados por páginas
                $this->config['num_links']      = $this->tlinks;              ; //Número de links mostrados en la paginación
 		$this->config['first_link']     = 'Primera'             ;//primer link
		$this->config['last_link']      = 'Última'              ;//último link
                $this->config["uri_segment"]    = $this->segment              ;//el segmento de la paginación
		$this->config['next_link']      = 'Siguiente'           ;//siguiente link
		$this->config['prev_link']      = 'Anterior'            ;//anterior link
                
                $this->config = array_merge($this->config, $conf);
                return $this;
        }
        
        public function set_id_links($param) {
            $this->id_links=$param;
            return $this;
        }
        public function set_id_tab($param) {
            $this->id_tab=$param;
            return $this;
        }
        public function show($show=false,$src="show_table_f1",$titulo="U_Crud Show Tabla")
        {
            $this->data_html=null;
            if(!isset($this->config)):
                $this->set_config_pag();
            endif;
            $data['count']=0;
            $data['title'] = $titulo;
		$this->pagination->initialize($this->config); //inicializamos la paginación		
		$data["data_tabla"] = $this->total_paginados($this->config['per_page'],$this->uri->segment($this->segment));			
                $data['columnas'] = $this->get_columnas();
                $d=null;
                foreach ($data['columnas'] as $key => $value) {
            $d.=$value."|";    
            }
            $data['columnas_data']=trim($d,"|");
                $data['id_tab']=$this->tabla;
                     if(isset($this->id_tab)):
                      $data['id_tab']=   $this->id_tab;
                     endif;
                     $data['id_links']=$this->id_links;
               
                     $data["col_edit_data"]=$this->col_edit_data;
                     $data["col_edit_keys"]=$this->col_edit_keys;
                     if(isset($this->col_edit)):
                         $data["col_edit"]=$this->col_edit;
                     endif;
                    $data["controlador_"]            =   $this->controlador          ;
                    $data["controlador_edicion"]    =   $this->controlador_edicion  ;
                    $data["controlador_creacion"]   =   $this->controlador_creacion ;
                    $data["controlador_borrado"]    =   $this->controlador_borrado  ;
                    $data["controlador"]            =   $this->controlador_box      ;
                    
                    
		$this->data_html.=$this->CI->load->view('U_crud/'.$src, $data,true);
                if ($show===true):
                    $this->CI->load->view('U_crud/'.$this->head_page, $data);
                    echo $this->data_html;
                    $this->CI->load->view('U_crud/'.$this->footer_page, $data,true);
                    else:
                        return $this->data_html;
                endif;
        }
        
        public function edit($array)
        {
            $this->col_edit=$array;
            $d="";
            foreach ($array as $key => $value) {
            $d.=$key."|";    
            }
            $this->col_edit_keys=$d;
            $this->col_edit_data=  trim(implode("|", $array),"|");
            return $this;
        }
        
      
   }
