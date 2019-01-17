<?php

defined('MAIN') OR die('Neni mozne pouzit tuto stranku');


class MySQLConnector{
    public $connect;

    function __construct (){

        $dsn = 'mysql:host=localhost;dbname=konf';
        $user = 'root';
        $password = '';

        try {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
            $this->connect = new PDO($dsn,$user, $password);

            if(!isset($_SESSION)){
                session_start();
            }
        }catch(PDOException $ex){
            echo "Connection failed: " . $ex->getMessage();
            die();
        }
    }

    function setReviewer($articleId, $reviewer){
        $mysql_pdo_error = false;
        $query = 'INSERT INTO reviews (user_id, article_id)
            VALUES (:user_id, :article_id);';
        $sth = $this->connect->prepare($query);
        $sth->bindValue(':article_id', $articleId, PDO::PARAM_INT);
        $sth->bindValue(':user_id', $reviewer, PDO::PARAM_INT);
        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            //all is ok
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function setState($article_id, $state){
        $mysql_pdo_error = false;
        $query = 'UPDATE articles SET state=:state
                  WHERE articles.id = :article_id;';

        $sth = $this->connect->prepare($query);

        $sth->bindValue(':article_id', $article_id, PDO::PARAM_INT);
        $sth->bindValue(':state', $state, PDO::PARAM_INT);

        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            //all is ok
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function getReviewers(){
        $mysql_pdo_error = false;
        $query = "SELECT * FROM users WHERE user_role_id = 3;";
        $sth = $this->connect->prepare($query);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $all = $sth->fetchAll(PDO::FETCH_ASSOC);
            if(empty($all)){
                return null;
            }
            return $all;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function getArticlesForAdmin($article_id){
        $mysql_pdo_error = false;
        $query = "SELECT a.id as id, title, autors, state, r.id as review_id, origin, theme, tech, lang, recom, u.name 
                  FROM articles a 
                  Left Join reviews r On a.id = r.article_id 
                  Left Join users u On r.user_id = u.id
                  Where a.id = :article_id;";
        $sth = $this->connect->prepare($query);
        $sth->bindValue(':article_id', $article_id, PDO::PARAM_INT);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $all = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $all;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function setReview($review_id, $theme, $tech, $lang, $recom, $comm){
        $mysql_pdo_error = false;
        $query = 'UPDATE reviews SET theme=:theme, tech=:tech, lang=:lang, recom=:recom, comm=:comm
                  WHERE reviews.id = :review_id;';

        $sth = $this->connect->prepare($query);
        $sth->bindValue(':theme', $theme, PDO::PARAM_INT);
        $sth->bindValue(':tech', $tech, PDO::PARAM_INT);
        $sth->bindValue(':lang', $lang, PDO::PARAM_INT);
        $sth->bindValue(':recom', $recom, PDO::PARAM_INT);
        $sth->bindValue(':comm', $comm, PDO::PARAM_STR);
        $sth->bindValue(':review_id', $review_id, PDO::PARAM_INT);

        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            //all is ok
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function getReview($article_id, $user_id){
        $mysql_pdo_error = false;
        $query = "SELECT r.id, r.user_id, r.article_id, origin, theme, tech, lang, recom, comm, title 
              FROM reviews r JOIN articles a
              WHERE r.id = :article_id and r.user_id = :user_id;";
        $sth = $this->connect->prepare($query);
        $sth->bindValue(':article_id', $article_id, PDO::PARAM_INT);
        $sth->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $all = $sth->fetchAll(PDO::FETCH_ASSOC);
            if(empty($all)){
                return null;
            }
            return $all[0];
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function editArticle($articleId, $title, $autors, $abstract, $nameOfFile){
        $mysql_pdo_error = false;
        $query = 'UPDATE articles SET title=:title, autors=:autors, abstract=:abstract, file_name=:nameOfFile 
                  WHERE articles.id = :articleId;';

        $sth = $this->connect->prepare($query);
        $sth->bindValue(':title', $title, PDO::PARAM_STR);
        $sth->bindValue(':autors', $autors, PDO::PARAM_STR);
        $sth->bindValue(':abstract', $abstract, PDO::PARAM_STR);
        $sth->bindValue(':nameOfFile', $nameOfFile, PDO::PARAM_STR);
        $sth->bindValue(':articleId', $articleId, PDO::PARAM_INT);

        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            //all is ok
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function getArticle($article_id){
        $mysql_pdo_error = false;
        $query = "SELECT * FROM articles WHERE id = :article_id;";
        $sth = $this->connect->prepare($query);
        $sth->bindValue(':article_id', $article_id, PDO::PARAM_INT);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $all = $sth->fetchAll(PDO::FETCH_ASSOC);
            if(empty($all)){
                return null;
            }
            return $all[0];
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function getAllArticlesReview($id_user){
        $mysql_pdo_error = false;
        $query = "SELECT title, autors, r.id, r.user_id as review, a.user_id 
              FROM articles a Join reviews r ON a.id = r.article_id WHERE r.user_id = :user;";
        $sth = $this->connect->prepare($query);
        $sth->bindValue(':user', $id_user, PDO::PARAM_INT);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $all = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $all;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function getAllStatesArticles(){
        $mysql_pdo_error = false;
        $query = "SELECT * FROM articles Where state = 1;";
        $sth = $this->connect->prepare($query);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $all = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $all;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function getAllArticles(){
        $mysql_pdo_error = false;
        $query = "SELECT * FROM articles;";
        $sth = $this->connect->prepare($query);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $all = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $all;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }


    function addArticle($title, $autors, $user, $abstract, $nameOfFile){
        $mysql_pdo_error = false;
        $query = 'INSERT INTO articles (title, autors, abstract, file_name, user_id, state, date)
            VALUES (:title, :autors, :abstract, :file_name, :user_id, 0, :date);';
        $sth = $this->connect->prepare($query);
        $sth->bindValue(':title', $title, PDO::PARAM_STR);
        $sth->bindValue(':autors', $autors, PDO::PARAM_STR);
        $sth->bindValue(':abstract', $abstract, PDO::PARAM_STR);
        $sth->bindValue(':file_name', $nameOfFile, PDO::PARAM_STR);
        $sth->bindValue(':user_id', $user, PDO::PARAM_INT);
        $sth->bindValue(':date', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            //all is ok
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function addUser($login, $pass, $name, $email, $org){
        $mysql_pdo_error = false;
        $query = 'INSERT INTO users (login, pass, users.name, email, org, user_role_id)
            VALUES (:login, :pass, :name, :email, :org, 2)';
        $sth = $this->connect->prepare($query);
        $sth->bindValue(':login', $login, PDO::PARAM_STR);
        $sth->bindValue(':pass', $pass, PDO::PARAM_STR);
        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->bindValue(':email', $email, PDO::PARAM_STR);
        $sth->bindValue(':org', $org, PDO::PARAM_STR);
        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function isExistLogin($login){
        $mysql_pdo_error = false;
        $query = "SELECT login FROM users;";
        $sth = $this->connect->prepare($query);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $all = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($all as $curr_login){
                if($curr_login["login"] == $login){
                    return true;
                }
            }
            return false;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }



    function checkAndLoginUser($login, $pass){
        $help = $this->getAllUserInfo($login);
        if($help != null && $help["pass"] == $pass){
            $_SESSION["user"] = $this->getUserInfo($login);
            return true;
        }else{
            return false;
        }

    }

    function getAllUserInfo($login){
        $mysql_pdo_error = false;
        $query = "SELECT users.id, login, pass, users.name, email, org, user_role_id FROM users, user_role
     			  WHERE login = :login AND user_role.id = users.user_role_id;";
        $sth = $this->connect->prepare($query);
        $sth->bindValue(':login', $login, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $ourUser = $sth->fetchAll(PDO::FETCH_ASSOC);
            //http://php.net/manual/en/pdostatement.fetch.php
            if(empty($ourUser)){
                return null;
            }
            return $ourUser[0];
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function getUserInfo($login){
        $mysql_pdo_error = false;
        $query = "SELECT users.id, login, users.name, email, org, user_role_id FROM users, user_role
     			  WHERE login = :login AND user_role.id = users.user_role_id;";
        $sth = $this->connect->prepare($query);
        $sth->bindValue(':login', $login, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $ourUser = $sth->fetchAll(PDO::FETCH_ASSOC);
            //http://php.net/manual/en/pdostatement.fetch.php
            if(empty($ourUser)){
                return null;
            }
            return $ourUser[0];
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    function close() {
        $connect = null;
        unset($connect);
    }


}