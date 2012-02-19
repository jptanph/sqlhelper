<?php

require_once('Sql_helper.php');

$sql = new Sql_helper();

$sql->query('select * from test');