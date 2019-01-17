<?php

session_start();

define("MAIN", "");
include("view/menu.view.class.php"); //menu
require_once("model/database.mod.class.php"); //database
require_once ("model/wrapper.mod.class.php"); //wrapper
require_once ("model/pages.mod.class.php"); //pages array
require_once ("twig/lib/Twig/Autoloader.php"); //twig

$curr_page = @$_REQUEST["page"];
$db = new MySQLConnector();

if($curr_page == ""){
    $curr_page = "main";
}

switch ($curr_page) {
    case "main": $file = $pages[0];
        break;
    case "articles": $file = $pages[1];
        break;
    case "login": $file = $pages[2];
        break;
    case "registration": $file = $pages[3];
        break;
    case "newarticle": $file =$pages[4];
        break;
    case "contacts": $file=$pages[5];
        break;
    case "account": $file=$pages[6];
        break;
    case "admin": $file=$pages[7];
        break;
    case "article": $file=$pages[9];
        break;
    case "review": $file=$pages[10];
        break;
    case "manage": $file=$pages[11];
        break;
    default:$file = $pages[8];//404
        break;

}

$wrapper = new wrapper();

$content = $wrapper ->getWrapper($file);

$menu = new mainMenu();
$getMenu = $menu->getMenu();
$getTitle = $menu->getName($curr_page);

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('main_page.html');

$tmpl_params = array();
$tmpl_params["menu"] = $getMenu;
$tmpl_params["body"] = $content;
$tmpl_params["title"] = $getTitle;

echo $template->render($tmpl_params);