<?php
App::uses('AppController', 'Controller');
/**
 * Followers Controller
 */
class FollowersController extends AppController
{

	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;
	public $components = ['RequestHandler'];

	public function index()
	{

	}


	/**
	 * This function is used to follow a user.
	 *
	 * @return void
	 */
	public function followUser()
	{
		$authenticated_user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$form_data = [
				'unique' => $authenticated_user_id . '_' . $this->request->data['user_id_to'],
				'user_id_from' => $authenticated_user_id,
				'user_id_to' => $this->request->data['user_id_to']
			];
			try {
				$this->Follower->create();
				if ($this->Follower->save($form_data)) $this->redirect(['action' => 'index']);
				else $this->Flash->error(__('Oops something went wrong!!'));
			} catch (Exception $e) {
				$unique = $authenticated_user_id . '_' . $this->request->data['user_id_to'];
				$this->Follower->updateAll(
					['is_deleted' => 0],
					['unique' => $unique]
				);
				$this->redirect(['action' => 'index']);
				$this->Flash->error(__('Oops something went wrong!!'));
			}
		}
	}
	/**
	 * 
	 * This function is used to unfollow a user.
	 * 
	 */
	public function unFollowUser()
	{
		$authenticated_user_id = $this->Auth->user('id');
		$unique = $authenticated_user_id . '_' . $this->request->data['user_id_to'];
		$this->Follower->updateAll(
			['is_deleted' => 1],
			['unique' => $unique]
		);
		$this->redirect(['action' => 'index']);
	}

	/**
	 * This function is used to check if the user is related to the authenticated user.
	 *
	 * @return void
	 */
	public function checkMyRelation($id = null)
	{
		$authenticated_user_id = $this->Auth->user('id');
		$status = 'false';
		if ($id == $authenticated_user_id) {
			$status = 'true';
		} else {
			$data_follower = $this->Follower->find('count', ['conditions' => [
				['AND' => ['user_id_to' => $authenticated_user_id, 'user_id_from' => $id, 'is_deleted' => 0]], // follower
			]]);
			$data_following = $this->Follower->find('count', ['conditions' => [
				['AND' => ['user_id_to' => $id, 'user_id_from' => $authenticated_user_id, 'is_deleted' => 0]]  // following
			]]);
			if ($data_follower != $data_following || ($data_follower == 1 && $data_following == 1)) {
				$status = 'true';
			}
		}
		$this->set('status', $status);
	}
}
