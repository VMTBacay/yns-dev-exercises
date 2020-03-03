<?php
App::uses('CakeEmail', 'Network/Email');
class EmailConfig {
    public static $gmail = array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'ynsmicroblog@gmail.com',
        'password' => 'microbloG0',
        'transport' => 'Smtp'
    );
}

class UsersController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash', 'Session');
    

    public function signUp() {
        $this->layout = 'suli';

        $this->User->validator()->add('repass', 'required', array(
            'rule' => array('equalToField', 'password'),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Re-entered password is different'
        ));

       if ($this->request->is('post')) {
            $this->User->create();
            $activationCode = '';
            for ($i = 0; $i < 6; $i++) { 
                $activationCode .= rand(0, 9);
            }
            $codeMail = new CakeEmail(EmailConfig::$gmail);
            $codeMail->from(array('code@microblog.com' => 'microblog'));
            $codeMail->to($this->request->data['User']['email']);
            $codeMail->subject('Activation code');
            $codeMail->send('Your code is ' . $activationCode);
            $this->request->data['User']['activation_code'] = $activationCode;
            if ($this->User->save($this->request->data)) {
                return $this->redirect(array('action' => 'activation', $this->User->id));
            }
        }
    }

    public function activation($id) {
        $this->layout = 'suli';

        $this->User->validator()
            ->add('code', 'required', array(
                'rule' => array('equalToField', 'activation_code'),
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Incorrect code'
            ))
            ->add('activation_code_date', array(
                'rule' => array('activationExpiration'),
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Code expired'
            ));

        if ($this->request->is('post')) {
            $user = $this->User->findById($id);
            $user['User']['code'] = $this->request->data['User']['code'];
            $user['User']['activated'] = 1;
            if($this->User->save($user)) {
                return $this->redirect(array('action' => 'activated'));
            }
        }
    }

    public function login() {
        $this->layout = 'suli';
        
        if ($this->request->is('post')) {
            $user = $this->User->findByUsername($this->request->data['User']['username']);
            if ($user['User']['password'] === $this->request->data['User']['password'] && $user['User']['activated']) {
                $this->Session->write('User.id', $user['User']['id']);
                $this->Session->write('User.profile_pic', $user['User']['profile_pic']);
                return $this->redirect(array('controller' => 'posts'));
            }
        }
    }

    public function activated() {
        $this->layout = 'suli';
    }
}