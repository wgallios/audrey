var photos = {}

photos.indexInit = function()
{
    $('#createModalBtn').click(function(e){
        photos.checkAlbumName();
    });

    //photos.getAlbums();


    $('#fileList').selectable({
        filter: "li",
        selected: function (event, ui)
        {
            // clears previous right click if showing
            if ($('#right-click-menu').exists())
            {
                $('#right-click-menu').remove();
            }

            $(ui.selected).draggable({
            start: function (e, u)
            {
                // $(this).addClass('moving');
            },
            stop: function (e, u)
            {
                // $(this).removeClass('moving');
            },
            helper: function(){

                var selected = $('#fileList').find('.ui-selected');

                if (selected.length === 0)
                {
                    selected = $(this);
                }
                var container = $('<div/>').attr('id', 'draggingContainer');
                var clone = selected.clone();
                clone.addClass('moving');
                container.append(clone);
                // container.append(selected.clone());
                return container;
                }

            });
        },
        unselected: function (event, ui)
        {
            $(ui.unselected).draggable('destroy');
        }
    });



    // goes through each li in doc-container and makes draggable/droppable
    $('#doc-container').find("li").each(function(index, item)
    {

            // folders
            if ($(item).attr('itemType') == '1')
            {

                // folders are a drop zone
                $(item).droppable({
                    over: function (event, ui)
                    {
                        $(this).addClass('folder-highlight');
                    },
                    out: function (event, ui)
                    {
                        $(this).removeClass('folder-highlight');
                    },
                    drop: function (event, ui)
                    {
                        //docs.moveSelected(event, ui, $(this).attr('value'));
                        
                        $(this).removeClass('folder-highlight');
                    },
                    helper: function()
                    {
                        
                    }
                });

                // if they double click on a folder
                $(item).dblclick(function()
                {
                    $(item).attr('disabled', 'disabled');
                    window.location = "/photos/index/" + $(item).attr('value');
                    // window.open("/docs/index/" + $(item).attr('value'), '_blank');
                });
            }

            // documents
            if ($(item).attr('itemType') == '2')
            {

                // if they double click on a document
                $(item).dblclick(function()
                {
                    $(item).attr('disabled', 'disabled');
                    // window.location = "/docs/edit/" + $(item).attr('value') + "?folder=" + $('#folder').val();
                    window.location = "/photos/edit/" + $(item).attr('value') + "?folder=" + $('#folder').val();
                });

                // when the user right clicks on the screen
                $(item).mousedown(function(e){
                    switch (e.which)
                    {
                        case 3:
                        //docs.indexRightClick(e, $(item));
                        break;
                    }
                });
            }

    });

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

    $('#image-modal').on('hide', function (){
        photos.savePhotoEdit();
    });

    $('#selectable').selectable();
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
            var id = $(item).attr('id');

            //console.log("img: " + $(this).attr('src'));
            $(item).mouseover(function(e){
                $(this).switchClass('', 'enlarge', 100);
            });

            $(item).mouseout(function(e){
                $(this).switchClass('enlarge', '', 100);
            });

            $(item).click(function(e){
                photos.loadPhotoModal(id);
            });
        });
    });
}

photos.loadPhotoModal = function(id)
{
    $.get("/photos/editphoto/" + id, function(data){
        $('#image-modal-body').html(data);

    $('#defaultPicBtn').click(function(e){
        photos.setProfilePhoto();
    });

        CKEDITOR.replace('caption',{
        toolbar: [
           { name: 'document', items: [ 'Source', '-', 'Bold', 'Italic', 'Underline', ] }, // Defines toolbar group windowith name (used to create voice label) and items in 3 subgroups.
            [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight' ],
            [ 'Font', 'FontSize', 'TextColor' ],
            [ 'Smiley' ]
           //[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],// Defines toolbar group without name.
       ],
        height: 50
        });

        $('#image-modal').modal('show');
    });
}

photos.savePhotoEdit = function()
{
    CKEDITOR.instances.caption.updateElement();

    $.post("/photos/savePhotoEdit", $('#editPhotoForm').serialize(), function(data){

        if (data.status == 'ERROR')
        {
            global.renderAlert(data.msg, 'alert-error');
        }

    }, 'json');
}


photos.setProfilePhoto = function()
{

    $('#defaultPicBtn').attr('disabled', 'disabled');

    $('#img-wrapper').addClass('select');

    var container = $('<div/>').attr('id', 'selectContainer');

    $('#img-wrapper').append(container);

    // $('#img-wrapper').width() / 2;

    $('#selectContainer').resizable({
        containment: "#img-wrapper img",
        aspectRatio: 1/1
    });

    $('#selectContainer').draggable({
        containment: "#img-wrapper img"
    });
}


photos.moveSelected = function (event, ui, folder)
{
    $('#draggingContainer').find("li").each(function(index, item){

        // drop function for folders
        if ($(this).attr('itemType') == 1)
        {
            //docs.moveFolder(undefined, undefined, folder, $(this).attr('value'));
        }

        // drop function for images
        if ($(this).attr('itemType') == 2)
        {
            photos.addImgToFolder(undefined, undefined, folder, $(this).attr('value'));
        }
    });
}

photos.addImgToFolder = function (event, ui, folder, itemId)
{

    if (ui == undefined)
    {
        var id = itemId;
    }
    else
    {
        var id = $(ui.draggable).attr('value');
    }

    $.post("/photos/addImgToFolder", { id: id, folder: folder  }, function(data){
        if (data.status == 'SUCCESS')
        {
            if (ui == undefined)
            {
                $("#doc" + itemId).hide();
            }
            else
            {
                $(ui.draggable).hide();
            }
        }
        else if (data.stats == 'ALERT')
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
