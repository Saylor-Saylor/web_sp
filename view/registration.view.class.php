<?php
class Registration{
    function __construct(){
        @session_start();
    }

    function setInfoForUser(){
        ?>
        <div class="">
            <h1>Hello <?php echo $_SESSION["user"]["name"]?>!</h1>
            <p>You are new user and you can create new articles on this site now</p>
        </div>
        <?php
    }
    function registration($alert){
        ?>

        <div class="login-form">
            <?php
            if($alert){
                ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Password incorrectly repeated. Please try again</strong>
                </div>
                <?php
            }
            ?>
            <form action="" method="post">
                <h2 class="text-center">Registration</h2>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="login" placeholder="Login" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="repeat_password" placeholder="Repeat password" required="required">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="E-mail" required="required">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="org" placeholder="Organisation" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="sign_up">Sign up</button>
                </div>
                <input type="hidden" name="action" value="registration">
            </form>
            <p class="text-center"><a href="index.php?page=login">Log in</a></p>

        </div>
        <?php
    }


}
?>

