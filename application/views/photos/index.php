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

        <div class='row-fluid'>
            <button type='button' class='btn btn-primary'>Create Album</button>
        </div>

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
