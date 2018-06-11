function onNewYoutubeDimmerSubmit() {
    onDistantDimmerSubmit('/add/youtube/ajax')
}
function onNewDailymotionDimmerSubmit() {
    onDistantDimmerSubmit('/add/dailymotion/ajax')
}
function onNewVimeoDimmerSubmit() {
    onDistantDimmerSubmit('/add/vimeo/ajax')
}

function onDistantDimmerSubmit(ajaxUrl) {
    $('.ui.dimmer.page button[type="submit"]').click(function(e){
        e.preventDefault();

        // Build new-item form
        var newForm = $('<div class="new-youtube-form"></div>');
        newForm.append($($('.new-item-form').contents()));

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
                ajaxSucess(text, newForm)
            },
            error: function(text) {
                console.log(text)
            }
        });
    })
}

jQuery(document).ready(function() {
    // Append add button
    initCollection(
        $('.media-new-distant-parent'),
        '<i class="ui plus icon"></i>Youtube',
        onNewYoutubeDimmerSubmit
    )
});

jQuery(document).ready(function() {
    // Append add button
    initCollection(
        $('.media-new-distant-parent'),
        '<i class="ui plus icon"></i>Dailymotion',
        onNewDailymotionDimmerSubmit
    )
});

jQuery(document).ready(function() {
    // Append add button
    initCollection(
        $('.media-new-distant-parent'),
        '<i class="ui plus icon"></i>Vimeo',
        onNewVimeoDimmerSubmit
    )
});