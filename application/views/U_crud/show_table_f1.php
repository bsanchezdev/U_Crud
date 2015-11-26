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