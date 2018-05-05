<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 05.05.2018
 * Time: 8:49
 */
?>
<div class="site-login">

    <h2 class="mt-5">Login</h2>

    <!-- Login Form -->
    <form class="form-group mt-2" method="post">

        <label class="my-2">Username</label>
        <input type="text" class="col-lg-4 form-control" name="username">

        <label class="my-2">Password</label>
        <input type="password" class="col-lg-4 form-control" name="password">

        <div class="text-danger mt-2"><?= $data['error'] ?></div>

        <input class="btn btn-primary mt-3" type="submit" value="Login" name="login_submit">
    </form>
</div>
