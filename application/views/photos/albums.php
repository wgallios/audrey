<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (empty($albums))
{
    echo "<div class='alert alert-block alert-info'><h4>Information!</h4> You have not created any albums!</div>\n";
}
else
{
    $rcnt = 1;

    foreach ($albums as $r)
    {
        if ($rcnt == 1) echo "<div class='row-fluid'>\n";

        echo "\t<div class='span3 well'>\n";
        echo "\t\t<a href='/photos/editalbum/{$r->id}'>{$r->albumName}</a>\n";
        echo "\t</div>\n";
    
        if ($rcnt >= 4)
        {
            echo "</div>\n"; // .row-fluid
        
            $rcnt = 1;
        }
        else
        {
            $rcnt++;
        }
    }

    if ($rcnt < 4 && $rcnt > 1) echo "</div>\n";




}
