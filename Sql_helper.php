<?php

require_once('core/Sql_config.php');
require_once('core/Sql_drivers.php');


class Sql_helper extends Sql_drivers
{	
	public function __construct(){
		$conf = new Sql_config();
		parent::__construct();
	}
				
	public function query($sSql)	
	{
		return $this->exec_query($sSql);
	}
}