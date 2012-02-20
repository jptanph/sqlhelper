<?php

require_once('Sql_helper.php');

$sql = new Sql_helper();

$sql->init_db('test');
$aResult = $sql->query('SELECT * from filter','row');

$delete = $sql->query("DELETE FROM filter where f_data = 'test'");


var_dump($delete);
if($delete){
	echo'asd';
}else
{
	echo'no';
}

var_dump($aResult);