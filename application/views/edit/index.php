<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class='row-fluid'>

    <div class='span3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='span9'>
        <h1>Edit Information</h1>

<form name='editForm' id='editForm'>

<div class='tabbable'>
    <ul class='nav nav-tabs'>
        <li class='active'><a href='#tabInfo' data-toggle="tab">Basic Information</a></li>
        <li><a href='#tabAboutMe' data-toggle="tab">About Me</a></li>
    </ul>


<div class="tab-content">
    <div id="tabInfo" class='tab-pane active'>

        <table class='form-table'>
            <tbody>
                <tr>
                    <td>First Name</td>
                    <td><input type='text' class='input-large' name='firstName' id='firstName' value="<?=$info->firstName?>"></td>
                    <td>Last Name</td>
                    <td><input type='text' class='input-large' name='lastName' id='lastName' value="<?=$info->lastName?>"></td>
                </tr>

                <tr>
                    <td>D.O.B.</td>
                    <td><input type='text' class='input-medium' name='dob' id='dob' value="<?=$info->dob?>"></td>
                    <td>Gender</td>
                    <td>
                        <select name='gender' id='gender' class='input-medium'>
                            <option value=''></option>
                            <?php
                            if (!empty($genders))
                            {
                                foreach ($genders as $r)
                                {
                                    $sel = ($info->gender == $r->code) ? 'selected' : null;

                                    echo "<option value='{$r->code}' {$sel}>{$r->display}</option>\n";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Relationship Status</td>
                    <td>
                        <select name='relationshipStatus' id='relationshipStatus' class='input-large'>
                            <option value=''></option>
                            <?php
                            if (!empty($rss))
                            {
                                foreach ($rss as $r)
                                {
                                    $sel = ($info->relationshipStatus == $r->code) ? 'selected' : null;

                                    echo "<option value='{$r->code}' {$sel}>{$r->display}</option>\n";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Height</td>
                    <td><input type='text' name='heightFeet' id='heightFeet' class='input-mini' value="<?=$info->heightFeet?>"> <small>Feet</small> <input type='text' name='heightInches' id='heightInches' class='input-mini' value="<?=$info->heightInches?>"> <small>Inches</small></td>
                    <td>Weight</td>
                    <td>
                        <input type='text' name='weight' id='weight' class='input-mini' value="<?=$info->weight?>">
                        <select name='weightType' id='weightType' class='input-mini'>
                            <option value=''></option>
                            <?php
                            if (!empty($weights))
                            {
                                foreach ($weights as $r)
                                {
                                    $sel = ($info->weightType == $r->code) ? 'selected' : null;

                                    echo "<option value='{$r->code}' {$sel}>{$r->display}</option>\n";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>

    <div id="tabAboutMe" class='tab-pane'>

        <textarea name='aboutMe' id='aboutMe'><?=$info->aboutMe?></textarea>

    </div> <!-- #tabAboutMe //-->

</div> <!-- .tab-content //-->

</div> <!-- .tabbable //-->

</form>

<div class='form-actions'>
    <button class='btn btn-primary' id='saveBtn'>Save</button>
    <!-- <button class='btn' id='cancelBtn'>Cancel</button> -->
</div>



    </div> <!-- .span9 //-->

    <?php
    /*
    <div class='span3'>

        <div class='row-fluid'>
            <div class='span12' align='center'>
            </div>
        </div>

    </div> <!-- .span3 //-->
    */
    ?>
</div> <!-- .row-fluid //-->
