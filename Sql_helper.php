<?php
/**
 * Class : Sql_helper
 * Sql helper|Performs queries|Databse access|Model access
 **/
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
		$sQryInfo = $this->_get_query_type( $sSql );
		if( $sQryInfo == 'SELECT' )
		{
			$aIsOk = $this->exec_query( $sSql );
			
			if( $aIsOk )
			{
				if( $sRowType == 'row' )
				{
					return $this->_single_fetch( $sSql );
				}
				return $this->_fetch_data( $sSql );					
			}
			return FALSE;
		}
		else
		{
			return $this->exec_query( $sSql );
		}
	}
	
	public function init_db( $sDbName )
	{
		if( !$this->db_name( $sDbName ) )
		{
			$this->query_error();
			exit();
		}
	}
	
	private function _get_query_type( $sSql )
	{
        preg_match( "/^\s*(SELECT|UPDATE|DELETE|INSERT)[\s]/i" , $sSql , $aInfo );
	   
	   if( $aInfo )
	   {
			return trim( $aInfo [ 0 ] ) ;
	   }
	   else
	   {
			return FALSE;
	   }
	}
	
	private function _fetch_data( $sSql )
	{
		$aData = array();	
		$aResult = $this->exec_query( $sSql );
		
		if( $aResult )
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

	private function _single_fetch( $sSql )
	{
		$aData = array();
		$aResult = $this->exec_query( $sSql );
		while ( $rows = $this->fetch_array( $aResult ) )
		{
			$aData = $rows;
		}
		
		return $aData;
	}

	public function insert( $aData , $sTableName )
	{
		$sSql = "";
		$sSql .= " INSERT INTO $sTableName";
		$sField = "";
		$sValues = "";
		if( !$aData )
		{
			return FALSE;
		}
		else
		{
			$i = 0;
			foreach( $aData as $key => $val)
			{
				$sField .= ( ( $i == 0 ) ? '' : ',' ) . $key;
				$sValues .= ( ( $i == 0 )? '' : ',' ) . $this->_get_type( $val );
				$i++;
			}
			
			$sSql .= " ($sField)";
			$sSql .= " VALUES ($sValues)";
			
			$bResult = $this->exec_query( $sSql );			
			if( $bResult )
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
	
	public function update( $aData , $sWhere , $sTableName )
	{
		$sSql = "";
		$sField = "";
		$sSql .= "UPDATE $sTableName SET ";
		
		if( !$aData )
		{
			return FALSE;
		}
		else
		{	
			$i = 0;
			foreach( $aData as $key => $val )
			{
				$sSql .= ( ( $i == 0 ) ? '' : ',' ) . ' ' . $key . ' = ' . $this->_get_type( $val );				
				$i++;
			}
			$sSql .= " WHERE $sWhere ";
			
			$aResult = $this->exec_query( $sSql );
			if( $aResult )
			{
				return TRUE;
			}
			return FALSE;
		}
	}
	
	private function _get_type( $sValue )
	{
		$value = '';
		switch( gettype ( $sValue ) )
		{
			case'string':				
				$value = ( string ) "'{$sValue}'";				
			break;
			
			case 'integer':				
				$value = ( int ) $sValue;				
			break;
			
			case'double':
				$value = ( double ) $sValue;
			break;			
		}
		return $value;
	}
}