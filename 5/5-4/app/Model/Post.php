<?php
class Post extends AppModel {
    public $belongsTo = 'User';

    public $hasMany = array(
        'Repost' => array(
            'className' => 'Repost',
            'conditions' => array('Repost.deleted' => '0')
        ),
        'Like' => array(
            'className' => 'Like',
            'conditions' => array('Like.deleted' => '0')
        ),
        'Comment' => array(
            'className' => 'Comment',
            'conditions' => array('Comment.deleted' => '0')
        )
    );

    public $validate = array(
        'title' => array(
            'rule' => array('maxLength', '50'),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Maximum 50 characters long'
        ),
        'body' => array(
            'rule' => array('maxLength', '140'),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Minimum 140 characters long'
        )
    );
}