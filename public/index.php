<?php
$_SERVER["REQUEST_URI"]==strtok($_SERVER["REQUEST_URI"],"ABCDEFGHIJKLMNOPQRSTUVWXYZ")or header("location:".strtolower($_SERVER["REQUEST_URI"]));
session_start();
date_default_timezone_set("UTC");
set_include_path("..".PATH_SEPARATOR.get_include_path());
function __autoload($class)
{
	require_once str_replace("_","/",$class).".php";
}
$controller=strtok($_SERVER["REQUEST_URI"],"/")?:"home";
$action=strtok("/")?:"index";
call_user_func(array("controller_$controller","action_$action"));
$head=file_get_contents("../view/head.php");
$header=file_get_contents("../view/header.php");
$content=file_get_contents("../view/$controller/$action.php");
$footer=file_get_contents("../view/footer.php");
include"view/layout.php";