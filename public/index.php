<?php
$_SERVER["PATH_INFO"]==strtok($_SERVER["PATH_INFO"],"ABCDEFGHIJKLMNOPQRSTUVWXYZ")or header("location:".strtolower($_SERVER["PATH_INFO"])."?".$_SERVER["REDIRECT_QUERY_STRING"])or exit;
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
$controller=strtok($_SERVER["PATH_INFO"],"/")?:"home";
$action=strtok("/")?:"index";
$return=call_user_func(array("controller_$controller","action_$action"));
$view=$return["view"]?:"$controller/$action";
$layout=$return["layout"]?:$controller;
ob_start();
foreach(scandir("../element")as$element)
	is_file("../element/$element")and(include"element/$element")and${strtok($element,".")}=ob_get_contents()and ob_clean();
include"view/$view.php";
$content=ob_get_clean();
include"layout/$layout.php";