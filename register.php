<h1 class="h3 mb-3 font-weight-normal">Register Page</h1>
<form method="POST" action="app/process_register.php" class="form-signup">
    <!-- USERNAME -->
    <div class="form-group">
        <label for="id_u" class="sr-only">User name</label>
        <input 
        pattern="[a-zA-Z][a-zA-Z0-9]{3,}"
        required
        id="id_u" name="un" class="form-control" type="text"  placeholder="User Name"   autofocus>
        <span class="username-msg"></span>
    </div>
    <!-- EMAIL -->
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="e" id="inputEmail" class="form-control" placeholder="Email address" required  >
    </div>

    <!-- PASSWORD -->
    <div class="form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="p" id="inputPassword" class="form-control" placeholder="Password" required >
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <!-- Already a member -->
    <p>Already a member ? <a href="<?php echo URL_ROOT; ?>?page=login">Login</a></p>
</form>

<script>
    (function(){
        const f = $('.form-signup');
        const u = $('#id_u');

        // litening for focusout in username input.
        u.on('input',(even)=>{
            // check if the event is not trusted if so redirect to home page
            if(even.originalEvent.type !== 'input') window.location.reload();
            let v = even.target.value;
            console.log(even)
            // send ajax request to the server to check if the username is already exists.
            $.ajax({
                url: f.attr('action'),
                type: 'POST',
                data:{
                    u: v,
                    action: 'check_username'
                },
                success: function(res){
                    // console.log(res);
                    if(res.trim()==='error'){
                        $('.username-msg').html(res.trim());
                    }else if(res.trim().split(' ')[0]==='Username'){
                        $('.username-msg').html(res.trim());
                    }
                }
            });//end ajax

        });
    })();
</script>