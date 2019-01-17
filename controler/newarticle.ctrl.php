<?php
include_once("model/database.mod.class.php");
include_once("view/newarticle.view.class.php");

$db = new MySQLConnector();
$newArticle = new newArticle();

$action = @$_REQUEST["action"];
$id_user = @$_SESSION["user"]["id"];
$articleId= @$_REQUEST["articleid"];

if($id_user){
    if($action == "addarticle"){
        $user = @$_SESSION["user"]["id"];;
        $title = $_REQUEST['title'];
        $autors = $_REQUEST['autors'];
        $abstract = $_REQUEST['abstract'];

        $nameOfFile= null;
        $fileExist = true;

        $targ_dir = "uploads/";

        if(!empty($_FILES["file"])){
            $file = $_FILES["file"];
            if($file["error"]!== UPLOAD_ERR_OK){
                $fileExist = false;
            }
            $targ_file = $targ_dir.basename($_FILES["file"]["name"]);
            if($_FILES["file"]["type"] != "application/pdf"){
                echo "Sorry, only PDF files are allowed.";
                $fileExist = false;
            }
        }else{
            $fileExist = false;
        }


        if($fileExist){
            $nameOfFile = preg_replace("/[^A-Z0-9._-]/i", "_", $file["name"]);
            // don't overwrite an existing file
            $i = 0;
            $parts = pathinfo($nameOfFile);
            while (file_exists($targ_dir.$nameOfFile)) {
                $i++;
                $nameOfFile = $parts["filename"] . "-" . $i . "." . $parts["extension"];
            }
            // preserve file from temporary directory
            $success = move_uploaded_file($file["tmp_name"],
                $targ_dir.$nameOfFile);
            if (!$success) {
                echo "<p>Unable to save file.</p>";
                exit;
            }
            // set proper permissions on the new file
            chmod($targ_dir . $nameOfFile, 0644);
        }
        if($db->addArticle($title, $autors, $user, $abstract, $nameOfFile)){
            $newArticle->getAdded();
        }else{
            $newArticle->getError();
        }
    } else if($action == "edit"){
        $curr_article = $db->getArticle($articleId);
        if($curr_article != null && $curr_article["user_id"] == $id_user){
            $newArticle->getEditArticleForm($curr_article);
        } else {
            header('Location: http://localhost/site/index.php?page=404');
        }

    } else if($action == "savearticle"){
        $user = @$_SESSION["user"]["id"];
        $title = $_REQUEST['title'];
        $autors = $_REQUEST['autors'];
        $abstract = $_REQUEST['abstract'];
        $articleId = $_REQUEST['articleId'];

        $nameOfFile= null;
        $fileExist = true;

        $targ_dir = "uploads/";

        if(!empty($_FILES["file"])){
            $file = $_FILES["file"];
            if($file["error"]!== UPLOAD_ERR_OK){
                $fileExist = false;
            }
            $targ_file = $targ_dir.basename($_FILES["file"]["name"]);
            if($_FILES["file"]["type"] != "application/pdf"){
                $fileExist = false;
            }
        }else{
            $fileExist = false;
        }


        if($fileExist){
            $nameOfFile = preg_replace("/[^A-Z0-9._-]/i", "_", $file["name"]);
            // don't overwrite an existing file
            $i = 0;
            $parts = pathinfo($nameOfFile);
            while (file_exists($targ_dir.$nameOfFile)) {
                $i++;
                $nameOfFile = $parts["filename"] . "-" . $i . "." . $parts["extension"];
            }
            // preserve file from temporary directory
            $success = move_uploaded_file($file["tmp_name"],
                $targ_dir.$nameOfFile);
            if (!$success) {
                echo "<p>Unable to save file.</p>";
                exit;
            }
            // set proper permissions on the new file
            chmod($targ_dir . $nameOfFile, 0644);
        }

        if(!$fileExist){
            $nameOfFile = $_REQUEST['old_file'];;
        }

        if($db->editArticle($articleId, $title, $autors, $abstract, $nameOfFile)){
            $newArticle->getEdited();
        }else{
            $newArticle->getError();
        }
    }else if(@$_SESSION["user"]["id"] == 2){
        $newArticle->getArticleForm();
    } else {
        header('Location: http://localhost/site/index.php?page=404');
    }
} else {
    header('Location: http://localhost/site/index.php?page=404');
}

$db->close();
unset($db);
unset($newArticle);