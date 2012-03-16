<?php
class model extends PDO
{
	function __construct($dsn=dsn,$dsu=dsu,$dsp=dsp,$dso=dso)
	{
		parent::__construct($dsn,$dsu,$dsp,$dso);
	}
	function quote($data,$paramtype=null)
	{
		if(is_scalar($data))
			return parent::quote($data);
		foreach($data as&$value)
			$value=parent::quote($value);
		return$data;
	}
}