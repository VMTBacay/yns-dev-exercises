<?php
class PostsController extends AppController {
    public $components = array('Flash', 'Session');

    public $uses = array('Post', 'Repost', 'Like', 'Comment', 'Follower', 'User');

    public function index($id = null, $userOnly = null) {
        $this->set('userOnly', $userOnly);

        $id = $id === null ? $this->Session->read('user.id') : $id;
        $viewUser = $this->User->findByIdAndDeleted($id, 0);
        if (!array_key_exists('User', $viewUser)) {
             throw new NotFoundException(__('Invalid user'));
        }
        $this->set('viewUser', $viewUser['User']);

        $follows = array($id);
        $followIds = $this->Follower->find('all', array(
            'conditions' => array('follower_id' => $id, 'Follower.deleted' => 0),
            'fields' => 'user_id'
        ));
        foreach ($followIds as $followId) {
            array_push($follows, $followId['Follower']['user_id']);
        }
        $follows = $userOnly === null ? $follows : array($id);

        $repostPostIds = $this->Repost->find('all', array(
            'conditions' => array('Repost.user_id' => $follows, 'Repost.deleted' => 0),
            'fields' => 'post_id'
        ));
        $repostPosts = array();
        foreach ($repostPostIds as $repostPostId) {
            array_push($repostPosts, $repostPostId['Repost']['post_id']);
        }
        $this->set('repostPosts', $this->Post->findAllById($repostPosts, 0));

        $this->set('reposts', $this->Repost->find('all', array('conditions' => array(
            'Repost.user_id' => $follows,
            'Repost.deleted' => 0,
            'Post.deleted' => 0)))
        );

        $this->set('posts', $this->Post->findAllByUserIdAndDeleted($follows, 0));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            $this->request->data['Post']['user_id'] = $this->Session->read('user.id');
            $this->request->data['Post']['title'] = trim($this->request->data['Post']['title']);
            $this->request->data['Post']['body'] = trim($this->request->data['Post']['title']);

            if (!$this->request->data['Post']['pic']['error']) {
                $allowExtension = array('gif', 'jpeg', 'png', 'jpg');
                if(!in_array(explode('.', $this->request->data['Post']['pic']['name'])[1], $allowExtension)) {
                    $this->Flash->error(__('Please upload a valid image'));
                    return $this->redirect(array('action' => 'index'));
                }

                $img_name = explode('.', $this->request->data['Post']['pic']['name']);
                $target_dir = dirname(APP) . '/app/webroot/img/';
                $target_file = $target_dir . $img_name[0] . '.' . $img_name[1];
                $i = 1;
                while (file_exists($target_file)) {
                    $target_file = $target_dir . $img_name[0] . $i . '.' . $img_name[1];
                    $i++;
                }
                $this->request->data['Post']['image'] = basename($target_file);
            } else if ($this->request->data['Post']['pic']['name'] !== '') {
                $this->Flash->error(__('File is too big. Maximum is 2MB.'));
                return $this->redirect(array('action' => 'index'));
            }

            if ($this->Post->save($this->request->data)) {
                if ($this->request->data['Post']['pic']['name'] !== null) {
                    move_uploaded_file($this->request->data['Post']['pic']['tmp_name'], $target_file);
                }
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
            return $this->redirect(array('action' => 'index'));
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
            $this->request->data['Post']['title'] = trim($this->request->data['Post']['title']);
            $this->request->data['Post']['body'] = trim($this->request->data['Post']['title']);

            $this->request->data['Post']['image'] = null;
            if (!$this->request->data['Post']['pic']['error']) {
                $allowExtension = array('gif', 'jpeg', 'png', 'jpg');
                if(!in_array(explode('.', $this->request->data['Post']['pic']['name'])[1], $allowExtension)) {
                    return $this->Flash->error(__('Please upload a valid image'));
                }

                $img_name = explode('.', $this->request->data['Post']['pic']['name']);
                $target_dir = dirname(APP) . '/app/webroot/img/';
                $target_file = $target_dir . $img_name[0] . '.' . $img_name[1];
                $i = 1;
                while (file_exists($target_file)) {
                    $target_file = $target_dir . $img_name[0] . $i . '.' . $img_name[1];
                    $i++;
                }
                $this->request->data['Post']['image'] = basename($target_file);
            } else if ($this->request->data['Post']['pic']['name'] !== '') {
                return $this->Flash->error(__('File is too big. Maximum is 2MB.'));
            }

            if ($this->Post->save($this->request->data)) {
                if (!$this->request->data['Post']['pic']['error']) {
                    move_uploaded_file($this->request->data['Post']['pic']['tmp_name'], $target_file);
                }
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('controller' => 'comments', 'action' => 'index', $id));
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

        $this->Post->validator()->remove('title');
        $this->Post->validator()->remove('body');

        if ($this->request->is('post')) {
            if ($this->Post->save(array('id' => $id, 'deleted' => 1, 'deleted_date' => date("Y-m-d H:i:s")))) {
                $this->Flash->success(__('Your post has been deleted.'));
                return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
            $this->Flash->error(__('Unable to delete your post.'));
            return $this->redirect($this->referer());
        }
    }

    public function repost($id) {
        if ($this->request->is('post')) {
            $repost = $this->Repost->findAllByUserIdAndPostId($this->Session->read('user.id'), $id)[0];
            if ($repost !== null) {
                $this->Repost->id = $repost['Repost']['id'];
                $this->request->data['Repost']['modified'] = date("Y-m-d H:i:s");
                $this->request->data['Repost']['deleted'] = 0;
            } else {
                $this->Repost->create();
                $this->request->data['Repost']['user_id'] = $this->Session->read('user.id');
                $this->request->data['Repost']['post_id'] = $id;
            }
            if ($this->Repost->save($this->request->data)) {
                $this->Flash->success(__('Successfully reposted.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to repost that post.'));
            return $this->redirect($this->referer());
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
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to undo your repost.'));
        }
        return $this->redirect($this->referer());
    }

    public function like($id) {
        $this->autoRender = false;

        if ($this->request->is('post')) {
            $like = $this->Like->findAllByUserIdAndPostId($this->Session->read('user.id'), $id)[0];
            if ($like !== null) {
                $this->Like->id = $like['Like']['id'];
                $this->request->data['Like']['modified'] = date("Y-m-d H:i:s");
                $this->request->data['Like']['deleted'] = 0;
            } else {
                $this->Like->create();
                $this->request->data['Like']['user_id'] = $this->Session->read('user.id');
                $this->request->data['Like']['post_id'] = $id;
            }
            if ($this->Like->save($this->request->data)) {
                //$this->Flash->success(__('Successfully liked.'));
            }
            //$this->Flash->error(__('Unable to like that post.'));
        }
    }

    public function unlike($id) {
        $this->autoRender = false;

        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $like = $this->Like->findByPostIdAndUserId($id, $this->Session->read('user.id'));
        if (!$like) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is('post')) {
            if ($this->Like->save(array('id' => $like['Like']['id'], 'deleted' => 1, 'deleted_date' => date("Y-m-d H:i:s")))) {
                //$this->Flash->success(__('Your like has been undone.'));
            }
            //$this->Flash->error(__('Unable to undo your like.'));
        }
    }

    public function logout() {
        $this->Session->destroy();
        return $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }
}