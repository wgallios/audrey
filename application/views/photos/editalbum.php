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
    foreach ($images as $file)
    {
        echo "<div class='row img-row' id='img{$cnt}' value=\"{$file}\">";

        echo "<table class='img-tbl'>";
        echo "<tr>";

        echo "<td class='imgThumb'><img src='{$this->config->item('thumbnail_url')}{$file}' class='img-polaroid'></td>";

        echo "<td>{$file}</td>";

        echo "</tr>";
        echo "</table>";

        echo "</div>";

        $cnt++;
    }
}
?>



            </div>
        </div> <!-- .row-fluid //-->



    <div class='form-actions'>
        <button class='btn btn-primary' id='saveBtn'>Save</button>
        <button class='btn' id='cancelBtn'>Cancel</button>
    </div>

    </div> <!-- .span9 //-->

</div> <!-- .row-fluid //-->



