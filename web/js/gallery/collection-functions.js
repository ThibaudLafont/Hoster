function UpDownDeleteEvents(form) {
    // Up button
    form.find(".up").click(function (e) {
        e.preventDefault();
        var row = $(this).parents("tr:first");
        row.insertBefore(row.prev());
    });
    // Down button
    form.find(".down").click(function (e) {
        e.preventDefault();
        var row = $(this).parents("tr:first");
        row.insertAfter(row.next());
    });
    // Delete button
    form.find('.delete').click(function(e){
        e.preventDefault();
        var row = $(this).parents("tr:first");
        row.remove();
    });
}

function initCollection($collectionHolder, $buttonContent, $function) {
    // Create add button & insert
    var $addItemButton = $('<a class="ui green icon button">' + $buttonContent + '</a>');
    var $newItemLi = $('<li></li>').append($addItemButton);
    $collectionHolder.append($newItemLi);

    // Define index
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    // Add item click event
    $addItemButton.click(function(e){
        e.preventDefault();

        // Get the data-prototype from holder
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        // Store prototype
        var newForm = prototype;

        // Replace '__name__' in the prototype's HTML
        newForm = newForm.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

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
    var name = $('<td><i class="' + icon + '"></i>' + name + '</td>');
    var actions = $('<td></td>');
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