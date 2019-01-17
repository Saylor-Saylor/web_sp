<?php
class login{
    function __construct(){
        @session_start();
    }

    function getInfoForUser(){
        if($_SESSION["user"]["user_role_id"] !=  1){
            ?>
            <div class="">
                <h1>Hello <?php echo $_SESSION["user"]["name"]?>!</h1>
                <p>You can create new articles on this site now</p>
            </div>

            <?php
        }else{
            ?>
            <div class="">
                <h1>Hello Administrator!</h1>
            </div>

            <?php
        }
    }

    function logIn($alert){
        ?>

        <div class="login-form">
            <?php
            if(!$alert){
                ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Bad password or login. Please try again</strong>
                </div>
                <?php
            }
            ?>
            <form action="" method="post">
                <h2 class="text-center">Log in</h2>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="login">Log in</button>
                </div>
                <input type="hidden" name="action" value="login">
            </form>
            <p class="text-center"><a href="index.php?page=registration">Registration</a></p>

        </div>
        <?php
    }


}
?>

