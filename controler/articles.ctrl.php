<?php
require_once("model/database.mod.class.php");
include_once("view/articles.view.class.php");

$db = new MySQLConnector();
$articles = new Articles();

$action = @$_REQUEST["action"];
$id_user = @$_SESSION["user"]["id"];
$user_role = @$_SESSION["user"]["user_role_id"];
$user_flag = 0;


if($id_user){
    $user_flag = $user_role;
    if($user_flag == 3){
        $articlesarr = $db->getAllArticlesReview($id_user);
    } else if($user_flag == 1){
        $articlesarr = $db->getAllArticles();
    } else {
        $articlesarr = $db->getAllStatesArticles();
    }
} else if(!$id_user){
    $articlesarr = $db->getAllStatesArticles();
}

$articles->getAllArticles($articlesarr, $user_flag, $id_user);


$db->close();
unset($db);
unset($articles);