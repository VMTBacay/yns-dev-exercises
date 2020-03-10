<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{

	public $validate = array(
		'username' => array(
			'usernameRule-1' => array(
				'rule' => ['custom', '/^[a-z0-9-_]*$/i'],
				'message' => 'Only alphabets, numbers, dash and underscore allowed',
				'allowEmpty' => false
			),
			'usernameRule-2' => array(
				'rule' => array('minLength', 5),
				'message' => 'Minimum length of 5 characters',
				'allowEmpty' => false
			),
			'usernameRule-3' => array(
				'rule' => 'isUnique',
				'message' => 'Provided Username already exists.',
				'allowEmpty' => false
			)
		),
		'password' => array(
			'passwordRule-1' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Only alphabets and numbers allowed',
				'allowEmpty' => false
			),
			'passwordRule-2' => array(
				'rule' => array('minLength', 8),
				'message' => 'Minimum length of 8 characters',
				'allowEmpty' => false
			),
			'passwordRule-3' => array(
				'rule' => ['isCaps'],
				'message' => 'Password must have at least 1 capital letter'
			),
			'passwordRule-4' => array(
				'rule' => ['isLower'],
				'message' => 'Password must have at least 1 Lowercase'
			),
			'passwordRule-5' => array(
				'rule' => ['isNumber'],
				'message' => 'Password must have at least 1 number'
			)
		),
		'password_to_be_use' => [
			'password_to_be_use-1' => array(
				'rule' => 'alphaNumeric',
				'message' => 'Only alphabets and numbers allowed',
				'allowEmpty' => false
			),
			'password_to_be_use-2' => array(
				'rule' => array('minLength', 8),
				'message' => 'Minimum length of 8 characters',
				'allowEmpty' => false
			),
			'password_to_be_use-3' => array(
				'rule' => ['isCaps_udpate'],
				'message' => 'Password must have at least 1 capital letter'
			),
			'password_to_be_use-4' => array(
				'rule' => ['isLower_udpate'],
				'message' => 'Password must have at least 1 Lowercase'
			),
			'password_to_be_use-5' => array(
				'rule' => ['isNumber_udpate'],
				'message' => 'Password must have at least 1 number'
			)
		],
		'password_confirm' => [
			'rule' => ['passwordConfirm'],
			'message' => 'Password not match!',
			'allowEmpty' => false
		],
		'fullname' => [
			'fullnameRule-1' => [
				'rule' => array('minLength', 8),
				'message' => 'Minimum length of 8 characters',
				'allowEmpty' => false,
			],
			'fullnameRule-2' => [
				'rule' => ['custom', "/^[a-zA-Z .'-]*$/i"],
				'message' => "Alphabetical characters, spaces, colons,dashes, and dot are allowed",
				'allowEmpty' => false,
			],
		],
		'age' => [
			'rule' => ['ageVerify'],
			'message' => 'Please enter only numbers and greater than 13 and less than 60',
			'allowEmpty' => false,
		],
		'address' => [
			'address-1' => [
				'rule' => array('minLength', 8),
				'message' => 'Minimum length of 8 characters',
				'allowEmpty' => false,
			],
			'address-2' => [
				'rule' => ['custom', '/^[a-z0-9 .]*$/i'],
				'message' => 'Alphanumeric characters with spaces and dot only',
				'allowEmpty' => false,
			]
		],
		'email' => array(
			'required-1' => array(
				'rule' => ['email'],
				'message' => 'Kindly provide a valid email for verification.',
				'allowEmpty' => false,
			),
			'required-2' => array(
				'rule' => array('custom', '/^[a-z0-9.@]*$/i'),
				'message' => 'Alphanumeric characters, dot and @ are allowed',
				'allowEmpty' => false,
			),
			'maxLength' => array(
				'rule' => array('maxLength', 255),
				'message' => 'Email cannot be more than 255 characters.',
				'allowEmpty' => false,
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Provided Email already exists.',
				'allowEmpty' => false,
			)
		),
		'image' => array(
			'extension' => array(
				'rule' => array('chkImageExtension'),
				'message' => 'Invalid file type',
				'allowEmpty' => true
			)
		),
		'size' => [
			'rule' => array('checkSize'),
			'message' => 'Must be less than 2MB',
			'allowEmpty' => true
		],
		'bio' => [
			'rule' => 'notBlank'
		],
		'activation_code' => [
			'rule' => 'notBlank'
		]
	);
	public $hasMany = array(
		'Posts' => array(
			'className' => 'Posts',
			'foreignKey' => 'user_id',
		),
		'Followers' => array(
			'className' => 'Followers',
			'foreignKey' => 'user_id_to',
			'conditions' => ['is_deleted' => 0]
		),
		'Following' => array(
			'className' => 'Followers',
			'foreignKey' => 'user_id_from',
			'conditions' => ['is_deleted' => 0]
		),
	);
	public function beforeSave($options = array())
	{
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}

	public function passwordConfirm($data)
	{
		$return = false;
		if ($data['password_confirm'] != '') {
			if ($data['password_confirm'] == $this->data[$this->alias]['password']) {
				$return = true;
			} else {
				$return = false;
			}
		}
		return $return;
	}
	public function chkImageExtension($data)
	{
		$return = true;
		if ($data['image'] != '') {
			$fileData = pathinfo($data['image']);
			$ext = $fileData['extension'];
			$allowExtension = array('gif', 'GIF', 'jpeg', 'JPEG', 'png', 'PNG', 'jpg', 'JPG');
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
	public function ageVerify($data)
	{
		$return = false;
		if ($data['age'] != '') {
			if ($data['age'] > 12 && $data['age'] < 61) {
				$return = true;
			} else {
				$return = false;
			}
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

	public function isCaps($data){
		$uppercase = 0;
		$password = $this->data[$this->alias]['password'];
		preg_match_all("/[A-Z]/", $password, $caps_match);
		$caps_count = count($caps_match [0]);
		return ($uppercase < $caps_count);
	}

	public function isLower($data){
		$uppercase = 0;
		$password = $this->data[$this->alias]['password'];
		preg_match_all("/[a-z]/", $password, $caps_match);
		$caps_count = count($caps_match [0]);
		return ($uppercase < $caps_count);
	}
	public function isNumber($data){
		$uppercase = 0;
		$password = $this->data[$this->alias]['password'];
		preg_match_all("/[0-9]/", $password, $caps_match);
		$caps_count = count($caps_match [0]);
		return ($uppercase < $caps_count);
	}

	public function isCaps_udpate($data){
		$uppercase = 0;
		$password = $this->data[$this->alias]['password_to_be_use'];
		preg_match_all("/[A-Z]/", $password, $caps_match);
		$caps_count = count($caps_match [0]);
		return ($uppercase < $caps_count);
	}

	public function isLower_udpate($data){
		$uppercase = 0;
		$password = $this->data[$this->alias]['password_to_be_use'];
		preg_match_all("/[a-z]/", $password, $caps_match);
		$caps_count = count($caps_match [0]);
		return ($uppercase < $caps_count);
	}
	public function isNumber_udpate($data){
		$uppercase = 0;
		$password = $this->data[$this->alias]['password_to_be_use'];
		preg_match_all("/[0-9]/", $password, $caps_match);
		$caps_count = count($caps_match [0]);
		return ($uppercase < $caps_count);
	}
}