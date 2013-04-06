<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class='row-fluid edit-row'>

    <div class='span3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='span6'>
        <h1>Site Settings</h1>

<p class='lead'>Here you can adjust your sites settings.</p>

<form>

<div class='row-fluid form-horizontal'>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
      <input type="text" id="inputEmail" placeholder="Email">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <input type="password" id="inputPassword" placeholder="Password">
    </div>
  </div>

</div>


</form>

    </div> <!-- .span5 //-->

    <div class='span3'>

    </div> <!-- .span3 //-->
</div> <!-- .row-fluid //-->
