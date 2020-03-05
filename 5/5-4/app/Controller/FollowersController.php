<?php
class FollowersController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash', 'Space');
    public $components = array('Flash', 'Session', 'Paginator');

    const PAGE_LIMIT = 5;

    public function index() {
        $followIds = $this->Follower->find('all', array(
            'conditions' => array('follower_id' => $this->Session->read('User.id'), 'Follower.deleted' => 0),
            'fields' => 'user_id'
        ));
        $follows = array($this->Session->read('User.id'));
        foreach ($followIds as $followId) {
            array_push($follows, $followId['Follower']['user_id']);
        }
        $this->set('follows', $follows);

        $this->Paginator->settings = array(
            'conditions' => array('Follower.user_id' => $this->Session->read('User.id'), 'Follower.deleted' => 0),
            'limit' => self::PAGE_LIMIT
        );
       $this->set('followers', $this->Paginator->paginate('Follower'));
    }

    public function following() {
        $this->Paginator->settings = array(
            'conditions' => array('Follower.follower_id' => $this->Session->read('User.id'), 'Follower.deleted' => 0),
            'limit' => self::PAGE_LIMIT
        );
        $this->set('follows', $this->Paginator->paginate('Follower'));
    }

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
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to follow that user.'));
        }
        return $this->redirect($this->referer());
    }

    public function unFollow($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        $followId = $this->Follower->findByUserIdAndFollowerId($id, $this->Session->read('User.id'))['Follower']['id'];
        if (!$followId) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is(array('post'))) {

            if ($this->Follower->save(array('id' => $followId, 'deleted' => 1, 'deleted_date' => date("Y-m-d H:i:s")))) {
                $this->Flash->success(__('Successfully unfollowed.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to unfollow.'));
        }
        return $this->redirect($this->referer());
    }
}