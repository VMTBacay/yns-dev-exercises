<?php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash', 'Space');
    public $components = array('Flash', 'Session');

    public $uses = array('Post', 'Repost', 'Like');

    public function index() {
        $this->set('reposts', $this->Repost->findAllByUserIdAndDeleted($this->Session->read('User.id'), 0));
        $this->set('posts', $this->Post->findAllByUserIdAndDeleted($this->Session->read('User.id'), 0));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            $this->request->data['Post']['user_id'] = $this->Session->read('User.id');
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            $this->request->data['Post']['modified'] = date("Y-m-d H:i:s");
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post'))) {
            if ($this->Post->save(array('id' => $id, 'deleted' => 1, 'deleted_date' => date("Y-m-d H:i:s")))) {
                $this->Flash->success(__('Your post has been deleted.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to delete your post.'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function repost($id) {
        if ($this->request->is('post')) {
            $repost = $this->Repost->findAllByUserIdAndPostId($this->Session->read('User.id'), $id)[0];
            var_dump($repost);
            if ($repost !== null) {
                $this->Repost->id = $repost['Repost']['id'];
                $this->request->data['Repost']['modified'] = date("Y-m-d H:i:s");
                $this->request->data['Repost']['deleted'] = 0;
            } else {
                $this->Repost->create();
                $this->request->data['Repost']['user_id'] = $this->Session->read('User.id');
                $this->request->data['Repost']['post_id'] = $id;
            }
            if ($this->Repost->save($this->request->data)) {
                $this->Flash->success(__('Successfully reposted.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to repost that post.'));
        }
    }

    public function undoRepost($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $repost = $this->Repost->findById($id);
        if (!$repost) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post'))) {
            if ($this->Repost->save(array('id' => $id, 'deleted' => 1, 'deleted_date' => date("Y-m-d H:i:s")))) {
                $this->Flash->success(__('Your repost has been undone.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to undo your repost.'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function like($id) {
        if ($this->request->is('post')) {
            $like = $this->Like->findAllByUserIdAndPostId($this->Session->read('User.id'), $id)[0];
            var_dump($like);
            if ($like !== null) {
                $this->Like->id = $like['Like']['id'];
                $this->request->data['Like']['modified'] = date("Y-m-d H:i:s");
                $this->request->data['Like']['deleted'] = 0;
            } else {
                $this->Like->create();
                $this->request->data['Like']['user_id'] = $this->Session->read('User.id');
                $this->request->data['Like']['post_id'] = $id;
            }
            if ($this->Like->save($this->request->data)) {
                $this->Flash->success(__('Successfully liked.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to like that post.'));
        }
    }

    public function undoLike($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $like = $this->Like->findById($id);
        if (!$like) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post'))) {
            if ($this->Like->save(array('id' => $id, 'deleted' => 1, 'deleted_date' => date("Y-m-d H:i:s")))) {
                $this->Flash->success(__('Your like has been undone.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to undo your like.'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function logout() {
        $this->Session->destroy();
        return $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }
}