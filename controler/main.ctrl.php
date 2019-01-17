<?php
include_once("view/main.view.class.php");

$main = new Main();

$main->getPage();

unset($main);