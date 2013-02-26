<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active[$nav] = 'active';

?>

<div class='row-fluid'>
<div class='span12 well'>
<ul class='nav nav-list home-nav'>
    <li class='nav-header'>Navigation</li>
    <li class='<?=$active['home']?>'><a href='/home'><i class='icon-home'></i> Home</a></li>
    <li><a href='#'><i class='icon-envelope'></i> Messages <span class='label label-important'>3</span></a></li>
    <li><a href='#'><i class='icon-comment'></i> Notifications <span class='label label-important'>69</span></a></li>
    <li><a href='#'><i class='icon-plus'></i> Requests <span class='label label-important'>2</span></a></li>
    <li><a href='#'><i class='icon-camera'></i> Photos</a></li>
    <li><a href='/home/logout'><i class='icon-eject'></i> Log out</a></li>

    <li class='nav-header'>Profile</li>
    <li class='<?=$active['editinfo']?>'><a href='/edit'><i class='icon-pencil'></i> Edit Information</a></li>
    <li class='<?=$active['careers']?>'><a href='#'><i class='icon-briefcase'></i> Career</a></li>
    <li class='<?=$active['education']?>'><a href='#'><i class='icon-book'></i> Education</a></li>
    <li class='<?=$active['pages']?>'><a href='#'><i class='icon-globe'></i> Pages</a></li>
    <li class='<?=$active['privacy']?>'><a href='#'><i class='icon-lock'></i> Privacy</a></li>

    <li class='nav-header'>Settings</li>
    <li class='<?=$active['users']?>'><a href='/users'><i class='icon-user'></i> Users</a></li>
    <li class='<?=$active['plugins']?>'><a href='#'><i class='icon-wrench'></i> Plugins</a></li>
    <li><a href='#'><i class='icon-cog'></i> Site Settings</a></li>
</ul>
</div> <!-- .span12 .well //-->
</div> <!-- .row-fluid //-->
