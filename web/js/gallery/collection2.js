function onNewImageDimmerSubmit() {
        $('.ui.dimmer.page button[type="submit"]').click(function(e){
            e.preventDefault();

            var newForm = $($('.image-item-form').contents())
            
            // Get Form data
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
                    ajaxSucess(text, newForm)
                }
            });
        })
}

jQuery(document).ready(function() {
    // Append add button
    initCollection(
        $('.media-newitem-parent'),
        '<i class="ui plus icon"></i>',
        onNewImageDimmerSubmit
    )
});

// // ImageForm
function ajaxSucess(text, newForm) {

    // newForm = $(newForm)
    newForm.find('.newitem-id').val(text['id']);
    newForm.find('.newitem-type').val(text['type']);

    appendNewTableRow(text['url'], text['name'], '<i class="' + 'ui image icon' + '"></i>', newForm)

    $('.ui.page.dimmer').dimmer('hide');
}
//
// jQuery(document).ready(function() {
//     // Define Collection holder
//     $collectionHolder = $('.media-newitem-parent');
//
//     // Append add button
//     appendAddButton($('.media-item-parent'), '<i class="ui folder button"></i>')
//
//     // count the current form inputs we have, use that as the new
//     // index when inserting a new item
//     $collectionHolder.data('index', $collectionHolder.find(':input').length);
//
//     $addImageButton.on('click', function(e) {
//         // prevent the link from creating a "#" on the URL
//         e.preventDefault();
//
//         // Display form in dimmer
//         var $form = $('#new-image-form');
//         $form.attr('style', 'display: block');
//         $('.ui.dimmer.page').empty();
//         $('.ui.dimmer.page').append($form);
//         $('.ui.dimmer.page').dimmer('show')
//
//         // Add event on upload button
//         $('.ui.dimmer.page button[type="submit"]').click(function(e){
//             e.preventDefault();
//
//             // Get Form data
//             var data = new FormData();
//             data.append('image[name]',   $('#image_name').val());
//             data.append('image[alt]',    $('#image_alt').val());
//             data.append('image[file]',  $('#image_file').prop('files')[0]);
//             data.append('image[_token]', $('#image__token').val());
//
//             // Ajax request
//             $.ajax({
//                 method: "POST",
//                 url: "/add/image/ajax",
//                 data: data,
//                 processData: false,
//                 contentType: false,
//                 success: function(text) {
//                     ajaxSucess(text)
//                 }
//             });
//         })
//     });
// });
