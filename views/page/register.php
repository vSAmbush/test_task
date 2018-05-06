<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 05.05.2018
 * Time: 8:49
 */
?>
<div class="site-register">

    <h2 class="mt-5">Sign Up</h2>

    <!-- Sign Up Form -->
    <form class="form-group mt-2" method="post">

        <label class="my-2">Username</label>
        <input type="text" class="col-lg-4 form-control" name="username" autofocus>

        <label class="my-2">Email</label>
        <input type="text" class="col-lg-4 form-control" name="email" autofocus>

        <label class="my-2">Password</label>
        <input type="password" class="col-lg-4 form-control" name="password">

        <label class="my-2">Repeat password</label>
        <input type="password" class="col-lg-4 form-control" name="repeat_password" autofocus>

        <div class="text-danger mt-2"><?= $data['error'] ?></div>

        <input class="btn btn-primary mt-3" type="submit" value="Sign Up" name="register_submit">
    </form>
</div>