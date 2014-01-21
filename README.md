php-helper
======

Query helper and more! 

/*
 * ex.
 *		$values = array('name' => 'James', 'email' => 'Bin');
 *		$where = array('id' => '2', 'name!' => '2');
 * 		update($values,$where, 'member')
 */

/*
 * ex.
 *		$columns = array( 'name', 'email');
 *		$where = array( 'id' => '2' );
 * 		select($where, $columns, 'member'); or set_table('member');
 *		select($where); or select();
 */

/*
 * ex.
 *		insert( array( 'name' => 'James', 'email' => 'Bin') ,'member')
 *		insert( array( NULL, 'James', 'Bin') ,'member')
 */

/*
 * ex.
 * 		search(array( 'id' => '2' ));
 */

	/*
 * ex.
 * 		delete(array( 'id!' => '2' ));
 */