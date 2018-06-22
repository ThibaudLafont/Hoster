$('#add-button').click(function(e){
    e.preventDefault();
    $('.ui.page.dimmer').dimmer('show');
});

$('.ui.submit.button').click(function(e){
    var doDimmer = true;

    // Distant form
    if($('#distant_name').val() === '') {
        doDimmer = false;
    }
    if($('#distant_url').val() === '') {
        doDimmer = false;
    }

    // Local form
    if($('#image_name').val() === '') {
        doDimmer = false;
    }
    if($('#image_alt').val() === '') {
        doDimmer = false;
    }
    if($('#image_file').length !== 0){
        if($('#image_file').prop('files').length === 0) {
            doDimmer = false;
        }
    }

    if(doDimmer){
        $('#loader').dimmer('show');
    }
});

$('#form-error-button').click(function(e){
    e.preventDefault();
    $('.ui.page.dimmer').dimmer('show');
});

$('.ui.page.dimmer #close-button').click(function(){
    $('.ui.page.dimmer').dimmer('hide');
})