var users = {}

users.indexInit = function()
{
    $('#createBtn').click(function(e){
            $(this).attr('disabled', 'disabled');
            window.location = '/users/create';
            });
}

users.createInit = function()
{
    $('#cancelBtn').click(function(e){

            if (confirm("Are you sure you wish to cancel?"))
            {
                $(this).attr('disabled', 'disabled');
                window.location = '/users';
            }

            });

    $('#createBtn').click(function(e){
                users.checkCreateForm();
            });
}

users.editInit = function()
{
    $('#saveBtn').click(function(e){
            users.checkEditForm();
            });

    $('#cancelBtn').click(function(e){

            if (confirm("Are you sure you wish to cancel?"))
            {
                $(this).attr('disabled', 'disabled');
                window.location = '/users';
            }

            });

    $('#deleteBtn').click(function(e){
            if (confirm("Are you sure you wish to delete this user?"))
            {
                users.deleteUser();
            }

            });
}

users.checkCreateForm = function()
{

    if ($('#username').val() == '')
    {
        global.renderAlert("Please enter a username!");
        $('#username').focus();
        return;
    }

    if ($('#email').val() == '')
    {
        global.renderAlert("Please enter an email address!");
        $('#email').focus();
        return;
    }

    if ($('#firstName').val() == '')
    {
        global.renderAlert("Please enter a first name!");
        $('#firstName').focus();
        return;
    }

    if ($('#lastName').val() == '')
    {
        global.renderAlert("Please enter a last name!");
        $('#lastName').focus();
        return;
    }

    if ($('#password').val() == '')
    {
        global.renderAlert("Please enter a password!");
        $('#password').focus();
        return;
    }

    if ($('#confirmPassword').val() == '')
    {
        global.renderAlert("Please confirm the password!");
        $('#confirmPassword').focus();
        return;
    }

    if ($('#password').val() != $('#confirmPassword').val())
    {
        global.renderAlert("Passwords do not match!");
        $('#password').focus();
        return;
    }

    $('#createBtn').attr('disabled', 'disabled');

    $.post("/users/checkusername", $('#createForm').serialize(), function(data){
        if (data.status == 'SUCCESS')
        {
            if (data.msg == 'AVAILABLE')
            {
                users.createUser();
            }
            else
            {
                global.renderAlert("The username " + $('#username').val() + " is in use!");
                $('#createBtn').removeAttr('disabled');
                return;
            }
        }
        else
        {
            global.renderAlert("Error: " + data.msg, 'alert-error');
            $('#createBtn').removeAttr('disabled');
            return;
        }

            }, 'json');
}

users.createUser = function()
{
    $.post("/users/createnew", $('#createForm').serialize(), function(data){
                window.location = '/users/edit/' + data.userid;
            }, 'json');
}

users.checkEditForm = function()
{

    if ($('#username').val() == '')
    {
        global.renderAlert("Please enter a username!");
        $('#username').focus();
        return;
    }


    if ($('#email').val() == '')
    {
        global.renderAlert("Please enter an email address!");
        $('#email').focus();
        return;
    }

    if ($('#firstName').val() == '')
    {
        global.renderAlert("Please enter a first name!");
        $('#firstName').focus();
        return;
    }

    if ($('#lastName').val() == '')
    {
        global.renderAlert("Please enter a last name!");
        $('#lastName').focus();
        return;
    }

    if ($('#currentPassword').val() != '')
    {
        if ($('#newPassword').val() != $('#confirmPassword').val())
        {
            global.renderAlert("New password does not match");
            $('#newPassword').focus();
            return;
        }
    }

    $('#saveBtn').attr('disabled', 'disabled');
    $('#cancelBtn').attr('disabled', 'disabled');
    $('#deleteBtn').attr('disabled', 'disabled');

    $.post("/users/save", $('#editUserForm').serialize(), function(data){
            if (data.status == 'SUCCESS')
            {
                global.renderAlert(data.msg, 'alert-success');
            }
            else if (data.status == 'ALERT')
            {
                global.renderAlert(data.msg);
            }
            else if (data.status == 'ERROR')
            {
                global.renderAlert(data.msg + " (Error #" + data.errorNumber + ")", 'alert-error');
            }

                $('#saveBtn').removeAttr('disabled');
                $('#cancelBtn').removeAttr('disabled');
                $('#deleteBtn').removeAttr('disabled');

            }, 'json');

}

users.deleteUser = function()
{

}
