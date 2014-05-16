<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class='row'>

    <div class='col-md-3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='col-md-6'>
        <h1>Authentication</h1>

<p class='lead'>Here you can authenticate your site with ASNP.co</p>

<p>
 Quisque consectetur neque tincidunt tellus bibendum sagittis. Quisque eget dolor arcu. Ut id est dui. Quisque viverra congue adipiscing. Quisque aliquet ante dolor. Nullam fringilla ullamcorper sem, in dictum nibh ultrices aliquam. Proin a lacus justo. Fusce faucibus, risus non viverra ullamcorper, ligula nisl laoreet nibh, et commodo orci metus non lacus. In iaculis fermentum turpis quis ullamcorper. Cras placerat condimentum tortor, et luctus enim posuere a. Aenean accumsan libero quis tellus rutrum ut semper dolor iaculis. Cras ultrices porta nunc ut vehicula. Vivamus suscipit convallis est a posuere.
</p>

<div id='key-display'>
<?php

if (empty($key))
{
	echo $this->alerts->alert("This site is not authenticated!");
}
else
{
    echo "<div class='key'>{$key}</div>\n";
}
?>
</div>

<hr>

<table class='form-table auth-table'>
    <tr>
        <td width='25%'>Username</td>
        <td width='75%'><?=$userInfo->username?></td>
    </tr>

    <tr>
        <td>E-mail</td>
        <td><?=$userInfo->email?></td>
    </tr>

    <tr>
        <td>Domain</td>
        <td><?=$_SERVER['HTTP_HOST']?></td>
    </tr>

    <tr>
        <td>IP</td>
        <td><?=$_SERVER['REMOTE_ADDR']?></td>
    </tr>
</table>

<div class='form-actions'>
    <button class='btn btn-primary' id='authBtn'>Authenticate Site</button>
</div>


    </div> <!-- .span6 //-->

    <div class='col-md-3'>


    </div> <!-- .span3 //-->

</div> <!-- .row-fluid //-->
