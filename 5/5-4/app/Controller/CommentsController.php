<?php
class CommentsController extends AppController {
    public $components = array('Flash', 'Session', 'Paginator');

    public $uses = array('Post', 'Comment', 'Follower');

    const PAGE_LIMIT = 5;

    public function index($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);

        $this->Paginator->settings = array(
            'conditions' => array('Comment.post_id' => $id, 'Comment.deleted' => 0),
            'limit' => self::PAGE_LIMIT,
            'order' => array('Comment.created' => 'desc')
        );

        try {
            $this->set('comments', $this->Paginator->paginate('Comment'));
        } catch (Exception $e) {
            return $this->redirect(array_merge(
                array('action' => 'index', $id),
                array('page' => ceil(count($this->Comment->findAllByPostIdAndDeleted($id, 0)) / self::PAGE_LIMIT)))
            );
        }

        if ($this->request->is('post')) {
            $this->Comment->create();
            $this->request->data['Comment']['user_id'] = $this->Session->read('user.id');
            $this->request->data['Comment']['post_id'] = $id;
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success(__('Your comment has been added.'));
                return $this->redirect(array('action' => 'index', $id));
            }
            $this->Flash->error(__('Unable to add your comment.'));
            return $this->redirect($this->referer());
        }
    }

    public function edit($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid comment'));
        }

        $comment = $this->Comment->findById($id);
        if (!$comment) {
            throw new NotFoundException(__('Invalid comment'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Comment->id = $id;
            $this->request->data['Comment']['modified'] = date("Y-m-d H:i:s");
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success(__('Your comment has been updated.'));
                return $this->redirect(array('action' => 'index', $comment['Post']['id']));
            }
            $this->Flash->error(__('Unable to update your comment.'));
            return $this->redirect($this->referer());
        }

        if (!$this->request->data) {
            $this->request->data = $comment;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid comment'));
        }

        $comment = $this->Comment->findById($id);
        if (!$comment) {
            throw new NotFoundException(__('Invalid comment'));
        }

        if ($this->request->is(array('post'))) {
            if ($this->Comment->save(array('id' => $id, 'deleted' => 1, 'deleted_date' => date("Y-m-d H:i:s")))) {
                $this->Flash->success(__('Your comment has been deleted.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Unable to delete your comment.'));
        }
        return $this->redirect($this->referer());
    }
}