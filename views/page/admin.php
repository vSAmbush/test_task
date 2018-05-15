<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 04.05.2018
 * Time: 16:33
 */

use lib\App;

$pagination = $data['pagination'];
$tasks = $data['itemsPerPage'];
?>
<?php if(App::$user && App::$user->getId() == 1) : ?>
    <div class="site-admin">
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
            <form class="modal-content font-weight-normal" method="post">
                <div class="<?= ($tasks[$i]->status) ? 'bg-success text-white' : 'bg-light'; ?>">
                    <p class="float-left px-3 py-2 mb-0 font-weight-bold"><?= $tasks[$i]->username ?> <<a href="https://gmail.com" class="<?= ($tasks[$i]->status) ? 'text-white' : 'text-dark'; ?> font-weight-light"><?= $tasks[$i]->email ?></a>></p>
                    <label class="float-right mr-3 my-2">Is Done</label>
                    <input name="status" class="float-right mr-2 my-3 font-weight-normal" type="checkbox" <?= ($tasks[$i]->status) ? 'checked' : ''; ?>>
                </div>

                <div class="px-3 py-4">
                    <textarea name="task_body" class="col-lg-4 form-control"><?= $tasks[$i]->task_body ?></textarea>
                </div>

                <?php if($tasks[$i]->img_path) : ?>
                    <img class="img-size px-3 py-2" width="320" height="240" src="<?= $tasks[$i]->img_path ?>">
                <?php else : ?>
                    <p class="px-3 font-weight-light">No images</p>
                <?php endif; ?>

                <div class="my-2 text-danger ml-3"><?= $data['error'] ?></div>

                <div class="col-lg-3">
                    <button class="btn btn-primary my-2 mx-1" type="submit" name="<?= $tasks[$i]->id ?>" value="<?= $tasks[$i]->id ?>">Save</button>
                </div>
            </form><br>
        <?php endfor; ?>
    </div>
<?php else : ?>
    <h2 class="mt-4 text-center text-danger">YOU SHALL NOT PASS!</h2>
<?php endif; ?>