<?php
App::uses('Controller', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class AppController extends Controller
{
	public $components = array(
		'Email',
		'Flash',
		'Session',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'Users',
				'action' => 'register'
			),
			'logoutRedirect' => array(
				'controller' => 'Users',
				'action' => 'login'
			),
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'User',
					'passwordHasher' => 'Blowfish',
					'fields' => array(
						'username' => 'username',
						'password' => 'password'
					)
				)
			)
		)
	);

	public function isAuthorized($user)
	{
		return true;
		// if($this->Auth->user("username") == 'admin') {
		// 	return true;
		// }
		// // Default deny
		// else {
		// 	// return parent::isAuthorized($user);
		// 	$this->redirect($this->Auth->logout());
		// }

	}

	public function beforeFilter()
	{
		$this->Auth->allow('register', 'login');
	}
}
