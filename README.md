php-helper
===============

Symply Query helper for Lazy! 

Searching

	search(array( 'id!' => '2' ));

Deleting

	delete(array( 'id' => '2' ));

Inserting

	insert( array( 'name' => 'James', 'email' => 'Bin') ,'member')
	insert( array( NULL, 'James', 'Bin') ,'member')
 
Updating

	$values = array('name' => 'James', 'email' => 'Bin');
	$where = array('id' => '2', 'name!' => '2');

	update($values, $where, 'member')

Selecting

	$columns = array( 'name', 'email');
	$where = array( 'id' => '2' );

	select($where, $columns, 'member'); 
		or 
	select($where)->setTable('member'); 
		or 
	select();

Instantiation

	$credentials = array(
		'host' => 'localhost',
		'user' => 'root',
		'pass' => ''
	);

	$user = Query($dbConnection, 'userTable');
		or
	$user = Query($credentials, 'userTable');

Features:

	For setting JOINS, LIMIT, ORDER BY, TABLE just chain it :).
	Sample:
		delete(array( 'id' => '2' ))->setTable('user');
		// deletes id == 2 in table user
