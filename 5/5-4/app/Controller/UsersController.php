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

    public function beforeFilter() {
    }

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

            if (!empty($user) && $user['User']['password'] === $this->request->data['User']['password'] && $user['User']['activated']) {
                $this->Session->write('User', $user['User']);
                return $this->redirect(array('controller' => 'posts'));
            } else {
                $this->Flash->error(__('Invalid username/password.'));
            }
        }
    }

    public function activated() {
        $this->layout = 'suli';
    }

    public function editUsername() {
        $this->User->validator()->remove('password');
        $this->User->validator()->remove('email');

        if ($this->request->is('post')) {
            $this->User->id = $this->Session->read('User.id');
            $this->request->data['User']['modified'] = date("Y-m-d H:i:s");
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Your username has been updated.'));
                $this->Session->write('User.username', $this->request->data['User']['username']);
                return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your username.'));
        }
    }

    public function editEmail() {
        $this->User->validator()->remove('username');
        $this->User->validator()->remove('password');

        if ($this->request->is('post')) {
            $this->User->id = $this->Session->read('User.id');
            $this->request->data['User']['modified'] = date("Y-m-d H:i:s");
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Your email has been updated.'));
                $this->Session->write('User.email', $this->request->data['User']['email']);
                return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your email.'));
        }
    }

    public function editPassword() {
        $this->User->validator()->remove('username');
        $this->User->validator()->remove('email');
        $this->User->validator()->add('repass', 'required', array(
            'rule' => array('equalToField', 'password'),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Re-entered password is different'
        ));

        if ($this->request->is('post')) {
            if ($this->request->data['User']['oldpass'] !== $this->Session->read('User.password')) {
                $this->Flash->error(__('Old password is incorrect.'));
            } else {
                $this->User->id = $this->Session->read('User.id');
                $this->request->data['User']['modified'] = date("Y-m-d H:i:s");
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('Your password has been updated.'));
                    $this->Session->write('User.password', $this->request->data['User']['password']);
                    return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
                }
                $this->Flash->error(__('Unable to update your password.'));
            }
        }
    }

    public function editProfilePic() {
        $this->User->validator()->remove('username');
        $this->User->validator()->remove('password');
        $this->User->validator()->remove('email');

        if ($this->request->is('post')) {
            $this->User->id = $this->Session->read('User.id');
            $this->request->data['User']['modified'] = date("Y-m-d H:i:s");
            $img_name = explode('.', $this->request->data['User']['pic']['name']);
            $target_dir = dirname(APP) . '/app/webroot/img/';
            $target_file = $target_dir . $img_name[0] . '.' . $img_name[1];
            $i = 1;
            while (file_exists($target_file)) {
                $target_file = $target_dir . $img_name[0] . $i . '.' . $img_name[1];
                $i++;
            }
            $this->request->data['User']['profile_pic'] = basename($target_file);
            if ($this->User->save($this->request->data)) {

                move_uploaded_file($this->request->data['User']['pic']['tmp_name'], $target_file);
                $this->Flash->success(__('Your profile picture has been updated.'));
                $this->Session->write('User.profile_pic', basename($target_file));
                return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your profile picture.'));
        }
    }
}