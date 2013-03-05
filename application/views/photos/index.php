<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class='row-fluid'>

    <div class='span3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='span9'>
        <h1>Photos</h1>


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





    </div> <!-- .span9 //-->

</div> <!-- .row-fluid //-->


<!-- modal for creating new album //-->

<div id='createAlbumModal' class='modal hide fade' data-backdrop=''>

    <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h3>Create a New Album</h3>
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
