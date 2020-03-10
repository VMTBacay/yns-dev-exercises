<?php
App::uses('AppController', 'Controller');
/**
 * PostLikes Controller
 */
class PostLikesController extends AppController
{

	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;

	/**
	 * This function is used to like the post
	 *
	 * @return void
	 */
	public function like()
	{
		$this->autoRender = false;
		$authenticated_user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$form_data = [
				'unique' => $this->request->data['post_id'] . "_" . $authenticated_user_id,
				'post_id' => $this->request->data['post_id'],
				'user_id' => $authenticated_user_id,
			];
			$this->PostLike->create($form_data);
			if ($this->PostLike->save($form_data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	/**
	 * This function is used to unlike the post
	 *
	 * @return void
	 */
	public function unlike()
	{
		$this->autoRender = false;
		$authenticated_user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			if ($this->checkIfAlreadyLike($this->request->data['post_id'], $authenticated_user_id)) {
				$this->PostLike->id = $this->PostLike->field('id', ['unique' => $this->request->data['post_id'] . "_" . $authenticated_user_id]);
				$this->PostLike->saveField('is_deleted', 1);
			} else {
				$this->PostLike->id = $this->PostLike->field('id', ['unique' => $this->request->data['post_id'] . "_" . $authenticated_user_id]);
				$this->PostLike->saveField('is_deleted', 0);
			}
			if ($this->PostLike->id) {
				echo true;
			} else {
				echo false;
			}
		}
	}

	/**
	 * This function is used to count the like in the post
	 *
	 * @return void
	 */
	public function countLike()
	{
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$like_data = [
				'data' => 0,
				'success' => false
			];
			$counted_like = $this->PostLike->find('count', [
				'conditions' => [
					['PostLike.post_id' => $this->request->data['post_id']],
					['PostLike.is_deleted' => 0]
				]
			]);
			echo $counted_like;
		}
	}
	/**
	 * This function identify if the user already send like to a post
	 *
	 * @param [type] $post_id
	 * @param [type] $user_id
	 * @return void
	 */
	public function checkIfAlreadyLike($post_id, $user_id)
	{
		$data = $this->PostLike->find('count', [
			'conditions' => [
				['PostLike.unique' => $post_id . '_' . $user_id],
				['PostLike.is_deleted' => 0]
			]
		]);
		return $data;
	}
}
