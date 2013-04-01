<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid" id='photo-edit-container'>

        <div class='row'>

            <div class='span4'>
                <img src='<?= $this->config->item('image_upload_url') . $file ?>'>
            </div>

            <div class='span8'>
                <h2>Photo</h2>
            </div>

        </div>

</div>
