<div id="grid_2"><?= $grid_2 ?></div>

<script>
    function a(){
    $(".g2 ul li a").click(function(e)
    {
        e.preventDefault()             ;
        var href=$(this).attr("href")  ;
        $.get( href, function( data ) {            
        $( "#grid_2" ).html( data );
        b();
        });
    });}
a();b();
//

function b(){
$('#<?= $id_tab?> tbody').on('click', 'tr', function () {
    
        var id = this.id;
        var datos = "";
     
        $(this).find('td').each (function() {
            datos=datos+$(this).html()+"|"; });
var los_datos=null;
$.ajax({
  method: "POST",
  url: "<?= base_url($controlador); ?>/box",
  data: { editable_cols: '<?= $col_edit_data ?>',columnas:'<?=$columnas_data?>',data: datos,
      c:"<?= $controlador?>" ,
      ce:"<?=$controlador_edicion?>",
      cb:"<?=$controlador_borrado?>",
      cc:"<?=$controlador_creacion?>"
      
  }
})
  .done(function( msg ) {
  $(".salida").empty().html(msg)   ;
  });
    } );
    }
</script>

<?php

$this->load->view("u_crud/footer_page");

