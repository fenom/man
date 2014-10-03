<?php
class controller
{
	function before()
	{
		
	}
	function index($page=null)
	{
		$page or!isset($_REQUEST["q"])or header("location:/{$_REQUEST["q"]}")or exit;
		$pages=preg_replace("/\.\d.*.gz/","",explode("\n",`ls -R1 /usr/share/man/|grep -e "\(.*\)\.*.*\.gz"`));
		sort($pages);
		return@array("data"=>array("man"=>shell_exec(escapeshellcmd(($_REQUEST["type"]=="info"?"info":"man")." $page")),"pages"=>array_unique($pages),"title"=>$_REQUEST["q"]));
	}
	function after()
	{
		
	}
}