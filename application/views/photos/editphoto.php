<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<form name='editphotoForm' id='editPhotoForm'>

    <input type='hidden' name='id' value='<?=$id?>'>

<div class='container-fluid fill'>

    <div class='row-fluid edit-image-row'>

        <div class='span4 edit-image-info'>
            <h3>Caption</h3>

            <textarea class='input-block-level' id='caption' name='caption'><?=$info->caption?></textarea>

        </div>
        <div class='span8 img-background'>

            <div id='img-wrapper'>
                <img src='<?= $this->config->item('image_upload_url') . $info->file ?>'>
            </div>

            <div class='row-fluid img-controls'>
                <button class='btn btn-link'><i class='icon-repeat icon-white'></i></button>
                <button class='btn btn-link'><i class='icon-repeat icon-white icon-counter-clock-wise'></i></button>
                <button class='btn btn-link'><i class='icon-tag icon-white'></i></button>
                <button type='button' class='btn btn-link' id='defaultPicBtn'><i class='icon-user icon-white'></i></button>
            </div>
        </div>

    </div>

</div>

</div>
