var asnp = {}


asnp.domain = 'http://asnp.co'

$(function(){

    if (asnp.userid == '' || asnp.userid == undefined)
    {
        //do nothing
    }
    else
    {
        //asnp.homeDomain = asnp.domain;
        asnp.setCookie('domain', document.domain, 30);

    }



});

asnp.setCookie = function(name, value, days)
{
    $.post(asnp.domain + '/hub/setCookie', { name: name, value: value, days: days  }, function(data){

        if (data.status == 'ERROR')
        {
            alert(data.msg);
            return false;
        }

    }, 'json');
}

asnp.readCookie = function(name)
{
    $.get(asnp.domain + '/hub/readcookie/' + escape(name), function(data){
        alert(data);
    }); 
} 
