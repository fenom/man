<?php
$_SERVER["REQUEST_URI"]==strtok($_SERVER["REQUEST_URI"],"ABCDEFGHIJKLMNOPQRSTUVWXYZ")or header("location:".strtolower($_SERVER["REQUEST_URI"]))or exit;
session_start();
date_default_timezone_set("UTC");
set_include_path("..".PATH_SEPARATOR.get_include_path());
const dsn="mysql:";
const dsu=null;
const dsp=null;
const dso=null;
function __autoload($class)
{
	require_once str_replace("_","/",$class).".php";
}
$controller=strtok($_SERVER["REQUEST_URI"],"/")?:"home";
$action=strtok("/")?:"index";
call_user_func(array("controller_$controller","action_$action"));
ob_start();
foreach(scandir("../view")as$view)
	is_file("../view/$view")and(include"view/$view")and${strtok($view,".")}=ob_get_contents()and ob_clean();
include"view/$controller/$action.php";
$content=ob_get_clean();
include"index.php";