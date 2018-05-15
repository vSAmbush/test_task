/**
 * Read uploaded file and import it to img tag
 *
 * @param input - Html file input
 */
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

/**
 * Add Task page jQuery handlers
 */
function addPageHandlers() {

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

}

/**
 * Admin page jQuery handlers
 */
function adminPageHandlers() {

    $('#sel1').change(function () {
        $('#submit_sel').click();
    });
}

/**
 * Index page jQuery handlers
 */
function indexPageHandlers() {

    $('#sel1').change(function () {
        $('#submit_sel').click();
    });
}

/**
 * jQuery main function
 */
$(document).ready(function () {

    addPageHandlers();

    adminPageHandlers();

    indexPageHandlers();
});