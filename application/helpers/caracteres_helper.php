<?php
function f_remove_odd_characters($string){
    ini_set('max_execution_time', -1);
       // these odd characters appears usually 
       // when someone copy&paste from MSword to an HTML form
       $string = str_replace("\n","[NEWLINE]",$string);
       $string=htmlentities($string);
       $string=preg_replace('/[^(\x20-\x7F)]*/','',$string);
       $string=html_entity_decode($string);     
       $string = str_replace("[NEWLINE]","\n",$string);
       return $string;
  }
  
  
  function clearString($text) { 
      $result = preg_replace('([^A-Za-z0-9])', '', $text); 
      return $result; } 
      
      function generateCsv($data, $delimiter = ';', $enclosure = ' ') {
      // $handle = fopen('php://temp', 'r+');
       $csv="";$csva="";
       foreach ($data as $line) {
           foreach ($line as $key => $value) {
               if($key=="RUT"):
                   $value=(int) $value;
               endif;
               $csva.=$value.$delimiter;
               
           }
           $csva=trim($csva,";");$csva=trim($csva,";");
           $csv.=$csva.  PHP_EOL;
           $csva="";
            //fputcsv($handle, $line, $delimiter);
       }
       //rewind($handle);
       //$output = stream_get_contents( $handle );
       
      /* while (!feof($handle)) {
               @$contents .= fread($handle, 8192);
       }*/
       //fclose($handle);
       return $csv;
}