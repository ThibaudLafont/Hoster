// ImageForm
function ajaxSucess(text) {
    // Get prototype
    var prototype = $('.media-newitem-parent').data('prototype');

    // get the new index
    var index = $('.media-newitem-parent').data('index');

    // Replace '__name__' in the prototype's HTML
    var newForm = prototype
    newForm = newForm.replace(/__name__/g, index);
    newForm = $(newForm)
    newForm.find('.newitem-id').val(text['id']);
    newForm.find('.newitem-type').val(text['type']);
    newForm.append('<a href="#" class="up">Up</a>');
    newForm.append('<a href="#" class="down">Down</a>');
    newForm.append('<a href="#" class="delete">Delete</a>');

    // increase the index with one for the next item
    $('.media-newitem-parent').data('index', index + 1);

    // Up button
    newForm.find(".up").click(function () {
        e.preventDefault();
        var row = $(this).parents("tr:first");
        row.insertBefore(row.prev());
    });
    // Down button
    newForm.find(".down").click(function () {
        e.preventDefault();
        var row = $(this).parents("tr:first");
        row.insertAfter(row.next());
    });
    // Delete button
    newForm.find('.delete').click(function(){
        e.preventDefault();
        var row = $(this).parents("tr:first");
        row.remove();
    });


    // Create elements of new line
    var line = $('<tr class="media-form-row"></tr>');
    var preview = $('<td class="collapsing"><img class="ui small image" src="' + text['url'] + '"></td>');
    var name = $('<td><i class="' + 'ui image icon' + '"></i>' + text['name'] + '</td>');
    var actions = $('<td></td>');
    actions.append(newForm);

    // Append columns to row
    line.append(preview);
    line.append(name);
    line.append(actions)

    // Append new row to table
    $('table').append(line);

    $('.ui.page.dimmer').dimmer('hide');
}

jQuery(document).ready(function() {
    // Create add button & insert
    var $addImageButton = $('<a class="ui green icon button add_tag_link"><i class="ui plus icon"></i>Image</a>');
    var $newImageLi = $('<li></li>').append($addImageButton);
    var $collectionHolder = $('.media-newitem-parent');
    $collectionHolder.append($newImageLi);

    // count the current form inputs we have, use that as the new
    // index when inserting a new item
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addImageButton.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // Display form in dimmer
        var $form = $('#new-image-form');
        $form.attr('style', 'display: block');
        $('.ui.dimmer.page').empty();
        $('.ui.dimmer.page').append($form);
        $('.ui.dimmer.page').dimmer('show')

        // Add event on upload button
        $('.ui.dimmer.page button[type="submit"]').click(function(e){
            e.preventDefault();

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
                    ajaxSucess(text)
                }
            });
        })
    });
});
