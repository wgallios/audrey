var posts = {}

posts.timer;
posts.timeout = 15000; // milliseconds till check for new posts


$(function(){
    posts.getstream(true);

    // posts.timer = window.setTimeout(posts.newPosts, wall.timeout);

    $('#post').autosize();

    $('#pagePostBtn').click(function(e){
        posts.post();
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10)
        {
            //wall.loadPrevPosts();
        }
    });

    var mh = "<div id='whoLikeModal' class='modal hide' role='dialog'>" +
             "<div class='modal-header'>" + 
             "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times</button>" +
             "<h3>People who like this</h3>" +
             "</div>" +
             "<div class='modal-body' id='whoLikeDisplay'></div>" +
             "<div class='modal-footer'><a href=\"javascript:void(0);\" class='btn btn-primary' onclick=\"wall.hideWhoLikes();\">Close</a></div></div>";

    $('body').append(mh);
});

posts.post = function()
{
    // clearTimeout(posts.timer);

    if ($('#post').val() == '')
    {
        global.renderAlert("Please enter something to post!", undefined, 'postAlert');
        return false;
    }


    $('#pagePostBtn').attr('disabled', 'disabled');

    $.post('/posts/post', $('#pagePostForm').serialize(), function(data){

        if (data.status = 'SUCCESS')
        {
            $('#post').val('');
            $('#pagePostBtn').removeAttr('disabled');

            posts.getstream(false);
            //alert(data);

            // posts.newPosts();
        }
        else
        {
            global.renderAlert(data.msg, 'alert-error', 'postAlert');
            return false;
        }
    }, 'json');

    //wall.update();
}


posts.newPosts = function()
{

    $.get("/posts/stream?top=" + $('#top').val(), function(data){

        //setTimeout(wall.newPosts, wall.timeout);

        if (data.length > 0)
        {

            $('#posts-display').prepend(data);

            var topId = '';

            /*
            $('#post-display').find("input").each(function(index, item){
                if ($(this).attr('name') == 'id[]')
                {
                    topId = $(this).val();
                    return false;
                }
            });

            $('#top').val(topId);
            $('input[name=top]').val(topId);
            */
        posts.textAutosize();
        }

        //wall.update();
    });
}


posts.textAutosize = function()
{
    $('#posts-display').find("textarea").each(function(index, item){
        $(this).autosize();
        $(this).placeholder();
    });
}


posts.getstream = function(loading)
{
    if (loading == undefined) loading = false;

    if (loading == true)
    {
        posts.showLoader();
    }
    $.get('/posts/stream', function(data){

        $('#load_comments').val('1');
        $('input[name=load_comments]').val('1');

        $('#posts-display').html(data);
        posts.textAutosize();

       posts.clearLoader();
    });
}


posts.showLoader = function()
{

    global.ajaxLoader('#posts-loader-display');
}

posts.clearLoader = function()
{
    $('#posts-loader-display').html("");
}
