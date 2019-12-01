<h1 class="h3 mb-3 font-weight-normal">Register Page</h1>
<form method="POST" action="app/process_register.php" class="form-signin">
    <!-- USERNAME -->
    <div class="form-group">
        <label for="my-input" class="sr-only">Text</label>
        <input id="my-input" name="un" class="form-control" type="text"  placeholder="User Name"  autofocus>
    </div>
    <!-- EMAIL -->
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="e" id="inputEmail" class="form-control" placeholder="Email address"  >
    </div>

    <!-- PASSWORD -->
    <div class="form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="p" id="inputPassword" class="form-control" placeholder="Password" >
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <!-- Already a member -->
    <p>Already a member ? <a href="<?php echo URL_ROOT; ?>?page=register">Register</a></p>
</form>
