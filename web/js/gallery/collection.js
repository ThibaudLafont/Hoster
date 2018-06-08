// Inquire position fields at submit
$('.submit').click(function(e){
    var i = 1;
    var rows = $('tbody').find('tr');
    rows.each(function(){
        var position = $(this).find('.item-position');
        position.attr('value', i);
        i++;
    })
})

jQuery(document).ready(function() {
    // Create add button & insert
    var $addItemButton = $('<a class="ui green icon button add_tag_link"><i class="ui folder icon"></i></a>');
    var $newItemLi = $('<li></li>').append($addItemButton);
    var $collectionHolder = $('.media-item-parent');
    $collectionHolder.append($newItemLi);

    // count the current form inputs we have, use that as the new
    // index when inserting a new item
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addItemButton.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // Get the data-prototype
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        // Get prototype
        var newForm = prototype;

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Clear dimmer
        $('.ui.page.dimmer').empty();

        // Append form in dimmer
        $('.ui.page.dimmer').append(newForm);

        // Show dimmer
        $('.ui.page.dimmer').dimmer('show');

        // Add event on click
        $('.gallery-item').click(function(e){
            // Get data from clicked item
            var form = $(this).children('.media-form');
            var src = $(this).children('.media-form').attr('src');
            var name = $(this).children('.media-form').attr('name');
            var icon = $(this).children('.media-form').attr('icon');

            // Check form option
            form.find('input[type="radio"]').attr('checked', true);
            // Up button
            form.find(".up").click(function () {
                e.preventDefault();
                var row = $(this).parents("tr:first");
                row.insertBefore(row.prev());
            });
            // Down button
            form.find(".down").click(function () {
                e.preventDefault();
                var row = $(this).parents("tr:first");
                row.insertAfter(row.next());
            });
            // Delete button
            form.find('.delete').click(function(){
                e.preventDefault();
                var row = $(this).parents("tr:first");
                row.remove();
            });


            // Create elements of new line
            var line = $('<tr class="media-form-row"></tr>');
            var preview = $('<td class="collapsing"><img class="ui small image" src="' + src + '"></td>');
            var name = $('<td><i class="' + icon + '"></i>' + name + '</td>');
            var actions = $('<td></td>');
            actions.append(form);

            // Append columns to row
            line.append(preview);
            line.append(name);
            line.append(actions)

            // Append new row to table
            $('table').append(line);

            // Hide dimmer
            $('.ui.page.dimmer').dimmer('hide');
        });
    });
});
