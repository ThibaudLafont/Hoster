function UpDownDeleteEvents(form) {
    // Up button
    form.find(".up").unbind('click').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var row = $(this).parents("tr");
        row.insertBefore(row.prev());
    });
    // Down button
    form.find(".down").unbind('click').click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var row = $(this).parents("tr:first");
        row.insertAfter(row.next());
    });
    // Delete button
    form.find('.delete').unbind('click').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        var row = $(this).parents("tr:first");
        row.remove();
    });
}

function initCollection($collectionHolder, $button, $function) {
    // Create add button & insert
    var $addItemButton = $($button);
    $('#add-media-buttons').append($addItemButton);

    // Define index in table
    $('#gallery-medias').data('index', $('#gallery-medias tbody').find('tr').length);

    // Add item click event
    $addItemButton.click(function(e){
        e.preventDefault();

        // Get the data-prototype from holder
        var prototype = $collectionHolder.data('prototype');

        // Store prototype
        var newForm = prototype;

        // Clear dimmer
        $('.ui.page.dimmer').empty();

        // Append form in dimmer
        $('.ui.page.dimmer').append(newForm);

        // Show dimmer
        $('.ui.page.dimmer').dimmer('show');

        $function()
    })
}

function appendNewTableRow(thumbnail, name, icon, form) {
    // Create elements of new line
    var line = $('<tr class="media-form-row"></tr>');
    var preview = $('<td class="collapsing"><img class="ui small image" src="' + thumbnail + '"></td>');
    var name = $('<td>'+ icon + name + '</td>');
    var actions = $('<td class="collapsing"></td>');

    // get the new index
    var index = $('#gallery-medias').data('index');

    // Replace '__name__' in the prototype's HTML
    form = form.html().replace(/__name__/g, index)

    // increase the index with one for the next item
    $('#gallery-medias').data('index', index + 1);

    form = $(form)

    actions.append(form);

    UpDownDeleteEvents(form);

    // Append columns to row
    line.append(preview);
    line.append(name);
    line.append(actions)

    // Append new row to table
    $('table').append(line);
}

// Inquire position fields at submit
$(document).ready(function(){
    $('.submit').click(function(e){
        var i = 1;
        var rows = $('tbody').find('tr');
        rows.each(function(){
            var position = $(this).find('.item-position');
            position.attr('value', i);
            i++;
        })
    })
})