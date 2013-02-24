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
    $('#cancelBtn').click(function(e){

            if (confirm("Are you sure you wish to cancel?"))
            {
                $(this).attr('disabled', 'disabled');
                window.location = '/users';
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
}
