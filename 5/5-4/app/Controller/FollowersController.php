<?php
class FollowersController extends AppController {
    public $components = array('Flash', 'Session', 'Paginator');

    public $uses = array('Follower', 'User');

    const PAGE_LIMIT = 5;

    public function index($id = null) {
        $id = $id === null ? $this->Session->read('user.id') : $id;
        $viewUser = $this->User->findByIdAndDeleted($id, 0);
        if (!array_key_exists('User', $viewUser)) {
             throw new NotFoundException(__('Invalid user'));
        }
        $this->set('viewUser', $viewUser['User']);

        $this->Paginator->settings = array(
            'conditions' => array('Follower.user_id' => $id, 'Follower.deleted' => 0),
            'limit' => self::PAGE_LIMIT
        );

        try {
            $this->set('followers', $this->Paginator->paginate('Follower'));
        } catch (Exception $e) {
            return $this->redirect(array_merge(
                array('action' => 'index'),
                array('page' => ceil(count($this->Follower->findAllByUserIdAndDeleted($id, 0)) / self::PAGE_LIMIT)))
            );
        }
    }

    public function following($id = null) {
        $id = $id === null ? $this->Session->read('user.id') : $id;
        $viewUser = $this->User->findByIdAndDeleted($id, 0);
        if (!array_key_exists('User', $viewUser)) {
             throw new NotFoundException(__('Invalid user'));
        }
        $this->set('viewUser', $viewUser['User']);

        $this->Paginator->settings = array(
            'conditions' => array('Follower.follower_id' => $id, 'Follower.deleted' => 0),
            'limit' => self::PAGE_LIMIT
        );

        try {
            $this->set('follows', $this->Paginator->paginate('Follower'));
        } catch (Exception $e) {
            return $this->redirect(array_merge(
                array('action' => 'index'),
                array('page' => ceil(count($this->Follower->findAllByFollowerIdAndDeleted($id, 0)) / self::PAGE_LIMIT)))
            );
        }
    }

    public function follow($id) {
        if ($this->request->is('post')) {
            $follow = $this->Follower->findByUserIdAndFollowerId($id, $this->Session->read('user.id'));
            if (!empty($follow)) {
                $this->Follower->id = $follow['Follower']['id'];
                $this->request->data['Follower']['modified'] = date("Y-m-d H:i:s");
                $this->request->data['Follower']['deleted'] = 0;
            } else {
                $this->Follower->create();
                $this->request->data['Follower']['user_id'] = $id;
                $this->request->data['Follower']['follower_id'] = $this->Session->read('user.id');
            }
            if ($this->Follower->save($this->request->data)) {
                $this->Flash->success(__('Successfully followed.'));

                $follows = $this->Session->read('user.follows');
                array_push($follows, $id);
                $this->Session->write('user.follows', $follows);
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

        $followId = $this->Follower->findByUserIdAndFollowerId($id, $this->Session->read('user.id'))['Follower']['id'];
        if (!$followId) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is(array('post'))) {

            if ($this->Follower->save(array('id' => $followId, 'deleted' => 1, 'deleted_date' => date("Y-m-d H:i:s")))) {
                $this->Flash->success(__('Successfully unfollowed.'));
                $follows = $this->Session->read('user.follows');
                unset($follows[array_search($id, $follows)]);
                $this->Session->write('user.follows', $follows);
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to unfollow.'));
        }
        return $this->redirect($this->referer());
    }
}