<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active[$nav] = 'active';

?>

<div class='row-fluid'>
<div class='span12 well'>
<ul class='nav nav-list home-nav'>
    <li class='nav-header'>Navigation</li>
    <li class='<?=$active['home']?>'><a href='/home'><i class='icon-home'></i> Home</a></li>
    <li><a href='#'><i class='icon-envelope'></i> Messages <span class='label label-important'>3</span></a></li>
    <li><a href='#'><i class='icon-comment'></i> Notifications</a></li>
    <li><a href='/home/logout'><i class='icon-eject'></i> Log out</a></li>

    <li class='nav-header'>Settings</li>
    <li class='<?=$active['users']?>'><a href='/users'><i class='icon-user'></i> Users</a></li>
    <li><a href='#'><i class='icon-cog'></i> Site Settings</a></li>
</ul>
</div>
</div>
