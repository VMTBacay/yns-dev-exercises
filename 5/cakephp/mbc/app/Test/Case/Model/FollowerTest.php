<?php
App::uses('Follower', 'Model');

/**
 * Follower Test Case
 */
class FollowerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.follower'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Follower = ClassRegistry::init('Follower');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Follower);

		parent::tearDown();
	}

}
