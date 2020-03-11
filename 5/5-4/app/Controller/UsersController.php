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
    public $components = array('Flash', 'Session');

    public $uses = array('User', 'Follower');

    public function beforeFilter() {
    }

    public function signUp() {
        $this->layout = 'suli';

        $this->User->validator()->add('repass', 'required', array(
            'rule' => array('equalToField', 'password'),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Re-entered password is different')
        );

       if ($this->request->is('post')) {
            $this->User->create();
            $activationCode = '';
            for ($i = 0; $i < 6; $i++) {
                $activationCode .= rand(0, 9);
            }
            $this->request->data['User']['activation_code'] = $activationCode;
            if ($this->User->save($this->request->data)) {

                return $this->redirect(array('action' => 'activation', $this->User->id, 0));
            }
        }
    }

    public function activation($id, $resend) {
        $this->layout = 'suli';
        $this->set('id', $id);

        $user = $this->User->findById($id);

        if ($this->request->is('post')) {
            $this->User->validator()
                ->add('code', 'required', array(
                    'rule' => array('equalToField', 'activation_code'),
                    'required' => true,
                    'allowEmpty' => false,
                    'message' => 'Incorrect code')
                )
                ->add('activation_code_date', array(
                    'rule' => array('activationExpiration'),
                    'required' => true,
                    'allowEmpty' => false,
                    'message' => 'Code expired'
                )
            );

            $user['User']['code'] = $this->request->data['User']['code'];
            $user['User']['activated'] = 1;
            if($this->User->save($user)) {
                return $this->redirect(array('action' => 'activated'));
            }
            $resend = 0;
        }

        if ($this->referer() === Router::url(array('action' => 'signUp'), true) || $resend === '1') {
            if ($resend === '1') {
                $activationCode = '';
                for ($i = 0; $i < 6; $i++) {
                    $activationCode .= rand(0, 9);
                }
                $user['User']['activation_code'] = $activationCode;
                $user['User']['activation_code_date'] = date("Y-m-d H:i:s");
                $this->User->save($user);
                $this->Flash->success(__('A new code has been sent.'));
            }
            $codeMail = new CakeEmail(EmailConfig::$gmail);
            $codeMail->from(array('code@microblog.com' => 'microblog'));
            $codeMail->to($user['User']['email']);
            $codeMail->subject('Activation code');
            $codeMail->send(
                'Your code is ' . $user['User']['activation_code'] . '. Activate it through this url: ' . Router::url(array('action' => 'activation', $id, 0), true)
            );
        }
    }

    public function login() {
        $this->layout = 'suli';

        if ($this->request->is('post')) {
            $user = $this->User->findByUsernameAndDeleted($this->request->data['User']['username'], 0);

            if (!empty($user) && $user['User']['password'] === $this->request->data['User']['password'] && $user['User']['activated']) {
                $this->Session->write('user', $user['User']);

                $follows = array($this->Session->read('user.id'));
                $followIds = $this->Follower->find('all', array(
                    'conditions' => array('follower_id' => $this->Session->read('user.id'), 'Follower.deleted' => 0),
                    'fields' => 'user_id'
                ));
                foreach ($followIds as $followId) {
                    array_push($follows, $followId['Follower']['user_id']);
                }
                $this->Session->write('user.follows', $follows);

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
        if ($this->Session->read('user.id') === null) {
            return $this->redirect(array('controller' => 'users', 'action' => 'signUp'));
        }

        $this->User->validator()->remove('password');
        $this->User->validator()->remove('email');

        if ($this->request->is('post')) {
            $this->User->id = $this->Session->read('user.id');
            $this->request->data['User']['modified'] = date("Y-m-d H:i:s");
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Your username has been updated.'));
                $this->Session->write('user.username', $this->request->data['User']['username']);
                return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your username.'));
        }
    }

    public function editEmail() {
        if ($this->Session->read('user.id') === null) {
            return $this->redirect(array('controller' => 'users', 'action' => 'signUp'));
        }

        $this->User->validator()->remove('username');
        $this->User->validator()->remove('password');

        if ($this->request->is('post')) {
            $this->User->id = $this->Session->read('user.id');
            $this->request->data['User']['modified'] = date("Y-m-d H:i:s");
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Your email has been updated.'));
                $this->Session->write('user.email', $this->request->data['User']['email']);
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
            if ($this->request->data['User']['oldpass'] !== $this->Session->read('user.password')) {
                $this->Flash->error(__('Old password is incorrect.'));
            } else {
                $this->User->id = $this->Session->read('user.id');
                $this->request->data['User']['modified'] = date("Y-m-d H:i:s");
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('Your password has been updated.'));
                    $this->Session->write('user.password', $this->request->data['User']['password']);
                    return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
                }
                $this->Flash->error(__('Unable to update your password.'));
            }
        }
    }

    public function editProfilePic() {
        if ($this->Session->read('user.id') === null) {
            return $this->redirect(array('controller' => 'users', 'action' => 'signUp'));
        }

        $this->User->validator()->remove('username');
        $this->User->validator()->remove('password');
        $this->User->validator()->remove('email');
        $this->User->validator()->add('profile_pic', 'required', array(
            'rule' => array('chkImageExtension'),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please Upload Valid Image.'
        ));

        if ($this->request->is('post')) {
            if ($this->request->data['User']['pic']['name'] === '') {
                return $this->Flash->error(__('Please choose your profile picture.'));
            }
            $this->User->id = $this->Session->read('user.id');
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
                $this->Session->write('user.profile_pic', basename($target_file));
                return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your profile picture.'));
        }
    }
}