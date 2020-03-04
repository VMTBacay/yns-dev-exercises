<?php
class Follower extends AppModel {
    public $belongsTo = array(
        'User',
        'FollowerProfile' => array(
            'className' => 'User',
            'foreignKey' => 'follower_id'
        )
    );

    public $validate = array(
        'follower_id' =>  array(
            'rule' => array('notEqualToField', 'user_id')
        )
    );

    public function notEqualToField($check, $otherField) {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value) {
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$fname] !== $this->data[$this->name][$otherField];
    } 
}