<?php //-->

require 'query.php';

// instantiate object
$q = new Query();

// build connection
$config = array(
	'db' => 'test',
	'user' => 'root',
	'pass' => 'root',
	'host' => 'localhost');
$link = $q->connect($config);

$q->setTable('user')->debug();

$setting = array(
	'user_name' => '%a%',
	'user_password' => '%k%',
	'user_type' => 100
);

$where = array(
	'user_id' => 1
);

$col = array(
	'user_name',
	'user_id'
);

$x = $q->search($setting);

echo '<pre>';
print_r($x);
