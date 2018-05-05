<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.05.2018
 * Time: 15:23
 */
?>
<div class="site-add-task">

    <h2 class="mt-5">Add your task</h2>

    <!-- Form Add Task -->
    <form class="form-group mt-2" method="post" enctype="multipart/form-data">

        <div class="row justify-content-between">
            <div class="col-5">
                <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="102400000" />

                <label class="my-2">Username</label>
                <input id="textUsername" type="text" class="form-control" name="username">

                <label class="my-2">Email</label>
                <input id="textEmail" type="text" class="form-control" name="email">
            </div>

            <div class="col-6">
                <label class="my-2">Task body</label>
                <textarea id="textArea" type="text" class="form-control" name="task_body"></textarea>

                <label class="my-2">Upload image (optional)</label>
                <input id="inputFile" type="file" class=" form-control" name="img_path" accept="image/*">
            </div>
        </div>

        <div class="mt-2">
            <div class="text-danger"><?= $data['error'] ?></div>
            <input type="submit" class="btn btn-primary mt-3" value="Save" name="add_submit">
            <input type="button" class="btn btn-success mt-3" value="View" id="view">
        </div>

        <div id="view_block" class="mt-2 d-none">
            <div class="modal-content font-weight-normal">
                <div class="bg-light">
                    <p id="userText" class="float-left px-3 py-2 mb-0 font-weight-bold">Username <<a id="emailText" href="https://gmail.com" class="text-dark font-weight-light">email@email.com</a>></p>
                    <p class="float-right px-3 py-2 mb-0 font-weight-normal">Not done</p>
                </div>
                <div id="taskBody" class="px-3 py-4">
                    TEST
                </div>

                <img id="image" class="d-none img-size px-3 py-2" width="320" height="240" src="">
            </div><br>
        </div>
    </form>

</div>
<script type="text/javascript">

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
</script>
