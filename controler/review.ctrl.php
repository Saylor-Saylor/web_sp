<?php
include_once("model/database.mod.class.php");
include_once("view/review.view.class.php");

$db = new MySQLConnector();
$review = new Review();

$id_user = @$_SESSION["user"]["id"];
$user_role = @$_SESSION["user"]["user_role_id"];
$action = @$_REQUEST['action'];


if($user_role && $user_role == 3 && !$action){
    $articleId = $_REQUEST['articleid'];
    $content = $db->getReview($articleId, $id_user);
    $review->getReview($content);
    var_dump($content);
} else if($user_role && $user_role == 3 && $action == "savereview"){
    $review_id = $_REQUEST['reviewId'];
    $theme = $_REQUEST['theme'];
    $tech = $_REQUEST['tech'];
    $lang = $_REQUEST['lang'];
    $recom = $_REQUEST['recom'];
    $comm = $_REQUEST['comm'];
    if($db->setReview($review_id, $theme, $tech, $lang,$recom, $comm)){
        $review->getAdded();
    } else {
        $review->getError();
    }

} else {
    header('Location: http://localhost/site/index.php?page=404');
}
