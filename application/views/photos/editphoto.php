<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<form name='editphotoForm' id='editPhotoForm'>

<div class='container-fluid fill'>

    <div class='row-fluid edit-image-row'>

        <div class='span4 edit-image-info'>
            <h3>Caption</h3>

            <textarea class='input-block-level' id='caption'></textarea>

        </div>
        <div class='span8 img-background'>

            <img src='<?= $this->config->item('image_upload_url') . $info->file ?>'>

            <div class='row-fluid img-controls'>
                <button class='btn btn-link'><i class='icon-repeat icon-white'></i></button>
                <button class='btn btn-link'><i class='icon-repeat icon-white icon-counter-clock-wise'></i></button>
                <button class='btn btn-link'><i class='icon-tag icon-white'></i></button>
                <button class='btn btn-link'><i class='icon-user icon-white'></i></button>
            </div>
        </div>

    </div>

</div>

</div>
