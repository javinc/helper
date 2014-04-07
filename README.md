php-helper
======

Symply Query helper for Lazy! 

/*
 * Updating
 *		$values = array('name' => 'James', 'email' => 'Bin');
 *		$where = array('id' => '2', 'name!' => '2');
 * 		update($values,$where, 'member')
 */

/*
 * Selecting
 *		$columns = array( 'name', 'email');
 *		$where = array( 'id' => '2' );
 * 		select($where, $columns, 'member'); or set_table('member');
 *		select($where); or select();
 */

/*
 * Inserting
 *		insert( array( 'name' => 'James', 'email' => 'Bin') ,'member')
 *		insert( array( NULL, 'James', 'Bin') ,'member')
 */

/*
 * Searching
 * 		search(array( 'id' => '2' ));
 */

/*
 * Deleting
 * 		delete(array( 'id!' => '2' ));
 */

Features:

	For setting JOINS, LIMIT, ORDER BY, TABLE just chain it :).
	Sample:
		delete(array( 'id' => '2' ))->table('user');
		// deletes id == 2 in table user
