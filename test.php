<?php

require_once('Sql_helper.php');

$sql = new Sql_helper();

$sql->init_db('test');
$aResult = $sql->query('SELECT * from filter');

var_dump($aResult);