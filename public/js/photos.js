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
            $('#createAlbumModal').modal('hide');
            $('#albumName').val('');
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

photos.editalbumInit = function()
{
    $('#cancelBtn').click(function(e){
        $(this).attr('disabled', 'disabled');
        window.location = "/photos";
    });


    // loads draggable pictures
    $('#all-pictures').find("div").each(function(index, item)
    {
        //var eid  = $(item).val();
       $(item).draggable({
            revert:true
       });
    });

    // loads drop zone
    $('#photo-drop').droppable({
    
        over: function (event, ui)
        {
            $(this).addClass('hover');
        },
        out: function (event, ui)
        {
            $(this).removeClass('hover');
        },
        drop: function (event, ui)
        {
            $(this).removeClass('hover');
            photos.albumAddPhoto(event, ui);
        }
    });

    photos.getPhotoAlbum();
}

photos.albumAddPhoto = function(event, ui)
{
    // alert("value: " + $(ui.draggable).attr('value'));

    $.post("/photos/albumaddphoto", { albumId: $('#id').val(), file: $(ui.draggable).attr('value') }, function(data){

        if (data.status == 'SUCCESS')
        {
            photos.getPhotoAlbum();
        }
        else if (data.status == 'ALERT')
        {
            global.renderAlert(data.msg);
            return false;
        }
        else
        {
            global.renderAlert(data.msg, 'alert-error');
            return false;
        }

    }, 'json');
}

photos.getPhotoAlbum = function()
{
    global.ajaxLoader('#photo-drop');

    $.get("/photos/photoalbum/" + $('#id').val(), function(data){
        $('#photo-drop').html(data);

        $('#album-container').find("img").each(function(index, item)
        {

            var src = $(item).attr('src');

            //console.log("img: " + $(this).attr('src'));
            $(item).mouseover(function(e){
                $(this).switchClass('', 'enlarge', 100);
            });

            $(item).mouseout(function(e){
                $(this).switchClass('enlarge', '', 100);
            });

            $(item).click(function(e){
                photos.loadPhotoModal(src);
            });
        });
    });
}

photos.loadPhotoModal = function(src)
{
    $.get("/photos/editphoto", function(data){
        $('#image-modal-body').html(data);
        $('#image-modal').modal('show');
    });
}
