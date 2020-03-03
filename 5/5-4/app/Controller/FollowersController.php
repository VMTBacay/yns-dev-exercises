<?php
class FollowersController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash', 'Space');
    public $components = array('Flash', 'Session');

    public $uses = array('Follower', 'User');

    public function follow($id) {
        if ($this->request->is('post')) {
            $follow = $this->Follower->findByUserIdAndFollowerId($id, $this->Session->read('User.id'));
            if (!empty($follow)) {
                $this->Follower->id = $follow['Follower']['id'];
                $this->request->data['Follower']['modified'] = date("Y-m-d H:i:s");
                $this->request->data['Follower']['deleted'] = 0;
            } else {
                $this->Follower->create();
                $this->request->data['Follower']['user_id'] = $id;
                $this->request->data['Follower']['follower_id'] = $this->Session->read('User.id');
            }
            if ($this->Follower->save($this->request->data)) {
                $this->Flash->success(__('Successfully followed.'));
                return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
            $this->Flash->error(__('Unable to follow that user.'));
            return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        }
    }
}