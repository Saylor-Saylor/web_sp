<?php

class mainMenu{
     private $items = array(
        "main"=> "Main",
        "articles"=>"Articles",
        "login"=>"Log in",
        "registration"=>"Registration",
        "newarticle"=>"New article",
        "contacts"=>"Contacts",
        "account" => "Account"
    );

     function getName($page){
         $curr_page = "";
         foreach ($this->items as $key => $title){
             if($page == $key){
                 $curr_page = $title;
             }
         }
         return $curr_page;
     }

function getMenu()
{
    ?>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php?page=main">Conference</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php?page=main">Main</a></li>
                <li><a href="index.php?page=articles">Articles</a></li>


                <?php
                if (@$_SESSION["user"]["user_role_id"] == 2) {
                    ?>
                    <li class="active"><a href='index.php?page=newarticle'>New article</a></li>
                    <?php
                }
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (@$_SESSION["user"]["user_role_id"] == null || @$_SESSION["user"]["user_role_id"] == 0) {
                    ?>
                    <li class="active"><a href="index.php?page=registration"><span class="glyphicon glyphicon-user"></span>
                            Registration</a></li>
                    <li><a href="index.php?page=login"><span class="glyphicon glyphicon-log-in"></span> Log
                            in</a></li>
                    <?php
                }

                if (@$_SESSION["user"]["user_role_id"] == 1) {
                    ?>
                    <li class="active"><a href="index.php?page=admin"><span class="glyphicon glyphicon-user"></span>
                            Admin</a></li>
                    <li><a href="index.php?page=login&action=logout"><span class="glyphicon glyphicon-log-out"></span>
                            Log out</a></li>
                    <?php
                }

                if (@$_SESSION["user"]["user_role_id"] >= 2) {
                    ?>
                    <li class="active"><a href="index.php?page=account"><span class="glyphicon glyphicon-user"></span>
                            Account</a></li>
                    <li><a href="index.php?page=login&action=logout"><span class="glyphicon glyphicon-log-out"></span>
                            Log out</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>

    <?php
}
}
?>
