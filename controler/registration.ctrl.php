<?php
include_once("model/database.mod.class.php");
include_once("view/registration.view.class.php");

$db = new MySQLConnector();
$registration = new Registration();

$action = @$_REQUEST["action"];
$alert = false;

if($action == "registration"){
    if($_REQUEST['password'] != $_REQUEST['repeat_password']){
        $alert = true;
    }else{
        $login = $_REQUEST['login'];

        if(!$db->isExistLogin($login)){
            $pass = $_REQUEST['password'];
            $name = $_REQUEST['username'];
            $email = $_REQUEST['email'];
            $org = $_REQUEST['org'];
            $db->addUser($login, $pass, $name, $email, $org);
            if($db->checkAndLoginUser($login, $pass)){
                $registration->setInfoForUser();
            }
        }else{
            ?>
            <div class="alert alert-danger">
                <strong>Bad login.</strong>
            </div>
            <?php
        }
    }
}

if(!isset($_SESSION["user"])){
    $registration->registration($alert);
}

$db->close();
unset($db);
unset($registration);