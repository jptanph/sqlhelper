	<?php

require_once('core/Sql_config.php');
require_once('core/Sql_drivers.php');


class Sql_helper extends Sql_drivers
{	
	public function __construct()
	{
		parent::__construct();
	}
				
	public function query( $sSql , $sRowType = NULL )	
	{
		$sQryInfo = $this->_get_query_type($sSql);
		if( $sQryInfo == 'SELECT' )
		{
			if( $sRowType == 'row' )
			{
				return $this->_singleFetch($sSql);
			}
			return $this->_fetchData($sSql);		
		}
		else
		{
			return $this->exec_query($sSql);
		}
	}
	
	public function init_db($sDbName)
	{
		if(!$this->db_name($sDbName))
		{
			$this->query_error();
			exit();
		}
	}
	
	private function _get_query_type($sSql)
	{
        preg_match("/^\s*(SELECT|UPDATE|DELETE|INSERT)[\s]/i", $sSql, $aInfo);
	   
	   if($aInfo)
	   {
			return trim( $aInfo [ 0 ] ) ;
	   }else
	   {
			return false;
	   }
	}
	
	private function _fetchData($sSql)
	{
		$aData = array();	
		$aResult = $this->exec_query($sSql);
		
		if($aResult)
		{
			while( $aRows = $this->fetch_array( $aResult ) )
			{
				$aData[] = $aRows;
			}
		}
		else
		{
			$aData = FALSE;
		}
		
		return $aData;
	}

	private function _singleFetch( $sSql )
	{
		$aData = array();
		$aResult = $this->exec_query($sSql);
		while ( $rows = $this->fetch_array($aResult))
		{
			$aData = $rows;
		}
		
		return $aData;
	}
}