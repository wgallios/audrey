var photos = {}

photos.indexInit = function()
{
    $('#createModalBtn').click(function(e){
        photos.checkAlbumName();
    });

    photos.getAlbums();

}

photos.checkAlbumName = function()
{
    if ($('#albumName').val() == '')
    {
        $('#albumName').focus();
        global.renderAlert("Please enter an album name!", undefined, 'modalAlert');
        return false;
    }

    $('#createModalBtn').attr('disabled', 'disabled');

    // create album
    $.post('/photos/createalbum', $('#createAlbumForm').serialize(), function(data){

        if (data.status == 'SUCCESS')
        {
            photos.getAlbums();
        }
        else
        {
            global.renderAlert(data.msg + " (Error #" + data.errorNumber + ")", 'alert-error', 'modalAlert');
        }

        $('#createModalBtn').removeAttr('disabled');
    }, 'json');
}

photos.getAlbums = function()
{
    global.ajaxLoader('#album-display');

    $.get('/photos/albums', function(data){
        $('#album-display').html(data);
    });
}
