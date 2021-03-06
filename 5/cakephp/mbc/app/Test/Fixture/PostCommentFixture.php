<?php
/**
 * PostComment Fixture
 */
class PostCommentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 45, 'unsigned' => false),
		'post_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 45, 'unsigned' => false),
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
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'user_id' => 1,
			'post_id' => 1,
			'is_deleted' => 'Lor',
			'updated_at' => 1569320164,
			'created_at' => 1569320164
		),
	);

}
