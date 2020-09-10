$(document).ready(function(){
    $('.logout').click(function() {
        event.preventDefault();
        $('#logout-form').submit();
    });
});
