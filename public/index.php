<?php
$start=explode(" ",microtime());
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
$controller=isset($_SERVER["PATH_INFO"])?strtok($_SERVER["PATH_INFO"],"/"):"home";
$action=strtok("/")?:"index";
call_user_func("controller\\$controller::before");
$return=call_user_func("controller\\$controller::$action");
$content=isset($return["content"])?$return["content"]:"$controller/$action";
$layout=isset($return["layout"])?$return["layout"]:$controller;
$data=isset($return["data"])?$return["data"]:array();
ob_start();
foreach(scandir("../view/partial/$controller")as$partial)
	is_file("../view/partial/$controller/$partial")and(include"view/partial/$controller/$partial")and${strtok($partial,".")}=ob_get_contents()and ob_clean();
include"view/content/$content.php";
$content=ob_get_clean();
include"view/layout/".(is_file("../view/layout/$layout.php")?$layout:$controller).".php";
$stop=explode(" ",microtime());