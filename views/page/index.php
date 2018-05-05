<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.05.2018
 * Time: 15:21
 */
$pagination = $data['pagination'];
$tasks = $data['itemsPerPage'];
?>
<div class="site-index">
    <!-- Pagination -->
    <div class="pagination float-left mt-2">
        <?php foreach($pagination->buttons as $button) :
            if ($button->isActive) : ?>
                <a class="btn btn-primary btn-sm ml-1" href="?page=<?= $button->getPage()?>"><?= $button->getText()?></a>
            <?php else: ?>
                <span class="btn btn-sm btn-light ml-1 disabled"><?= $button->getText()?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Sort Bar -->
    <form class="form-group float-right" method="post">
        <label for="sel1" class="font-weight-light">Sort by </label>
        <select name="sort" id="sel1" class="form-control">
            <option value="">Select...</option>
            <option value="username">Username</option>
            <option value="email">Email</option>
            <option value="status">Status</option>
        </select>
        <input type="submit" class="d-none" id="submit_sel">
    </form>

    <!-- Tasks -->
    <?php for($i = 0; $i < count($tasks); $i++) : ?>
        <div class="modal-content font-weight-normal">
            <div class="<?= ($tasks[$i]->status) ? 'bg-success text-white' : 'bg-light'; ?>">
                <p class="float-left px-3 py-2 mb-0 font-weight-bold"><?= $tasks[$i]->username ?> <<a href="https://gmail.com" class="<?= ($tasks[$i]->status) ? 'text-white' : 'text-dark'; ?> font-weight-light"><?= $tasks[$i]->email ?></a>></p>
                <p class="float-right px-3 py-2 mb-0 font-weight-normal"><?= ($tasks[$i]->status) ? 'Completed' : 'Not done'; ?></p>
            </div>
            <div class="px-3 py-4">
                <?= $tasks[$i]->task_body ?>
            </div>
            <?php if($tasks[$i]->img_path) : ?>
                <img class="img-size px-3 py-2" width="320" height="240" src="<?= $tasks[$i]->img_path ?>">
            <?php else : ?>
                <p class="px-3 font-weight-light">No images</p>
            <?php endif; ?>
        </div><br>
    <?php endfor; ?>
</div>
<script type="text/javascript">
    $('#sel1').change(function () {
        $('#submit_sel').click();
    });
</script>