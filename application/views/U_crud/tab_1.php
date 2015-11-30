<?php
$this->load->view("u_crud/head_page");
?>

<div id="grid_1"><?= $grid_1 ?><hr></div>

<script>
    $(".g1 ul li a").click(function(f)
    {
        f.preventDefault()             ;
        var href=$(this).attr("href")  ;
        $.get( href, function( data ) {
        $( "#grid_1" ).html( data );
        });
    });
</script>


