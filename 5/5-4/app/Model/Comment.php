<?php
class Comment extends AppModel {
    public $belongsTo = array('User', 'Post');

    public $validate = array(
        'body' => array(
            'rule' => array('maxLength', '140'),
            'allowEmpty' => false,
            'message' => 'Minimum 140 characters long'
        )
    );
}