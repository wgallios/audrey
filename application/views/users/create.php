<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class='row-fluid'>

    <div class='span3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='span6'>
        <h1>Create New User</h1>

            <p class='lead'>Enter the new users information here.</p>

<form name='createForm' id='createForm' method='post' action='/users/createuser'>

        <table class='form-table'>
            <tbody>
                <tr>
                    <td>Username<td>
                    <td><input type='text' name='username' id='username' placeholder='UserNameYouveHadSince13'></td>
                    <td>E-mail<td>
                    <td><input type='text' name='email' id='email' placeholder="email@domain.com"></td>
                </tr>

                <tr>
                    <td>First Name<td>
                    <td><input type='text' name='firstName' id='firstName' placeholder="Audrey"></td>
                    <td>Last Name<td>
                    <td><input type='text' name='lastName' id='lastName' placeholder="Smith"></td>
                </tr>

                <tr>
                    <td>Password<td>
                    <td><input type='text' name='password' id='password' placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"></td>
                    <td>Confirm Passworde<td>
                    <td><input type='text' name='confirmPassword' id='confirmPassword' placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"></td>
                </tr>
            </tbody>
        </table>

</form>

        <div class='form-actions'>
            <button class='btn btn-primary' id='createBtn'>Create User</button>
            <button class='btn' id='cancelBtn'>Cancel</button>
        </div>




    </div> <!-- .span6 //-->

    <div class='span3'>

        <div class='row-fluid'>
            <div class='span12' align='center'>
            </div>
        </div>

    </div> <!-- .span3 //-->

</div> <!-- .row-fluid //-->
