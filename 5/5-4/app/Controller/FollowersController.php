<?php
class FollowersController extends AppController {
    public $components = array('Flash', 'Session', 'Paginator');

    const PAGE_LIMIT = 5;

    public function index() {
        $this->Paginator->settings = array(
            'conditions' => array('Follower.user_id' => $this->Session->read('User.id'), 'Follower.deleted' => 0),
            'limit' => self::PAGE_LIMIT
        );

        try {
            $this->set('followers', $this->Paginator->paginate('Follower'));
        } catch (Exception $e) {
            return $this->redirect(array_merge(
                array('action' => 'index'),
                array('page' => ceil(count($this->Follower->findAllByUserIdAndDeleted($this->Session->read('User.id'), 0)) / self::PAGE_LIMIT
            ))));
        }
    }

    public function following() {
        $this->Paginator->settings = array(
            'conditions' => array('Follower.follower_id' => $this->Session->read('User.id'), 'Follower.deleted' => 0),
            'limit' => self::PAGE_LIMIT
        );

        try {
            $this->set('follows', $this->Paginator->paginate('Follower'));
        } catch (Exception $e) {
            return $this->redirect(array_merge(
                array('action' => 'index'),
                array('page' => ceil(count($this->Follower->findAllByFollowerIdAndDeleted($this->Session->read('User.id'), 0)) / self::PAGE_LIMIT
            ))));
        }
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

                $follows = $this->Session->read('User.follows');
                array_push($follows, $id);
                $this->Session->write('User.follows', $follows);
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
                $follows = $this->Session->read('User.follows');
                unset($follows[array_search($id, $follows)]);
                $this->Session->write('User.follows', $follows);
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to unfollow.'));
        }
        return $this->redirect($this->referer());
    }
}