<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid" id='photo-edit-container'>

        <div class='row-fluid clearfix'>

            <div class='span4'>
                <img src='<?= $this->config->item('image_upload_url') . $file ?>' class='img-polaroid'>
            </div>

            <div class='span4'>
                
                <p><button class='btn btn-success'><i class='icon-user icon-white'></i> Make Profile Picture</button></p>

            
                <div class='alert alert-block alert-info'>
                    <h4>Information</h4>
                    This image has no comments =[
                </div>

            </div>


            <div class='span4'>
                <textarea class='input-block-level' id='caption' name='caption'><?=$info->caption?></textarea>
            </div>
        

        </div>

    <div class='form-actions'>
        <div class='pull-right'>
            <button class='btn'>Cancel</button>
            <button class='btn btn-primary'>Save</button>
        </div>
    </div>

</div>
