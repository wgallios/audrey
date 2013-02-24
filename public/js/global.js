var global = {}

/*
 * renders a site wide alert
 *
 * @param String msg - msg to be displayed
 * @param String type (optional) - type of message to be displayed, default is blank, alternate types: 'alert-success', 'alert-error' or 'alert-info'
 * @param String id (optional) - specifcy custom div ID to display the error
 */

global.renderAlert = function(msg, type, id)
{
    var header = "Alert!";

    if (id == undefined)
    {
        id = "site-alert";

        $("html, body").animate({ scrollTop: 0 }, "slow");
    }

    if (msg == '' || msg == undefined)
    {
        $("#" + id).html('');
        return;
    }

    if (type == undefined)
    {
        type = '';
    }

    //$("#" + id).html("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style=\"padding: 0 .7em;\"><p><span class='ui-icon ui-icon-alert' style=\"float: left; margin-right: .3em;\"></span><strong>Alert:</strong> "+msg+"</p></div></div>");


    if (type == 'alert-error') header = "Error!";
    if (type == 'alert-info') header = 'Information';
    if (type == 'alert-success') header = 'Success!';

    $('#' + id).html("<div class='alert " + type + "'><button type='button' class='close' data-dismiss='alert'>&times;</button><h4>" + header + "</h4> " + msg +"</div>");
return true;

}

global.selectAllToggle = function(divId, sel)
{

    if (sel == undefined)
    {
        sel = true;
    }

    $('#' + divId).find("input").each(function(index, item){
        if ($(item).attr('type') == 'checkbox')
        {
            $(item).prop('checked', sel);
        }
    });
}

/**
 * checks if an email address is valid
 */
global.checkEmail = function(inputvalue)
{
    var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

    if(pattern.test(inputvalue))
    {
        return true;
    }
    else
    {
        return false;
    }
}
