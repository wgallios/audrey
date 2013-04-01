<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<input type='hidden' id='id' name='id' value='<?=$id?>'>

<div class='row-fluid'>

    <div class='span3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='span9'>
        <h1>Edit Album</h1>

        <div class='row-fluid' style="margin:20px 0;">
            <table class='form-table'>
                <tr>
                    <td width='100px'>Album Name</td>
                    <td><input type='text' class='input-block-level' id='albumName' name='albumName' value="" placeholder="Album Name"></td>
                </tr>
            </table>
        </div>

        <div class='row-fluid'>
            <div class='span9 editAlbum' id='photo-drop'>

            </div>

            <div class='span3 well editAlbum' id='all-pictures'>
<?php
if (empty($images))
{

}
else
{
    $cnt = 1;

    echo "<ol id='selectable'>\n";

    foreach ($images as $file)
    {

        #echo "\t<li class='ui-state-default'><img src='{$this->config->item('thumbnail_url')}{$file}' class='img-polaroid'></li>\n";
        echo "\t<li class='ui-state-default'><img src='/photos/block/{$file}/50' class='img-polaroid'></li>\n";


        /*
        echo "<div class='row img-row' id='img{$cnt}' value=\"{$file}\">";

        echo "<table class='img-tbl'>";
        echo "<tr>";

        echo "<td class='imgThumb'><img src='{$this->config->item('thumbnail_url')}{$file}' class='img-polaroid'></td>";

        echo "<td>{$file}</td>";

        echo "</tr>";
        echo "</table>";

        echo "</div>";
        */
        $cnt++;
    }

    echo "</ol>\n";
}
?>



            </div>
        </div> <!-- .row-fluid //-->


<!--
    <div class='form-actions'>
        <button class='btn btn-primary' id='saveBtn'>Save</button>
        <button class='btn' id='cancelBtn'>Cancel</button>
    </div>
//-->
    </div> <!-- .span9 //-->

</div> <!-- .row-fluid //-->


<!-- modal for image properties //-->

<div id="image-modal" class="modal hide fade image-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close pull-left" data-dismiss="modal" aria-hidden="true">×</button>
     &nbsp; 
</div>
  <div class="modal-body" id='image-modal-body'></div>

</div>
