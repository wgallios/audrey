var upgrade = {}

upgrade.indexInit = function()
{
    $('#upgradeBtn').click(function(e){
        upgrade.performUpgrade();
    });
}

upgrade.performUpgrade = function()
{
    $('#btnP').hide();
    global.ajaxLoader('#loader');

    $.getJSON('/upgrade/process', function(data){

        if (data.status == 'SUCCESS')
        {
            $('#loader').hide();

            global.renderAlert(data.msg, 'alert-success');

            window.setTimeout(function(){
                window.location = '/';
            }, 10000);
        }
        else
        {
            global.renderAlert(data.msg + " (Error #" + data.errorNumber + ")", 'alert-error');
        }
    });

}

