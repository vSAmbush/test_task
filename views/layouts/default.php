<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 02.05.2018
 * Time: 15:27
 */
use \lib\App;
use \lib\Config;
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="../favicon.png" type="image/png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <title><?= Config::get('site_name')?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary" data-toggle="affix">
            <div class="mx-auto d-sm-flex d-block flex-sm-nowrap">
                <a class="navbar-brand" href="/test_task/page/index">TASKS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse text-center" id="navbarsExample11">
                    <ul class="navbar-nav">
                        <?php if(App::$user && App::$user->getId() == 1) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/test_task/page/admin">Admin</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/test_task/page/add">Add Task</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/test_task/page/register">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <?php if(!App::$user): ?>
                                <a class="nav-link" href="/test_task/page/login">Login</a>
                            <?php else: ?>
                                <a class="nav-link" href="?action=out">Logout (<?= App::$user->getUsername() ?>)</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navigation -->

        <!-- Body -->
        <div class="container mt-2 mb-5">
            <?= $data['content'] ?>
        </div>

        <!-- Footer -->
        <footer class="card-footer fixed-bottom text-sm-center">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-4">&copy; Copyright 2018</div>
                    <div class="col-4">Vladimir Ryashentsev</div>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="../resources/js/page.js"></script>
    </body>
</html>
