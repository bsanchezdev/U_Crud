<?php
function load_bootstrap_css()
{    
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?= base_url("/css/bootstrap-3.3.5-dist/css/bootstrap.min.css");?>">
<!-- Optional theme -->
<link rel="stylesheet" href="<?= base_url("/css/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css");?>">

<link rel="stylesheet" href="<?= base_url("/external/font-awesome-4.4.0/css/font-awesome.min.css");?>">
<?php
}

function load_bootstrap_js()
{
?>
<script src="<?=base_url("/jquery/jquery-1.11.3.min.js");?>"></script>
<script src="<?=base_url("/css/bootstrap-3.3.5-dist/js/bootstrap.min.js");?>"></script>
<?php
}


function bootstrap_validator()
{
?>
<script src="<?=base_url("/external/bootstrapvalidator-0.4.5/src/js/bootstrapValidator.js");?>"></script>
<?php
}
function bootstrap_validator_css()
{
?>
<link rel="stylesheet" href="<?= base_url("/external/bootstrapvalidator-0.4.5/src/css/bootstrapValidator.css");?>">
<?php
}

function icheck()
{ 
?>
<script src="<?=base_url("/external/icheck-1.x/icheck.min.js");?>"></script>
<?php
}

function icheck_css(){
?>
<link rel="stylesheet" href="<?= base_url("/external/icheck-1.x/skins/square/red.css");?>" />
<?php
}