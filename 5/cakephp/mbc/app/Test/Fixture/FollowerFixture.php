<?php
/**
 * Follower Fixture
 */
class FollowerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id_from' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 45, 'unsigned' => false),
		'user_id_to' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 45, 'unsigned' => false),
		'accepted' => array('type' => 'string', 'null' => false, 'default' => 'false', 'length' => 5, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'is_deleted' => array('type' => 'string', 'null' => false, 'default' => 'false', 'length' => 5, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'user_id_from' => 1,
			'user_id_to' => 1,
			'accepted' => 'Lor',
			'is_deleted' => 'Lor',
			'updated_at' => 1569489680,
			'created_at' => 1569489680
		),
	);

}
