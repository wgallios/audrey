var auth = {}

auth.indexInit = function()
{
    $('#authBtn').click(function(e){
        auth.authSite();
    });
}

auth.authSite = function()
{
    $('#authBtn').attr('disabled', 'disabled');

    $.getJSON("/auth/authsite", function(data){
            if (data.status == 'SUCCESS')
            {
                $('#key-display').html("<div class='key'>" + data.key + "</div>");
            }
            else if (data.status == 'ALERT')
            {
                global.renderAlert(data.msg);
            }
            else if (data.status == 'ERROR')
            {

                global.renderAlert(data.msg, 'alert-error');
            }

        $('#authBtn').removeAttr('disabled');
    });
}

auth.saveKey = function(key)
{

}
