<?php

include_once("model/database.mod.class.php");
include_once("view/login.view.class.php");

$db = new MySQLConnector();
$logUser = new login();

$action = @$_REQUEST["action"];
$alert = true;

if($action == "login"){
    $login = $_REQUEST['username'];
    $pass = $_REQUEST['password'];
    if(!$db->checkAndLoginUser($login, $pass)){
        $alert = false;
    }else{
        @$_SESSION["user"]["user_role_id"];
        $logUser ->getInfoForUser();
    }

}

if($action == "logout"){
    unset($_SESSION["user"]);
}
if(!isset($_SESSION["user"])){
    $logUser->logIn($alert);
}

$db->close();
unset($db);
unset($logUser);