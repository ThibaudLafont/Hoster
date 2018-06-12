function onDistantDimmerSubmit(ajaxUrl) {
    $('.ui.dimmer.page button[type="submit"]').click(function(e){
        e.preventDefault();

        $('#new-distant-dimmer .dimmer').dimmer('show');

        // Build Form data and get values
        var data = new FormData();
        data.append('distant[name]',   $('#distant_name').val());
        data.append('distant[url]',    $('#distant_url').val());
        data.append('distant[_token]', $('#distant__token').val());

        // Ajax request
        $.ajax({
            method: "POST",
            url: ajaxUrl,
            data: data,
            processData: false,
            contentType: false,
            success: function(text) {
                $('#new-distant-dimmer .dimmer').dimmer('hide');
                ajaxSucess(text, 'ui video icon')
            },
            error: function(text) {
                $('#new-distant-dimmer .dimmer').dimmer('hide');
                ajaxError(text)
            }
        });
    })
}

function onNewImageDimmerSubmit() {
    $('.ui.dimmer.page button[type="submit"]').click(function(e){
        e.preventDefault();

        $('#new-image-dimmer .dimmer').dimmer('show');

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
                $('#new-image-dimmer .dimmer').dimmer('hide');
                ajaxSucess(text, 'ui image icon')
            },
            error: function(text) {
                $('#new-image-dimmer .dimmer').dimmer('hide');
                ajaxError(text)
            }
        });
    })
}

// ImageForm
function ajaxSucess(text, icon) {
    // Build new-item form
    var newForm = $('<div class="new-item-form"></div>');
    newForm.append($($('.ui.page.dimmer .new-item-form').contents()));

    // Append new row
    appendNewTableRow(text['url'], text['id'], text['name'], '<i class="' + icon + '"></i>', newForm)

    // Hide dimmer
    $('.ui.page.dimmer').dimmer('hide');
}

function ajaxError(text) {
    // Delete content in case of present errors
    $('.ui.page.dimmer .form-errors').empty();

    // UTF8 decode & return line adapt
    try {
        text = $.parseJSON(text.responseText);
    } catch (e) {
        text = "Problème serveur"
    }
    text = text.replace(/\n/g, "<br/>");

    // Create element with errors
    var content = $('<p class="ui error message">' + text + '</p>');

    // Append errors in form
    $('.ui.page.dimmer .form-errors').append(content);
}

// Youtube callback
function onNewYoutubeDimmerSubmit() {
    onDistantDimmerSubmit('/add/youtube/ajax')
}
// Dailymotion callback
function onNewDailymotionDimmerSubmit() {
    onDistantDimmerSubmit('/add/dailymotion/ajax')
}
// Vimeo callback
function onNewVimeoDimmerSubmit() {
    onDistantDimmerSubmit('/add/vimeo/ajax')
}

// Init collections
jQuery(document).ready(function() {
    // Image
    initCollection(
        $('.media-new-image-parent'),
        '<a class="ui green labeled icon button"><i class="ui plus icon"></i>Image</a>',
        onNewImageDimmerSubmit
    )

    // Youtube
    initCollection(
        $('.media-new-distant-parent'),
        '<a class="ui green labeled icon button"><i class="ui plus icon"></i>Youtube</a>',
        onNewYoutubeDimmerSubmit
    )

    // Dailymotion
    initCollection(
        $('.media-new-distant-parent'),
        '<a class="ui green labeled icon button"><i class="ui plus icon"></i>Dailymotion</a>',
        onNewDailymotionDimmerSubmit
    )

    // Vimeo
    initCollection(
        $('.media-new-distant-parent'),
        '<a class="ui green labeled icon button"><i class="ui plus icon"></i>Vimeo</a>',
        onNewVimeoDimmerSubmit
    )
});