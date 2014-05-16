<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active[$nav] = 'active';

?>

<div class='row'>
<div class='col-md-12'>
<div class='well'>
<ul class='nav nav-list home-nav'>
    <li class='nav-header'>Navigation</li>
    <li class='<?=$active['home']?>'><a href='/home'><i class='fa fa-home'></i> Home</a></li>
    <li><a href='#'><i class='fa fa-envelope'></i> Messages <span class='label label-important'>3</span></a></li>
    <li><a href='#'><i class='fa fa-comment'></i> Notifications <span class='label label-important'>69</span></a></li>
    <li><a href='#'><i class='fa fa-plus'></i> Requests <span class='label label-important'>2</span></a></li>
    <li class='<?=$active['photos']?>'><a href='/photos'><i class='fa fa-photo'></i> Photos</a></li>
    <li><a href='/home/logout'><i class='fa fa-eject'></i> Log out</a></li>

    <li class='nav-header'>Profile</li>
    <li class='<?=$active['editinfo']?>'><a href='/edit'><i class='fa fa-pencil'></i> Edit Information</a></li>
    <li class='<?=$active['careers']?>'><a href='#'><i class='fa fa-briefcase'></i> Career</a></li>
    <li class='<?=$active['education']?>'><a href='#'><i class='fa fa-book'></i> Education</a></li>
    <li class='<?=$active['pages']?>'><a href='#'><i class='fa fa-globe'></i> Pages</a></li>
    <li class='<?=$active['privacy']?>'><a href='#'><i class='fa fa-lock'></i> Privacy</a></li>

    <li class='nav-header'>Settings</li>
    <li class='<?=$active['users']?>'><a href='/users'><i class='fa fa-user'></i> Users</a></li>
    <li class='<?=$active['plugins']?>'><a href='#'><i class='fa fa-wrench'></i> Plugins</a></li>
    <li class='<?=$active['settings']?>'><a href='/sitesettings'><i class='fa fa-cog'></i> Site Settings</a></li>
    <li class='<?=$active['auth']?>'><a href='/auth'><i class='fa fa-certificate'></i> Authentication</a></li>
</ul>
</div> <!-- /.well -->
</div> <!-- .span12  //-->
</div> <!-- .row-fluid //-->
