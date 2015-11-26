<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title;?> - Paginación Codeigniter 3</title>
     <?= load_bootstrap_css() ?>
     <?= load_bootstrap_js() ?>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
</head>
<body>
    
    <div class="container">
       
    <div class="row">
        <div class="col-xs-12 table-responsive">
    <table id="<?= $id_tab ?>" class="table table-striped table-condensed display">
    <thead>
    <?php
    if($data_tabla)
    {
    ?>
    <tr>
    <?php foreach ($columnas as $key => $value) { ?>
    <th> <?= $value; ?> </th>     
    <?php } ?>     
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($data_tabla as $k => $v){ $count++?>
    <tr id="<?php echo $count ;?>">
    <?php foreach ($v as $key => $value) {  ?>
    <td><?= $value ?></td>
    <?php } ?>
    </tr>
    <?php
    }
    
    }
    ?>
    </tbody>
    </table>
        </div>
    </div>
    <?= $this->pagination->create_links() ?>
    </div>
    <script>
        $(document).ready( function () {
    var selected = [];        
            
            
    $('#<?= $id_tab?>9').DataTable(
            {
    paging: false,
    searching: true,
    ordering:  true,
    select: true, 
    info:     true,
    "columnDefs": [
            {
                "targets": [ 3 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 4 ],
                "visible": false
            },
            {
                "targets": [ 5 ],
                "visible": false
            },
            {
                "targets": [ 6 ],
                "visible": false
            }
        ],
    //"processing": true,
    //    "serverSide": true,
    //    "ajax": "scripts/ids-arrays.php",
        "rowCallback": function( row, data ) {
            if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                $(row).addClass('selected');
            }
        }
}
            );
    
    
    
     $('#<?= $id_tab?> tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);
 
        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }
 
        $(this).toggleClass('selected');
       // alert(id);
    } );
} );
    </script>
</body>
</html>