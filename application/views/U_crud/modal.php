<button id="periodo" class = "btn btn-primary btn-lg hidden" data-toggle = "modal" data-target = "#myModal">
</button>
<!-- Modal -->
<div class = "modal " id = "myModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true">
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               EDITAR
            </h4>
         </div>
         
         <div class = "modal-body">
             <div id="udev_content" class="row">
             <?= $campos;?>
             </div>
         </div>
          
          <div class = "modal-footer" style="padding-top:10px">
             <button id="borrar" type = "button" class = "btn btn-danger" >
               Borrar
            </button>
            <button id="cancela" type = "button" class = "btn btn-default" data-dismiss = "modal">
               Cancelar
            </button>
            
            <button id="continuar" type = "button" class = "btn btn-primary">
               Guardar
            </button>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->
<script> 
    $("#periodo").trigger("click");
    $("#borrar").on("click",function()
    {
        if(confirm('Esta seguro de querer borrar?')){
             var los_datos="";
      $('[u_dev=data-field]').each (function() {
           
            los_datos=los_datos+$(this).val()+"|"
           
}); 
 $('#myModal').modal('hide')                                             ;
        var datos=los_datos;
        var data_original="";
        data_original="<?=$data_original?>";
        $.ajax({
  type: "POST",
  url: "<?= base_url("$controlador_borrado");?>/",
  data: {data:datos,original: data_original,columnas:'<?=$columnas?>'},
  success: function(data){
     
      $( ".salida" ).html( data );
     // window.location.replace("<?= base_url("$controlador");?>");
     // alert(data);
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
    $( ".salida" ).html( errorThrown + XMLHttpRequest.responseText);
    alert( errorThrown + XMLHttpRequest.responseText);
  }
});
//
}else { alert("La acción fue cancelada");$('#myModal').modal('hide');    }                                         ;
         
    });
    $("#continuar").on("click",function()
    {
       
     var los_datos="";
      $('[u_dev=data-field]').each (function() {
           
            los_datos=los_datos+$(this).val()+"|"
           
}); 
       
       if(true)
       {
$('#myModal').modal('hide');
var datos="";
var data_original="";
data_original="<?=$data_original?>";
datos=los_datos; 

            $.ajax({
  type: "POST",
  url: "<?= base_url($controlador_edicion)?>/",
  data: {data:datos,original: data_original,columnas:'<?=$columnas?>'},
  success: function(data){
     
      $( ".salida" ).html( data );
      
      //window.location.replace("<?= base_url("carga_usuarios_reportes/A/");?>");
      
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
    $( ".salida" ).html( errorThrown + XMLHttpRequest.responseText);
  }
});     

       }else{alert("");}
       
    });
    
</script>