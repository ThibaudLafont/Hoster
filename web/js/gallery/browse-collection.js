function onBrowseDimmerSubmit() {
    // Add event on click
    $('.gallery-item').click(function(e){
        // Get data from clicked item
        var form = $(this).children('.media-form');
        var src = $(this).children('.media-form').attr('src');
        var name = $(this).children('.media-form').attr('name');
        var icon = '<i class="' + $(this).children('.media-form').attr('icon') + '"></i>';

        // Check form option
        form.find('input[type="radio"]').attr('checked', true);

        // Append new table row
        appendNewTableRow(src, name, icon, form);

        // Hide dimmer
        $('.ui.page.dimmer').dimmer('hide');
    });
}

jQuery(document).ready(function() {
    // Append add button
    initCollection(
        $('.media-item-parent'),
        '<i class="ui folder icon"></i>',
        onBrowseDimmerSubmit
    )
});
