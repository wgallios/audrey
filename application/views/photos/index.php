<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class='row-fluid'>

    <div class='span3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='span9'>
        <h1>Photos</h1>


<div class="navbar">
  <div class="navbar-inner">
    <div class="container">

      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <!-- Everything you want hidden at 940px or less, place within here -->
      <div class="nav-collapse collapse">
        <!-- .nav, .navbar-search, .navbar-form, etc -->

<ul class="nav">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">File <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a tabindex="-1" role='button' href="#createAlbumModal" data-toggle='modal'><i class='icon-folder-open'></i> New Album</a></li>
        </ul>
  </li>
    <!-- <li><a href="#">Edit</a></li> -->
    <!-- <li><a href="#">Help</a></li> -->
</ul>

    </div> <!-- .nav-collapse //-->

    </div>
  </div>
</div>



<ul class="breadcrumb" id='folderCrumbs'>
    <li id=''><a href='/photos'>All Photos</a>
    
    <?php if (!empty($folder)) : ?>
        <span class='divider'>/</span></li>
        <li class='active'><?=$folderInfo->albumName?>
    <?php endif; ?>

    </li>
    
</ul>

<div id='doc-container'>
<?php
if (empty($content))
{
    echo "<div class='alert alert-info alert-block'><h4>Information!</h4> This folder is currently empty!</div>";
}
else
{

    echo "<div class='row-fluid'>\n";


    echo "<ol id='fileList'>\n";

    $rcnt = 1;
    foreach ($content as $r)
    {
        $name = (strlen($r->name) > 25) ? substr($r->name, 0, 22) . '...' : $r->name;

        if ($r->type == 1)
        {
            echo "\t<li class='ui-state-default' value='{$r->id}' itemType='1' id='folder{$r->id}'><img src='/public/images/windows_folder_icon_trans.png'><div class='folderName'>{$name}</div></li>\n";
        }
        elseif ($r->type == 2)
        {
            $img = "/photos/block/{$r->name}/50";

            //$class = ($r->active == 1) ? null : ' hidden-doc';

            echo "\t<li class='ui-state-default{$class}' value='{$r->id}' itemType='2' id='doc{$r->id}' file=\"{$r->name}\"><img src='{$img}' class='img-polaroid'><div class='docName'>{$name}</div></li>\n";
        }

    }

    echo "</ol>\n";

    if ($rcnt <= 12) echo "</div>\n <!-- .row-fluid (outside) //-->"; // closes row if not 12 docs
}
?>
</div>




<?php
/*

<div class='tabbable'>
    <ul class='nav nav-tabs'>
        <li class='active'><a href='#tabAlbums' data-toggle="tab">Albums</a></li>
        <li><a href='#tabUpload' data-toggle="tab">Upload</a></li>
    </ul>

<div class="tab-content">

    <div id="tabAlbums" class='tab-pane active'>

        <div class='row-fluid create-album'>
            <a href='#createAlbumModal' role='button' class='btn btn-primary btn-large' data-toggle='modal'>Create Album</a>
        </div>

        <div id='album-display'></div>

    </div> <!-- #tabAlbum //-->



    <div id="tabUpload" class='tab-pane'>
<script type="text/javascript">
var finder = new CKFinder();
finder.basePath = '/public/ckfinder2.3.1/';
finder.height = 700;
finder.create();
</script>

    </div> <!-- #tabUpload //-->

</div> <!-- .tab-content //-->

</div> <!-- .tabbable //-->
*/
?>




    </div> <!-- .span9 //-->

</div> <!-- .row-fluid //-->


<!-- modal for creating new album //-->

<div id='createAlbumModal' class='modal hide fade' data-backdrop=''>

    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h3>Create a new Album</h3>
    </div> <!-- .modal-header //-->

    <div class='modal-body'>
        <div id='modalAlert'></div>

        <p class='lead'>Enter the name of your new photo album</p>

        <form name='createAlbumForm' id='createAlbumForm'>
        <p><input type='text' class='input-large' name='albumName' id='albumName' placeholder='Album Name'></p>
        </form>
    </div> <!-- .modal-body //-->

    <div class='modal-footer'>
        <button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>
        <button class='btn btn-primary' aria-hidden='true' id='createModalBtn'>Create Album</button>
    </div> <!-- .modal-footer //-->

</div> <!-- #createAlbumModal .modal .hide .fade //-->




<!-- modal for creating new album //-->
<div id='imgPreviewModal' class='modal-backdrop hide'>


</div>
