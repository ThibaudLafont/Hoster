$('#add-button').click(function(e){
    e.preventDefault();
    $('.ui.page.dimmer').dimmer('show');
});

$('.ui.submit.button').click(function(){
    $('#loader').dimmer('show');
})