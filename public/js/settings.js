var settings = {}


settings.indexInit = function()
{
    $('#saveBtn').click(function(e){
        settings.checkSettingsForm();
    });
}

settings.checkSettingsForm = function()
{
    if ($('#domain').val() == '')
    {
        global.renderAlert('Please enter a domain!');
        return false;
    }

    $.post("/settings/update", $('#settingsForm').serialize(), function(data){

        if (data.status == 'SUCCESS')
        {
            global.renderAlert(data.msg, 'alert-success');
        }
        else if (data.stats == 'ALERT')
        {
            global.renderAlert(data.msg);
        }
        else
        {
            global.renderAlert(data.msg + " (Error #" + data.errorNumber + ")", 'alert-error');
        }

    }, 'json');

}
