<?php

require_once('Sql_helper.php');

$sql = new Sql_helper();

$sql->init_db('test');
$aResult = $sql->query('SELECT * from filter');

$aData = array
(
	'f_data' => 'name1'
);

//$bResult = $sql->insert($aData,'filter1');
//$bResult1 = $sql->update($aData," f_data = 'test3' ",'filter');


// if($bResult1)
// {
	// echo'yes';
// }else{
	// echo'no';
// }
var_dump($aResult);