<?php
include_once("model/database.mod.class.php");
include_once("view/manage.view.class.php");

$db = new MySQLConnector();
$manage = new Manage();

$action = @$_REQUEST["action"];
$id_user = @$_SESSION["user"]["id"];
$articleId= @$_REQUEST["articleid"];
$user_role = @$_SESSION["user"]["user_role_id"];

if($user_role && $user_role == 1 && !$action){
    $article = $db->getArticlesForAdmin($articleId);
    $reviewers = $db->getReviewers();
    $manage->getContent($article, $reviewers);
} else if ($action == "savemanage") {
    $state = $_REQUEST["state"];
    $db->setState($articleId, $state);
    //$reviewer1 = $_REQUEST["reviwer1"];
    var_dump($_REQUEST);
    if(isset($_REQUEST["reviwer1"]) && $_REQUEST["reviwer1"] != "None"){

        $db->setReviewer($articleId, $_REQUEST["reviwer1"]);
    }
    if(isset($_REQUEST["reviwer2"]) && $_REQUEST["reviwer2"] != "None"){

        $db->setReviewer($articleId, $_REQUEST["reviwer2"]);
    }
    if(isset($_REQUEST["reviwer3"]) && $_REQUEST["reviwer3"] != "None"){

        $db->setReviewer($articleId, $_REQUEST["reviwer3"]);
    }


}else {
    header('Location: http://localhost/site/index.php?page=404');
}


$db->close();
unset($db);
unset($manage);