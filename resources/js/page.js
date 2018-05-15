function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image').attr('src', e.target.result);
            $('#image').removeClass('d-none');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function () {

    //add page
    $("#inputFile").change(function () {
        readURL(this);
    });

    $('#textEmail').change(function () {
        $('#emailText').html($(this).val());
    });

    $('#textUsername').change(function () {
        $('#userText').html($(this).val() + ' <<a id="emailText" href="https://gmail.com" class="text-dark font-weight-light">' + $('#textEmail').val() + '</a>>');
    });

    $('#textArea').change(function () {
        $('#taskBody').html($(this).val());
    });

    $('#view').click(function () {
        $('#view_block').toggleClass('d-none', 1000);
    });

    //admin page
    $('#sel1').change(function () {
        $('#submit_sel').click();
    });

    //index page
    $('#sel1').change(function () {
        $('#submit_sel').click();
    });
});