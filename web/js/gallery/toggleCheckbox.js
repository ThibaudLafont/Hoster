// Toggle function
function toggleCheckbox(elt)
{
    // Toggle checkbox
    if(elt.hasClass('checked')) { // If is checked

        // Ui checkbox
        elt.removeClass('checked');
        // Input checkbox
        elt.children('input').removeAttr('checked');

    } else {                      // If non-checked

        // Ui checkbox
        elt.addClass('checked');
        // Input checkbox
        elt.children('input').attr('checked', true);

    }
}

// init checkboxes
$('.ui.checkbox').checkbox();

$('.ui.card').click(function(e) {
    // Store checkbox
    var checkbox = $(this).children('.image').children('.ui.checkbox');
    // Toggle
    toggleCheckbox(checkbox)
})