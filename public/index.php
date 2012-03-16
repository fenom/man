<?php
isset($_SERVER["PATH_INFO"])and$_SERVER["PATH_INFO"]=="/favicon.ico"and exit;
!isset($_SERVER["PATH_INFO"])or$_SERVER["PATH_INFO"]==strtok($_SERVER["PATH_INFO"],"ABCDEFGHIJKLMNOPQRSTUVWXYZ")or header("location:".strtolower($_SERVER["PATH_INFO"]).($_SERVER["REDIRECT_QUERY_STRING"]?"?".$_SERVER["REDIRECT_QUERY_STRING"]:""))or exit;
session_start();
date_default_timezone_set("UTC");
set_include_path("..".PATH_SEPARATOR.get_include_path());
const dsn="mysql:";
const dsu=null;
const dsp=null;
const dso=null;
function __autoload($class)
{
	require_once str_replace("\\","/",$class).".php";
}
$model=new model();
$controller=isset($_SERVER["PATH_INFO"])&&strtok($_SERVER["PATH_INFO"],"/")?:"home";
$action=strtok("/")?:"index";
call_user_func("controller\\$controller::before");
$return=call_user_func("controller\\$controller::$action");
$view=$return["view"]?:"$controller/$action";
$layout=$return["layout"]?:$controller;
$data=$return["data"];
ob_start();
foreach(scandir("../element")as$element)
	is_file("../element/$element")and(include"element/$element")and${strtok($element,".")}=ob_get_contents()and ob_clean();
include"view/$view.php";
$content=ob_get_clean();
include"layout/".(is_file("../layout/$layout.php")?$layout:"home").".php";