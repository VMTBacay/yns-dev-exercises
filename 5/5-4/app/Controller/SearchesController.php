<?php
class SearchesController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash', 'Space');
    public $components = array('Flash', 'Session', 'Paginator');

    public $uses = array('User', 'Post', 'Follower');

    const PAGE_LIMIT = 5;

    public function index() {
        $terms = $this->params['url']['terms'];
        if ($terms === '') {
            $this->Flash->error(__('Search bar empty.'));
            return $this->redirect($this->referer());
        }
        $this->set('terms', $terms);

        $follows = array($this->Session->read('User.id'));
        $followIds = $this->Follower->find('all', array(
            'conditions' => array('follower_id' => $this->Session->read('User.id'), 'Follower.deleted' => 0),
            'fields' => 'user_id'
        ));
        foreach ($followIds as $followId) {
            array_push($follows, $followId['Follower']['user_id']);
        }
        $this->set('follows', $follows);

        $this->set('posts', $this->Post->find('all', array(
            'conditions' => array(
                'OR' => array(
                    'Post.title LIKE' => '%' . $terms . '%',
                    'Post.body LIKE' => '%' . $terms . '%'))
        )));

        $this->set('users', $this->User->find('all', array(
            'conditions' => array('User.username LIKE' => '%' . $terms . '%')
        )));
    }

    public function users() {
        $follows = array($this->Session->read('User.id'));
        $followIds = $this->Follower->find('all', array(
            'conditions' => array('follower_id' => $this->Session->read('User.id'), 'Follower.deleted' => 0),
            'fields' => 'user_id'
        ));
        foreach ($followIds as $followId) {
            array_push($follows, $followId['Follower']['user_id']);
        }
        $this->set('follows', $follows);

        $terms = $this->params['url']['terms'];
        $this->set('terms', $terms);

        $this->Paginator->settings = array(
            'conditions' => array('User.username LIKE' => '%' . $terms . '%'),
            'limit' => self::PAGE_LIMIT
        );
       $this->set('users', $this->Paginator->paginate('User'));
    }

    public function posts() {
        $follows = array($this->Session->read('User.id'));
        $followIds = $this->Follower->find('all', array(
            'conditions' => array('follower_id' => $this->Session->read('User.id'), 'Follower.deleted' => 0),
            'fields' => 'user_id'
        ));
        foreach ($followIds as $followId) {
            array_push($follows, $followId['Follower']['user_id']);
        }
        $this->set('follows', $follows);

        $terms = $this->params['url']['terms'];
        $this->set('terms', $terms);

        $this->Paginator->settings = array(
            'conditions' => array(
                'OR' => array(
                    'Post.title LIKE' => '%' . $terms . '%',
                    'Post.body LIKE' => '%' . $terms . '%')),
            'limit' => self::PAGE_LIMIT
        );
        $this->set('posts', $this->Paginator->paginate('Post'));
    }
}