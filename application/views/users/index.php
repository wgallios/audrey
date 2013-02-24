<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class='row-fluid'>

    <div class='span3'>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR . 'nav.php' ?>
    </div> <!-- .span3 //-->

    <div class='span6'>
        <h1>Users</h1>
<?php
if (!empty($users))
{

echo <<< EOS
        <table class='table table-hover'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <td>Last Name</td>
                    <td>Username</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
EOS;


    foreach($users as $r)
    {
        echo "<tr>\n";

        echo "\t<td>{$r->id}</td>\n";
        echo "\t<td>{$r->firstName}</td>\n";
        echo "\t<td>{$r->lastName}</td>\n";
        echo "\t<td>{$r->username}</td>\n";
        echo "\t<td>{$r->statusDisplay}</td>\n";
        echo "\t<td><a href='/users/edit/{$r->id}' class='btn btn-link'><i class='icon-pencil'></i></a></td>\n";

        echo "</tr>\n";
    }

    echo "\t</tbody>\n";
    echo "</table>\n";
}
?>


    </div> <!-- .span6 //-->

    <div class='span3'>

        <div class='row-fluid'>
            <div class='span12' align='center'>
                <button type='button' class='btn btn-inverse btn-large' id='createBtn'>Create New User</button>
            </div>
        </div>

    </div> <!-- .span3 //-->

</div> <!-- .row-fluid //-->
