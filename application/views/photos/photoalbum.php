<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (empty($photos))
{

}
else
{
    echo "<div id='album-container'>\n";

    foreach ($photos as $r)
    {
        echo "\t<img src='/photos/block/" . $r->file . "/80' class='img-polaroid' >";
    }

    echo "</div>";
}

