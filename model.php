<?php
class model extends PDO
{
	function __construct($dsn=dsn,$dsu=dsu,$dsp=dsp,$dso=dso)
	{
		parent::__construct($dsn,$dsu,$dsp,$dso);
	}
}