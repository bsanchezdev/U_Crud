<?php
function construir_array_de_inserts($adata=null,$tabla=null,$insert="INSERT INTO ")
{
    if($adata!=null&&$tabla!=null):
        
    $contar=0;
    $datos_array=array();
    $data="";
    foreach ($adata as $key => $value) {
        
        $c=count($value);
        
        $data.="(";
        foreach ($value as $key_ => $value_) 
            {
               $value_=  str_replace("'", '´', $value_)         ;
               $value_=trim($value_);
               $data.="'".  utf8_encode($value_)."'," ;
              }
            $data=trim($data,",")               ;
            $data=$data."),"                    ;
             $contar++                          ;
             if($contar==100):
             $contar=0                          ;
            // $data=htmlspecialchars($data)      ;
             $datos_array[]=$data=rtrim($insert.$tabla." VALUES ".$data,",")                    ;
             $data=""                           ;
                 else:
             endif;
          
         
    }
    //$data=htmlspecialchars($data)   ;
    $datos_array[]=$data=rtrim($insert.$tabla." VALUES ".$data,",")             ;
        return $datos_array         ;
    else:
        return false                ;
    endif;
}


function load_query_file($path,$vars=array())
{
    
    /*Cargamos las querys desde un archivo sql y seteamos las variables definidas en el array vars*/
    $model_path=APPPATH."models";
        $query = read_file( $path );    
        
        foreach ($vars as $key => $value) {
            $query =str_replace
                (
                $key, 
                $value, 
                $query 
                );   
        }
        
        
        return $query;
}

function load_file($path,$vars=array())
{     
       $datos= fopen($path, "r");
       $batch_data=array();
       
       $contador=0;
       $total=0;
       while(!feof($datos))
	{
           
            $f_datos            =   fgets($datos)           ;
            $f_datos            = rtrim($f_datos,";")      ;
            $f_datos_array      =   explode(";", $f_datos)  ;
            
           
        
            
                $batch_data[$contador]=$f_datos_array;   
            
            $total++        ;
            $contador++     ;
        }
    fclose($datos);
    return $batch_data;
}
