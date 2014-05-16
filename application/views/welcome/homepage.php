<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

      <div class="row">
        <div class="col-md-3">

<?php
if (empty($settings->profilePicture))
{
    $img = "/public/images/dude.gif";
}
else
{
    $img = $this->config->item('image_upload_url') . $settings->profilePicture;
}
?>

    <img src='<?=$img?>' class='img-thumbnail'>


<div class='row-fluid' style="margin-top:20px;">

<?php if (!empty($settings->firstName)) echo "<dl class='dl-horizontal'><dt>Name</dt><dd>{$settings->firstName} {$settings->lastName}</dd></dl>"; ?>
<?php if (!empty($settings->dob)) echo "<dl class='dl-horizontal'><dt>Age</dt><dd>{$settings->age}</dd></dl>"; ?>
<?php if (!empty($settings->gender)) echo "<dl class='dl-horizontal'><dt>Gender</dt><dd>{$settings->genderDisplay}</dd></dl>"; ?>
<?php if (!empty($settings->relationshipStatus)) echo "<dl class='dl-horizontal'><dt>Relationship Status</dt><dd>{$settings->rssDisplay}</dd></dl>"; ?>

</div>

        </div><!--/span-->

        <div class="col-md-6">

        <div class='row action-bar'>

<?php
if (isset($_COOKIE['asnpid']))
{
    echo "ASNP: " . $_COOKIE['asnpid'];
}
?>

            <button type='button' class='btn btn-success' id='asnp-addFriendBtn'><i class='icon-plus icon-white'></i> Add Friend</button>
            <button type='button' class='btn btn-info'><i class='icon-tag icon-white'></i> Follow</button>

            <div class='pull-right'>
            <button type='button' class='btn btn-primary'><i class='icon-envelope icon-white'></i> Message</button>
            </div>
        </div>



        <!-- <h2>Page Posts</h2> -->
    
        <input type='hidden' id='load_comments' value='0'>

        <form name='pagePostForm' id='pagePostForm'>

        <input type='hidden' name='domain' id='domain' value=''>

        <div class='row'>
        
        <div id='postAlert'></div>

        <textarea name='post' id='post' class='form-control input-block-level' <?=$btnDis?>></textarea>
        </div>
        <div class='row'>
            <div class='col-md-8'>
            <img src='/employee/profileimg/40'> <strong>[name]</strong> &bull; [Domain]
            </div>
            
            <div class='col-md-4' align='right'>

                <button id='pagePostBtn' type='button' class='btn' <?=$btnDis?>>Post</button>
            </div>

        </div>

        </form>

        <form name='postForm' id='postForm'>
        <div id='posts-display'></div>
        </form>

        <div id='posts-loader-display'></div>


        </div><!--/span-->

        <div class='col-md-3'>
            <h3>Friends</h3>
        </div> <!-- .span3 //-->

      </div><!--/row-->

