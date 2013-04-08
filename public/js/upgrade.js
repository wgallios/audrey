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
    });

}

