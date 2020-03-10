<?php
App::uses('PostCommentsController', 'Controller');

/**
 * PostCommentsController Test Case
 */
class PostCommentsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post_comment',
		'app.user',
		'app.post'
	);

}
