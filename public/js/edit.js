var edit = {}

edit.indexInit = function()
{
    CKEDITOR.replace('aboutMe');

    $('#saveBtn').click(function(e){
            edit.checkEditForm();
            });

    $('#dob').datepicker({
        dateFormat: "yy-mm-dd"
    });
}

edit.checkEditForm = function()
{

    if ($('#siteTitle').val() == '')
    {
        global.renderAlert("Please enter a site title!");
        $('#firstName').focus();
        return false;
    }

    if ($('#firstName').val() == '')
    {
        global.renderAlert("Please enter a first name!");
        $('#firstName').focus();
        return false;
    }

    if ($('#lastName').val() == '')
    {
        global.renderAlert("Please enter a last name!");
        $('#lastName').focus();
        return false;
    }

    edit.saveInformation();
}

edit.saveInformation = function()
{
    CKEDITOR.instances.aboutMe.updateElement();

    $('#saveBtn').attr('disabled', 'disabled');

    $.post("/edit/saveinfo", $('#editForm').serialize(), function(data){
                if (data.status == 'SUCCESS')
                {
                    global.renderAlert("Information saved!", 'alert-success');
                }
                else
                {
                    global.renderAlert(data.msg + " (Error #" + data.errorNumber + ")", 'alert-error');
                }

                $('#saveBtn').removeAttr('disabled');

            }, 'json');
}
