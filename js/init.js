(function ($) {
    $(function () {

        $('.sidenav').sidenav();

    }); // end of document ready
})(jQuery); // end of jQuery name space


document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.datepicker');
    var elems = document.querySelectorAll('select');
    var elems = document.querySelectorAll('.modal');
    // var instances = M.Datepicker.init(elems, options);
});


// Or with jQuery
$(document).ready(function () {
    var currYear = (new Date()).getFullYear();
    $('.datepicker').datepicker();
    //Register form Date of birth field.
    $('.registerdatepicker').datepicker(
        {
            maxDate: new Date(currYear - 5, 12, 31),
            yearRange: [1950, currYear - 4]
        }
    );
    $('select').formSelect();
    $('.tabs').tabs();
});


