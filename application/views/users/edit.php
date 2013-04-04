<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class='row-fluid'>

    <div class='span3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='span6'>

        <h1>Edit User</h1>
<form name='editUserForm' id='editUserForm'>
<input type='hidden' name='id' id='id' value='<?=$id?>'>

<input type='hidden' name='currentUsername' id='currentUsername' value="<?=$info->username?>">

<div class='tabbable'>
    <ul class='nav nav-tabs'>
        <li class='active'><a href='#tabSettings' data-toggle="tab">Settings</a></li>
        <li><a href='#tabPassword' data-toggle="tab">Password</a></li>
        <li><a href='#tabPermissions' data-toggle="tab">Permissions</a></li>
    </ul>


<div class="tab-content">
    <div id="tabSettings" class='tab-pane active'>
        <table class='form-table'>
            <tbody>
                <tr>
                    <td>Username</td>
                    <td><input type='text' name='username' id='username' value="<?=$info->username?>" placeholder='UserNameYouveHadSince13'></td>
                    <td>E-mail</td>
                    <td><input type='text' name='email' id='email' value="<?=$info->email?>" placeholder="email@domain.com"></td>
                </tr>

                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='firstName' id='firstName' value="<?=$info->firstName?>" placeholder="Audrey"></td>
                    <td>Last Name</td>
                    <td><input type='text' name='lastName' id='lastName' value="<?=$info->lastName?>" placeholder="Smith"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                    <select name='status' id='status'>
                    <?php
                    if (!empty($statuses))
                    {
                        foreach ($statuses as $r)
                        {
                            if ($r->code == 3) continue; // skips deleted status (use delete user button for that)

                            $sel = ($info->status == $r->code) ? "selected='selected'" : null;

                            echo "<option value='{$r->code}' {$sel}>{$r->display}</option>\n";
                        }
                    }
                    ?>
                    </select>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>


    </div> <!-- #tabSettings //-->

    <div id="tabPassword" class='tab-pane'>
        <h3>Change Password</h3>
        <p class='lead'>Here you can change the users password.</p>

        <table class='form-table'>
            <tbody>
                <tr>
                    <td>Current Password</td>
                    <td><input type='password' name='currentPassword' id='currentPassword' placeholder='&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;'></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>New password</td>
                    <td><input type='password' name='newPassword' id='newPassword' placeholder='&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;'></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>Confirm New password</td>
                    <td><input type='password' name='confirmPassword' id='confirmPassword' placeholder='&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;'></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>

    </div> <!-- #tabPassword //-->


    <div id="tabPermissions" class='tab-pane'>
    
    <p class='lead'>Assign permissions for to this user.</p>

<?php
if (!empty($permissions))
{
echo <<< EOS
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                </tr>
        </thead>
        <tbody>
EOS;

    foreach ($permissions as $r)
    {
        $checked = ($r->assigned > 0) ? "checked='checked'" : null;

        echo "<tr>\n";

        echo "\t<td><input type='checkbox' name='permission[]' id='permission' value='{$r->bit}' {$checked}></td>\n";
        echo "\t<td class='regularCursor'><h4>{$r->label}</h4><p>" . nl2br($r->Description) . "</p></td>\n";

        echo "</tr>\n";
    }

    echo "\t</tbody>\n";
    echo "</table>";
}
?>

    </div> <!-- #tabPermissions //-->

</div> <!-- .tab-contents //-->
</div> <!-- .tabbable //-->

</form>



        <div class='form-actions'>
            <button class='btn btn-primary' id='saveBtn'>Save</button>
            <button class='btn' id='cancelBtn'>Cancel</button>
            
            <div class='pull-right'>
                <button type='button' class='btn btn-danger' id='deleteBtn'><i class='icon-trash icon-white'></i></button>
            </div>
            
        </div>


    </div> <!-- .span6 //-->

    <div class='span3'>

    </div> <!-- .span3 //-->

</div> <!-- .row-fluid //-->
