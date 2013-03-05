var setup = {}

setup.indexInit = function()
{
    $('#setupBtn').click(function(e){
        setup.checkServer();
    });
}

setup.checkServer = function()
{

    if ($('#siteTitle').val() == '')
    {
        global.renderAlert("Please enter a site title!");
        $('#siteTitle').focus();
        return false;
    }

    if ($('#firstName').val() == '')
    {
        global.renderAlert("Please enter your first name!");
        $('#firstName').focus();
        return false;
    }

    if ($('#lastName').val() == '')
    {
        global.renderAlert("Please enter your last name!");
        $('#lastName').focus();
        return false;
    }

    if ($('#email').val() == '')
    {
        global.renderAlert("Please enter your email address!");
        $('#email').focus();
        return false;
    }

    if ($('#username').val() == '')
    {
        global.renderAlert("Please enter an admin username! (Example: admin)");
        $('#username').focus();
        return false;
    }

    if ($('#password').val() == '')
    {
        global.renderAlert("Please enter your desired admin password!");
        $('#password').focus();
        return false;
    }

    if ($('#confirmPassword').val() == '')
    {
        global.renderAlert("Please confirm your admin password!");
        $('#confirmPassword').focus();
        return false;
    }

    if ($('#password').val() != $('#confirmPassword').val())
    {
        global.renderAlert("The admin password you entered did not match!!");
        $('#confirmPassword').focus();
        $('#confirmPassword').select();
        return false;
    }

    if ($('#dbHost').val() == '')
    {
        global.renderAlert("Please enter the database host!");
        $('#dbHost').focus();
        return false;
    }

    if ($('#dbUser').val() == '')
    {
        global.renderAlert("Please enter the database user!");
        $('#dbUser').focus();
        return false;
    }

    if ($('#dbPassword').val() == '')
    {
        global.renderAlert("Please enter the database password!");
        $('#dbPassword').focus();
        return false;
    }

    if ($('#dbName').val() == '')
    {
        global.renderAlert("Please enter the database name (Note: if database is created, it will drop tables during the setup process!)!");
        $('#dbName').focus();
        return false;
    }

    $('#setupBtn').attr('disabled', 'disabled');

    $.post('/setup/checkserver', $('#setupForm').serialize(), function(data){
        if (data.status == 'SUCCESS')
        {
            global.renderAlert("Server has been configured! You will now be re-directed to your profile page.", 'alert-success');

            window.location = '/home';
        }
        else if (data.status == 'ERROR')
        {
            global.renderAlert(data.msg);

            $('#setupBtn').removeAttr('disabled');
        }
        else
        {
            global.renderAlert(data.msg + " (Error #" + data.errorNumber + ")", 'alert-error');

            $('#setupBtn').removeAttr('disabled');
        }

    }, 'json');
}
