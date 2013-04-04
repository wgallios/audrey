var home = {}

home.loginInit = function()
{
    $('#loginBtn').click(function(e){
        $('#loginForm').submit();
        $('#loginBtn').attr('disabled', 'disabled');
            });
}
