<?php
require_once("model/database.mod.class.php");
include_once("view/admin.view.class.php");

$db = new MySQLConnector();
$articles = new Admin();

$id_user = @$_SESSION["user"]["id"];
$user_role = @$_SESSION["user"]["user_role_id"];

if($id_user && $user_role == 1){
    $users = $db->getAllUsers();
    $articles->getUserTable($users);

} else {
    header('Location: http://localhost/site/index.php?page=404');
}