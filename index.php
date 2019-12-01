<?php 
require(dirname(__FILE__) . '/app/Database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo WEB_NAME; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/64af342e22.js" crossorigin="anonymous"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?php echo URL_ROOT; ?>/css/cover.css" rel="stylesheet">
</head>

<body>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand"><?php echo WEB_NAME; ?></h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link <?php echo $_GET['page'] ? '' : 'active' ?>" href="<?php echo URL_ROOT; ?>">Home</a>
                    <a class="nav-link <?php echo $_GET['page'] ? $_GET['page']=='login' ? 'active' : '' : '' ?>" href="<?php echo URL_ROOT; ?>?page=login">Login</a>
                </nav>
            </div>
        </header>
        <!-- Messages -->
        <?php include(APP_ROOT.'/messages.php'); ?>
        <main role="main" class="inner cover">
            <!-- Every file rendered here -->
            <?php 
            /*********| NEEDS REFACTOR |*********/
            ?>
            <?php  if(empty($_GET)) {

                // if no parameters given in the urk then include the home.php file
                include(APP_ROOT.'/home.php');
            }else if(isset($_GET['page']) && !empty($_GET['page'])){
                // if 'page' parameter given
                if(file_exists(APP_ROOT.'/'.$_GET['page'].'.php')){
                    // if the value in the page parameter exists in the public files include the file
                    include(APP_ROOT.'/'.$_GET['page'].'.php');
                }else{
                    // the value in the page paramter doesnt exists then redirect to home page.
                    header("Location:".URL_ROOT);
                }
            } ?>
            <?php 
            /*********| END; NEEDS REFACTOR |*********/
            ?>

        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>
                    by 
                    <a href="#">
                        @<?php echo WEB_CREATOR; ?>
                    </a> 
                    <?php echo CURRENT_YEAR; ?>
                    . 
                </p>
            </div>
        </footer>
    </div>
</body>

</html>