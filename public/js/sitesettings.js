var sitesettings = {}


sitesettings.indexInit = function()
{
    $('#saveBtn').click(function(e){
        sitesettings.checkSettingsForm();
    });
}

sitesettings.checkSettingsForm = function()
{
    if ($('#domain').val() == '')
    {
        global.renderAlert('Please enter a domain!');
        return false;
    }

    $.post("/sitesettings/update", $('#settingsForm').serialize(), function(data){

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
