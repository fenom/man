<?php
class controller
{
	function before()
	{
		
	}
	function index()
	{
		$pages=preg_replace("/\.\d.*.gz/","",explode("\n",`ls -R1 /usr/share/man/|grep -e "\(.*\)\.*.*\.gz"`));
		sort($pages);
		return@array("data"=>array("man"=>shell_exec(escapeshellcmd(($_REQUEST["type"]=="info"?"info":"man")." {$_REQUEST["q"]}")),"pages"=>array_unique($pages)));
	}
	function after()
	{
		
	}
}