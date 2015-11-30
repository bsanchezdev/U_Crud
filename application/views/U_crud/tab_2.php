

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
</script>

<?php
$this->load->view("u_crud/footer_page");
