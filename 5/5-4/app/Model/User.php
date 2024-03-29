<?php
class User extends AppModel {
    public $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Letters and numbers only'
            ),
            'between' => array(
                'rule' => array('lengthBetween', 5, 15),
                'message' => 'Between 5 to 15 characters'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Username taken'
            )
        ),
        'password' => array(
            'rule' => array('minLength', '8'),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Minimum 8 characters long'
        ),
        'email' =>  array(
            'mail' => array(
                'rule' => 'email',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Invalid email'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Email taken'
            )
        )
    );

    public function equalToField($check, $otherField) {
        $fname = '';
        foreach ($check as $key => $value) {
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$fname] === $this->data[$this->name][$otherField];
    }

    public function activationExpiration($check) {
        return time() - strtotime($check['activation_code_date'])  <= 1800;
    }

    public function chkImageExtension($data) {
       $return = true; 

       if($data['profile_pic'] != ''){
            $fileData   = pathinfo($data['profile_pic']);
            $ext        = $fileData['extension'];
            $allowExtension = array('gif', 'jpeg', 'png', 'jpg');

            if(in_array($ext, $allowExtension)) {
                $return = true; 
            } else {
                $return = false;
            }   
        } else {
            $return = false; 
        }   

        return $return;
    } 
}