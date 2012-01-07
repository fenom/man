<?php
$_SERVER["REQUEST_URI"]==strtok($_SERVER["REQUEST_URI"],"ABCDEFGHIJKLMNOPQRSTUVWXYZ")or header("location:".strtolower($_SERVER["REQUEST_URI"]));
session_start();
date_default_timezone_set("UTC");
foreach(scandir("../controller")as$controller)
	is_file("../controller/$controller")and require_once"../controller/$controller";
foreach(scandir("../model")as$model)
	is_file("../model/$model")and require_once"../model/$model";
$controller="controller_".(strtok($_SERVER["REQUEST_URI"],"/")?:"home");
$action="action_".(strtok("/")?:"index");
$controller::$action();