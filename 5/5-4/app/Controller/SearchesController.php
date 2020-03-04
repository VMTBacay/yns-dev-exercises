<?php
class SearchesController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash', 'Space');
    public $components = array('Flash', 'Session');

    public $uses = array('User', 'Post', 'Follower');

    public function index($type = null) {
        $this->set('type', $type);

        $follows = array($this->Session->read('User.id'));
        $followIds = $this->Follower->find('all', array(
            'conditions' => array('follower_id' => $this->Session->read('User.id'), 'Follower.deleted' => 0),
            'fields' => 'user_id'
        ));
        foreach ($followIds as $followId) {
            array_push($follows, $followId['Follower']['user_id']);
        }
        $this->set('follows', $follows);

        $terms = array_key_exists('Search', $this->request->data) ? $this->request->data['Search']['terms'] : $this->Session->read('Search.terms');
        $this->set('terms', $terms);
        $this->Session->write('Search.terms', $terms);

        $this->set('posts', $this->Post->find('all', array(
            'conditions' => array(
                'OR' => array(
                    array('Post.title LIKE' => '%' . $terms . '%'),
                    array('Post.body LIKE' => '%' . $terms . '%'))),
            'limit' => 6
        )));

        $this->set('users', $this->User->find('all', array(
            'conditions' => array(
                array('User.username LIKE' => '%' . $terms . '%')),
            'limit' => 6
        )));
    }
}