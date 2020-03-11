<?php
class SearchesController extends AppController {
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

        $this->set('posts', $this->Post->find('all', array(
            'conditions' => array(
                'OR' => array(
                    'Post.title LIKE' => '%' . $terms . '%',
                    'Post.body LIKE' => '%' . $terms . '%'))))
        );

        $this->set('users', $this->User->find('all', array(
            'conditions' => array('User.username LIKE' => '%' . $terms . '%')))
        );
    }

    public function users() {
        $terms = $this->params['url']['terms'];
        $this->set('terms', $terms);

        $this->Paginator->settings = array(
            'conditions' => array('User.username LIKE' => '%' . $terms . '%'),
            'limit' => self::PAGE_LIMIT
        );

        try {
            $this->set('users', $this->Paginator->paginate('User'));
        } catch (Exception $e) {
            $totalRecords = count(
                $this->User->find('all', array('conditions' => array('User.username LIKE' => '%' . $terms . '%')))
            );
            return $this->redirect(
                array_merge(
                    array('action' => 'users', '?' => array('terms' => $terms)),
                    array('page' => ceil($totalRecords / self::PAGE_LIMIT))
                )
            );
        }
    }

    public function posts() {
        $terms = $this->params['url']['terms'];
        $this->set('terms', $terms);

        $this->Paginator->settings = array(
            'conditions' => array(
                'OR' => array(
                    'Post.title LIKE' => '%' . $terms . '%',
                    'Post.body LIKE' => '%' . $terms . '%')),
            'limit' => self::PAGE_LIMIT
        );

        try {
            $this->set('posts', $this->Paginator->paginate('Post'));
        } catch (Exception $e) {
            $totalRecords = count(
                $this->Post->find('all', array(
                    'conditions' => array(
                        'OR' => array(
                            'Post.title LIKE' => '%' . $terms . '%', 
                            'Post.body LIKE' => '%' . $terms . '%')
                        )
                    )
                )
            );
            return $this->redirect(
                array_merge(
                    array('action' => 'posts', '?' => array('terms' => $terms)),
                    array('page' => ceil($totalRecords / self::PAGE_LIMIT))
                )
            );
        }
    }
}