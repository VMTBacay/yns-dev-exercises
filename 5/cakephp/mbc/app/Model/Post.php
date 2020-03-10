<?php
App::uses('AppModel', 'Model');

class Post extends AppModel
{
    public $validate = array(
        'description' => array(
            'rule' => array('lengthBetween', 0, 140),
            'message' => 'Between 0 to 140 characters',
            'allowEmpty' => false,
        ),
        'image' => array(
            'rule' => array('chkImageExtension'),
            'message' => 'Please Upload Valid Image.',
            'allowEmpty' => true
        ),
        'size' => [
			'rule' => array('checkSize'),
			'message' => 'Must be less than 2MB',
			'allowEmpty' => true
		],
    );
    public $hasMany = array(
        'Children' => array(
            'className' => 'Posts',
            'foreignKey' => 'id'
        ),
        'PostLike' => array(
            'className' => 'PostLikes',
            'conditions' => [
                'is_deleted' => 0
            ]
        ),
        'PostComment' => [
            'classname' => 'PostComments',
            'conditions' => [
                'is_deleted' => 0
            ]
        ]
    );
    public $belongsTo = array(
        'User',
        'hasRelation' => array(
            'className' => 'Followers',
            'foreignKey' => false,
            'conditions' => [
                'OR' => [
                    'hasRelation.user_id_from = Post.user_id',
                    'hasRelation.user_id_to = Post.user_id',
                ]
            ],
        ),
        'Follower' => array(
            'className' => 'Followers',
            'foreignKey' => false,
            'conditions' => [
                'OR' => [
                    'hasRelation.user_id_to = Follower.user_id_to',
                ]
            ],
        ),
        'Following' => array(
            'className' => 'Followers',
            'foreignKey' => false,
            'conditions' => [
                'OR' => [
                    'hasRelation.user_id_from = Following.user_id_from',
                ]
            ],
        ),
        'Parent' => array(
            'className' => 'Posts',
            'foreignKey' => 'parent_post_id'
        ),
    );

    public function chkImageExtension($data)
    {
        $return = true;
        if ($data['image'] != '') {
            $fileData = pathinfo($data['image']);
            $ext = $fileData['extension'];
            $allowExtension = array('gif','GIF' ,'jpeg','JPEG' ,'png', 'PNG','jpg', 'JPG');
            if (in_array($ext, $allowExtension)) {
                $return = true;
            } else {
                $return = false;
            }
        } else {
            $return = false;
        }
        return $return;
    }
    function checkSize($data)
	{
		$return = false;
		if ($data['size'] != 0) {
			return true;
		}
		return $return;
	}
}