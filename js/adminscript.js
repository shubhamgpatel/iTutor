(function ($) {
    $(function () {
        $(".dropdown-trigger").dropdown();
        $('.sidenav').sidenav();

    }); // end of document ready
})(jQuery); // end of jQuery name space


// Or with jQuery implementing summernote
$(document).ready(function () {
    $('.datepicker').datepicker();
    $('select').formSelect();
    $('.tabs').tabs();
    $('.summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['codeview', 'help']],
        ],
        spellCheck: true,
        height: 250,
        hintMode: 'word',
        hintSelect: 'after',
        hintDirection: 'bottom',
        styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
    });
});

/**-----learning room js */
$('.modal').modal();

$('#subject').change(function () {
    var id = $(this).val();
    $.ajax({
        type: "POST",
        data: {
            "id": id
        },
        url: "tutorAppointFetch.php",
        dataType: "html",
        async: false,
        success: function (response) {
            ///    var tutor_name = response;
            document.getElementById("show").innerHTML = response;
        }
    })
});
