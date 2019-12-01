<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
<form method="POST" action="app/process_login.php" class="form-signin">
    <!-- EMAIL -->
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="e" id="inputEmail" class="form-control" placeholder="Email address"  required autofocus>
    </div>

    <!-- PASSWORD -->
    <div class="form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="p" id="inputPassword" class="form-control" placeholder="Password" required>
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <!-- Already a member -->
    <p>Already a member ? <a href="<?php echo URL_ROOT; ?>?page=register">Register</a></p>
</form>
