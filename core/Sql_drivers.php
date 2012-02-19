<?php

class Sql_drivers
{
   public function __construct()
   {}
   
   protected function exec_query($sSql)
   {
		return mysql_query($sSql);
   }
   
   protected function fetch_array($aResult)
   {
		return mysql_fetch_array($aResult);   	
   }
   
   protected function num_rows($aResult)
   {
		return mysql_num_rows($aResult);
   }
   
   protected function query_error()
   {
		return die(mysql_error());
   } 
   
   protected function query_errorno()
   {
		return die(mysql_errorno());   	
   }
   
   protected function db_name($sDbName)
   {
	 return mysql_select_db($sDbName);
   }
}