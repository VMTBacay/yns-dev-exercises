<?php
class PostsController extends AppController {
    public $components = array('Flash', 'Session');

    public $uses = array('Post', 'Repost', 'Like', 'Comment', 'Follower');

    public function index($userOnly = null) {
        $this->set('userOnly', $userOnly);

        $follows = $userOnly === null ? $this->Session->read('user.follows') : array($this->Session->read('user.id'));

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
            'Post.deleted' => 0,
        ))));

        $this->set('posts', $this->Post->findAllByUserIdAndDeleted($follows, 0));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            $this->request->data['Post']['user_id'] = $this->Session->read('user.id');

            if (!$this->request->data['Post']['pic']['error']) {
                $img_name = explode('.', $this->request->data['Post']['pic']['name']);
                $target_dir = dirname(APP) . '/app/webroot/img/';
                $target_file = $target_dir . $img_name[0] . '.' . $img_name[1];
                $i = 1;
                while (file_exists($target_file)) {
                    $target_file = $target_dir . $img_name[0] . $i . '.' . $img_name[1];
                    $i++;
                }
                $this->request->data['Post']['image'] = basename($target_file);
            }

            if ($this->Post->save($this->request->data)) {
                if ($this->request->data['Post']['pic']['name'] !== null) {
                    move_uploaded_file($this->request->data['Post']['pic']['tmp_name'], $target_file);
                }
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

            if (!$this->request->data['Post']['pic']['error']) {
                $img_name = explode('.', $this->request->data['Post']['pic']['name']);
                $target_dir = dirname(APP) . '/app/webroot/img/';
                $target_file = $target_dir . $img_name[0] . '.' . $img_name[1];
                $i = 1;
                while (file_exists($target_file)) {
                    $target_file = $target_dir . $img_name[0] . $i . '.' . $img_name[1];
                    $i++;
                }
                $this->request->data['Post']['image'] = basename($target_file);
            }

            if ($this->Post->save($this->request->data)) {
                if ($this->request->data['Post']['pic']['name'] !== null) {
                    move_uploaded_file($this->request->data['Post']['pic']['tmp_name'], $target_file);
                }
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect($this->referer());
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
                $this->Flash->success(__('Successfully liked.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to like that post.'));
            return $this->redirect($this->referer());
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
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to undo your like.'));
            return $this->redirect($this->referer());
        }
    }

    public function logout() {
        $this->Session->destroy();
        return $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }
}