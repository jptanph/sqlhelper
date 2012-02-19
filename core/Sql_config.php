<?php

class Sql_config
{
    private $_sHost;
    private $_sUsername;
    private $_sPassword;
    private $_sDbName;
    private $_sPort;
    
    public function __construct()
    {
		$this->_db_connection();
    }
    
    private function _db_connection()
    {
		$this->_sHost = 'localhost';
		$this->_sUsername = 'root';
		$this->_sPassword = '';
		$this->_sDbName = 'test';
	
		$sConnection = mysql_connect($this->_sHost,$this->_sUsername,$this->_sPassword );
		if(!$sConnection)
		{
			die($this->_query_error());
			die($this->_query_errno());
			exit();
		}
    }
	    
    private function _query_error()
    {
		return mysql_error();
    }
    
    private function _query_errno()
    {
		return mysql_errorno();     
    }
}
$oConnection = new Sql_config();
