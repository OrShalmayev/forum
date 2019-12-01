<?php
    if(isset($_SESSION['error_msg']) && !empty($_SESSION['error_msg'])):
?>

    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error_msg']; ?>
    </div>

<?php 
    $_SESSION['error_msg'] = null;
    endif; 
?>
<?php
    if(isset($_SESSION['success_msg']) && !empty($_SESSION['success_msg'])):
?>

    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success_msg']; ?>
    </div>

<?php 
    $_SESSION['success_msg'] = null;
    endif; 
?>