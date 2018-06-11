function onNewImageDimmerSubmit() {
    $('.ui.dimmer.page button[type="submit"]').click(function(e){
        e.preventDefault();

        // Build Form data and get values
        var data = new FormData();
        data.append('image[name]',   $('#image_name').val());
        data.append('image[alt]',    $('#image_alt').val());
        data.append('image[file]',  $('#image_file').prop('files')[0]);
        data.append('image[_token]', $('#image__token').val());

        // Ajax request
        $.ajax({
            method: "POST",
            url: "/add/image/ajax",
            data: data,
            processData: false,
            contentType: false,
            success: function(text) {
                ajaxSucess(text)
            }
        });
    })
}

jQuery(document).ready(function() {
    // Append add button
    initCollection(
        $('.media-new-image-parent'),
        '<i class="ui plus icon"></i>Image',
        onNewImageDimmerSubmit
    )
});

// ImageForm
function ajaxSucess(text, newForm) {

    newForm.find('.newitem-id').val(text['id']);
    newForm.find('.newitem-type').val(text['type']);

    appendNewTableRow(text['url'], text['name'], '<i class="' + 'ui image icon' + '"></i>', newForm)

    $('.ui.page.dimmer').dimmer('hide');
}