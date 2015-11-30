

<div id="grid_2"><?= $grid_2 ?></div>

<script>
    $(".g2 ul li a").click(function(e)
    {
        e.preventDefault()             ;
        var href=$(this).attr("href")  ;
        $.get( href, function( data ) {            
        $( "#grid_2" ).html( data );
        });
    });

//
$('#<?= $id_tab?> tbody').on('click', 'tr', function () {
    
        var id = this.id;
        var datos = "";
     
      
     //   $(this).toggleClass('selected');
        
        $(this).find('td').each (function() {
            datos=datos+$(this).html()+"|"; });
 
$.ajax({
  method: "POST",
  url: "<?= base_url($controlador); ?>/box",
  data: { editable_cols: '<?= $col_edit_data ?>',columnas:'<?=$columnas_data?>',data: $.trim(datos),
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

</script>

<?php

$this->load->view("u_crud/footer_page");

