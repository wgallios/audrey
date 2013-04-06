<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class='row-fluid edit-row'>

    <div class='span3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='span6'>
        <h1>Site Settings</h1>

<p class='lead'>Here you can adjust your sites settings.</p>

<form name='settingsForm' id='settingsForm'>

<div class='row-fluid form-horizontal'>

<div class="control-group">
    <label class="control-label" for="domian">Domain</label>

    <div class="controls">
    <input type="text" id='domain' name='domain' placeholder="example.com" value="<?=$settings->domain?>">
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="domian">Google Analytics ID</label>

    <div class="controls">
    <input type="text" id='googleAnalyticsID' name='googleAnalyticsID' placeholder='UA-11223344-1' value="<?=$settings->googleAnalyticsID?>">
    </div>
</div>





<div class="control-group">
    <div class="controls">
    <label class="checkbox">
        <input type='hidden' name='seoCrawable' value='0'>
        <input type="checkbox" name='seoCrawable' id='seoCrawable' value='1'> SEO Crawable
    </label>
    </div>
</div>



</div> <!-- .row-fluid .form-horizontal //-->

<div class='form-actions'>
    <button type='button' class='btn btn-primary' id='saveBtn'>Save</button>
</div>


</form>

    </div> <!-- .span5 //-->

    <div class='span3'>

    </div> <!-- .span3 //-->
</div> <!-- .row-fluid //-->
