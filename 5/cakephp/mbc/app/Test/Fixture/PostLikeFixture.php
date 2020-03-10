<?php
/**
 * PostLike Fixture
 */
class PostLikeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'post_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 45, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 45, 'unsigned' => false),
		'is_deleted' => array('type' => 'string', 'null' => false, 'default' => 'false', 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'updated_at' => array('type' => 'timestamp', 'null' => false, 'default' => null),
		'created_at' => array('type' => 'timestamp', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'post_id' => 1,
			'user_id' => 1,
			'is_deleted' => 'Lorem ipsum dolor sit amet',
			'updated_at' => 1569460773,
			'created_at' => 1569460773
		),
	);

}
