
<div class='row'>
<div class='span4  well'>
<h2>Login</h2>

<form name='loginForm' id='loginForm' method='post' action='/home/login'>
    <input type='hidden' name='ref' value='<?=$_GET['ref']?>'>

<table class='login-tbl' align='center'>
    <tbody>
        <tr>
            <td><strong>Username</strong></td>
        </tr>
        <tr>
            <td><input type='text' name='username' autocomplete="off"></td>
        </tr>
        <tr>
            <td><strong>Password</strong></td>
        </tr>
        <tr>
            <td><input type='password'  name='password' autocomplete="off"></td>
        </tr>
        <tr>
            <td><button type='submit' id='loginBtn' class='btn btn-primary'>Login</button></td>
        </tr>
    </tbody>
</table>

</form>
</div>
</div>
