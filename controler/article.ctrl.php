<?php
include_once("model/database.mod.class.php");
include_once("view/article.view.class.php");

$db = new MySQLConnector();
$article = new Article();

$article_id = @$_REQUEST["articleid"];

if($article_id){
    $content = $db->getArticle($article_id);
    if($content != null){
        $article->getArticle($content);
    } else {
        header('Location: http://localhost/site/index.php?page=404');
    }

} else {
    header('Location: http://localhost/site/index.php?page=404');
}

