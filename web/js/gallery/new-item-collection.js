function onDistantDimmerSubmit(ajaxUrl) {
    $('.ui.dimmer.page button[type="submit"]').click(function(e){
        e.preventDefault();

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
                ajaxSucess(text)
            },
            error: function(text) {
                console.log(text)
            }
        });
    })
}

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

// ImageForm
function ajaxSucess(text) {
    // Build new-item form
    var newForm = $('<div class="new-item-form"></div>');
    newForm.append($($('.new-item-form').contents()));


    newForm.find('.newitem-id').val(text['id']);
    newForm.find('.newitem-type').val(text['type']);

    appendNewTableRow(text['url'], text['name'], '<i class="' + 'ui image icon' + '"></i>', newForm)

    $('.ui.page.dimmer').dimmer('hide');
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
    // Youtube
    initCollection(
        $('.media-new-distant-parent'),
        '<i class="ui plus icon"></i>Youtube',
        onNewYoutubeDimmerSubmit
    )

    // Dailymotion
    initCollection(
        $('.media-new-distant-parent'),
        '<i class="ui plus icon"></i>Dailymotion',
        onNewDailymotionDimmerSubmit
    )

    // Vimeo
    initCollection(
        $('.media-new-distant-parent'),
        '<i class="ui plus icon"></i>Vimeo',
        onNewVimeoDimmerSubmit
    )

    // Image
    initCollection(
        $('.media-new-image-parent'),
        '<i class="ui plus icon"></i>Image',
        onNewImageDimmerSubmit
    )
});