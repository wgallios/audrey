var setup = {}

setup.indexInit = function()
{
    $('#setupBtn').click(function(e){
        setup.checkServer();
    });
}

setup.checkServer = function()
{
    $('#setupBtn').attr('disabled', 'disabled');

    $.post('/setup/checkserver', $('#setupForm').serialize(), function(data){
        if (data.status == 'SUCCESS')
        {
            global.renderAlert("Server has been configured! You will now be re-directed to your profile page.", 'alert-success');
        }
        else if (data.status == 'ERROR')
        {
            global.renderAlert(data.msg);
        }
        else
        {
            global.renderAlert(data.msg + " (Error #" + data.errorNumber + ")", 'alert-error');
        }

        $('#setupBtn').removeAttr('disabled');
    }, 'json');
}
