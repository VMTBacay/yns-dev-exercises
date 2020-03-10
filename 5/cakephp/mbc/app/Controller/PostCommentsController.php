<?php
App::uses('AppController', 'Controller');
/**
 * PostComments Controller
 */
class PostCommentsController extends AppController
{

	/**
	 * Scaffold
	 *
	 * @var mixed
	 */
	public $scaffold;
	public $components = array('RequestHandler');
	/**
	 * This function is used to insert comment in the post
	 *
	 * @return void
	 */
	public function addComment()
	{
		$authenticated_user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$form_data = [
				'description' => $this->request->data['description'],
				'user_id' => $authenticated_user_id,
				'post_id' => $this->request->data['post_id']
			];
			$this->PostComment->create();
			if ($this->PostComment->save($form_data)) echo true;
			else echo false;
			$this->autoRender = false;
		}
	}
	/**
	 * This function is used to show comment in the post
	 *
	 * @return void
	 */
	public function showComment()
	{
		$data = $this->PostComment->find('all', [
			'conditions' => ['post_id' => $this->request->data['post_id']],
			'order' => ['PostComment.id' => 'desc']
		]);

		$this->autoRender = false;
		echo json_encode($data, true);
	}
	/**
	 * This function is used to count comment in a post
	 *
	 * @return void
	 */
	public function countComment()
	{
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$counted_comment = $this->PostComment->find('count', [
				'conditions' => [
					['PostComment.post_id' => $this->request->data['post_id']],
					['PostComment.is_deleted' => 0]
				]
			]);
			echo $counted_comment;
		}
	}
}
