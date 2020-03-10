<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public $helpers = ['Html', 'Form'];

    public $name = 'Users';

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('register', 'mail', 'uploadImage', 'activateAccount', 'login', 'logout', 'changePassword', 'changePassword');
    }

    /**
     * This is use to authenticate the user to the web app
     *
     * @return void
     */
    public function login()
    {
        if ($this->Auth->login()) {
            if ($this->Auth->user('activated') == 1) $this->redirect($this->Auth->redirect(['controller' => 'Posts', 'action' => 'index']));
            else $this->Auth->logout();
            $this->Session->setFlash(__('Please activate your account first!!'));
        } else {
            if ($this->request->is('post')) {
                $this->Flash->error(__('Your username/password was incorrect'));
            }
        }
    }
    /**
     * This is used to logout the user from the web app
     */
    public function logout()
    {
        $this->redirect($this->Auth->logout());
    }
    /**
     * This is used to register the user
     *
     * @param [type] $message
     * @return void
     */
    public function register($message = null)
    {
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect(['controller' => 'Posts', 'action' => 'index']));
        }
        if ($message != null) {
            $this->Flash->error(__($message));
        }
        $image_name = 'profile.gif';
        $image_size = 463698;
        if ($this->request->is('post')) {
            $activation = Security::hash(uniqid());
            $img_name_will_be_use = uniqid();

            if ($this->request->params['form']['image']['name'] != '') {
                $image_name = $this->getUniqueFileName($img_name_will_be_use, $this->request->params['form']['image']['name']);
                $image_size = $this->request->params['form']['image']['size'];
            }
            $form_data = [
                'username' => $this->request->data['User']['username'],
                'password' => $this->request->data['User']['password'],
                'password_confirm' => $this->request->data['User']['password_confirm'],
                'fullname' => $this->request->data['User']['fullname'],
                'age' => $this->request->data['User']['age'],
                'address' => $this->request->data['User']['address'],
                'email' => $this->request->data['User']['email'],
                'image' => $image_name,
                'size' => $image_size,
                'bio' => $this->request->data['User']['bio'],
                'activation_code' => $activation
            ];
            $this->User->create($form_data);
            $this->set('data', $form_data);
            if ($this->User->save()) {
                if ($this->request->params['form']['image']['name'] != '') {
                    if ($this->uploadImage($this->request->params, $this->getUniqueFileName($img_name_will_be_use, $this->request->params['form']['image']['name']))) {

                    } else {
                        $this->Flash->error(__('Oops something wrong in uploading image!!'));
                    }
                }
                $this->Flash->success(__('Activate your account then proceed to login'));
                $email = $this->request->data['User']['email'];
                if ($this->mail($email, $activation, $this->request->data['User']['fullname'])) {
                    $this->Flash->success(__('Oops something wrong in sending the email!!'));
                }
            }
        }
    }

    /**
     * This is used to send activation link via email
     */
    public function mail($email_address, $activation_code, $fullname)
    {
        try {
            $email = new CakeEmail('gmail');
            $email->template('activation', null);
            $email->emailFormat('html');
            $email->to($email_address);
            $email->subject('Activate Email');
            $data = [
                'link' => 'http://' . $_SERVER['HTTP_HOST'] . '/Users/activateAccount/' . $email_address . '/' . $activation_code,
                'fullname' => $fullname
            ];
            $email->send(json_encode($data));
            return $this->redirect(['action' => 'login']);
        } catch (\Throwable $th) {
            die('Error');
        }
    }

    /**
     * This function is used to upload profile picture of the user
     *
     * @param [type] $img_obj
     * @return void
     */
    public function uploadImage($img_obj, $img_name_will_be_use)
    {
        $img_name = $img_name_will_be_use;
        $img_temp = $img_obj['form']['image']['tmp_name'];
        $return = false;
        $img_path = "img/blog/" . $img_name;
        if (move_uploaded_file($img_temp, WWW_ROOT . $img_path)) {
            $return = true;
        }
        return $return;
    }
    /**
     * This function is used to create a unique name for the image
     *
     * @param [type] $img_name
     * @param [type] $filename
     * @return void
     */
    public function getUniqueFileName($img_name, $filename)
    {
        $tmp = explode(".", $filename);
        $extension = end($tmp);
        $data = $img_name . '.' . $extension;
        return $data;
    }
    /**
     * This function is used to activated the user account
     *
     * @param [type] $email
     * @param [type] $activate_code
     * @return void
     */
    public function activateAccount($email, $activate_code)
    {
        if (!$email || !$activate_code) {
            throw new NotFoundException(__('Invalid post'));
        }
        $new_activate_code = Security::hash(uniqid());
        $this->User->id = $this->User->field('id', ['email' => $email, 'activation_code' => $activate_code]);
        if ($this->User->id) {
            if ($this->User->set(['activated' => 1, 'activation_code' => $new_activate_code])) {
                $this->User->save();
            } else {
                $this->Flash->error(
                    __('Oops something went wrong')
                );
            }
        } else {
            return $this->redirect([
                'controller' => 'Errors',
                'action' => 'missingAction'
            ]);
        }
    }
    /**
     * This is function is used to show the profile and full name of the post owner
     *
     * @param [type] $id
     * @return void
     */
    public function getParentProfile($id)
    {
        $data = $this->User->find('first', ['conditions' => ['id' => $id]]);
        $this->set('data', $data);
    }
    /**
     * This function is used to show all user except the authenticated user
     *
     * @return void
     */
    public function allUsers()
    {
        $authenticated_user_id = $this->Auth->user('id');
        $data = $this->User->find('all', ['conditions' => ['id !=' => $authenticated_user_id, 'activated' => 1]]);
        $this->set('data', $data);
    }
    /**
     * This function is used show the user follower
     */
    public function follower($id = null)
    {
        $authenticated_user_id = $this->Auth->user('id');
        if ($id == null) {
            $id = $authenticated_user_id;
        }
        $data = $this->User->find('first', ['conditions' => ['id' => $id]]);
        $user_information = [];
        for ($i = 0; $i < count($data['Followers']); $i++) {
            if ($data['Followers'][$i]['is_deleted'] == 0) {
                $temp = $this->User->find('first', ['conditions' => ['id' => $data['Followers'][$i]['user_id_from']]]);
                $user_information[] = [
                    'detail' => $temp['User']
                ];
            }
        }
        $definition = [
            'Followers' => $data['Followers'],
            'user_information' => $user_information
        ];
        $this->set('data', $definition);
    }
    /**
     * This function is used to show following of the user
     *
     * @param [type] $id
     * @return void
     */
    public function following($id = null)
    {
        $authenticated_user_id = $this->Auth->user('id');
        if ($id == null) {
            $id = $authenticated_user_id;
        }
        $data = $this->User->find('first', ['conditions' => ['id' => $id]]);
        $user_information = [];
        for ($i = 0; $i < count($data['Following']); $i++) {
            if ($data['Following'][$i]['is_deleted'] == 0) {
                $temp = $this->User->find('first', ['conditions' => ['id' => $data['Following'][$i]['user_id_to']]]);
                $user_information[] = [
                    'detail' => $temp['User']
                ];
            }
        }
        $definition = [
            'following' => $data['Following'],
            'user_information' => $user_information
        ];
        $this->set('data', $definition);
        $this->set('current_user', $id);
    }
    /**
     * This function is used to show the profile information and its posts
     *
     * @param [type] $id
     * @return void
     */
    public function profile($id = null, $message = null)
    {
        if ($message != null) {
            $this->Flash->error(__($message));
        }
        $this->loadModel('Post', 'Follower');
        $user_info = $this->User->find('first', ['conditions' => ['id' => $id, 'activated' => 1]]);
        if ($user_info == []) {
            return $this->redirect([
                'controller' => 'Errors',
                'action' => 'missingAction'
            ]);
        }
        $user_post = $this->Post->find('all', ['conditions' => ['Post.user_id' => $id]]);
        $info = [
            'user_info' => $user_info,
            'user_post' => $user_post
        ];
        $search = '';
        if (isset($this->request->data['search_post_description'])) {
            $search = $this->request->data['search_post_description'];
        }
        $currentUser = $id;
        if ($id != null) {
            $currentUser = ['Post.user_id' => $id];
        }
        $this->paginate = [
            'conditions' => [
                'Post.is_deleted' => 0,
                'Post.description LIKE' => "%" . $search . "%",
                $currentUser
            ],
            'limit' => 6,
            'group' => 'Post.id',
            'order' => ['id' => 'desc']
        ];
        $result = $this->paginate('Post');
        $this->set('data', $result);
        $this->set('profile_data', $info);
    }
    /**
     * This function is used to update the user information
     *
     * @return void
     */
    public function updateUserAccount()
    {
        $authenticated_user_id = $this->Auth->user('id');
        $image = $this->User->field('image', ['id' => $authenticated_user_id]);
        $img_name_will_be_use = uniqid();
        if ($this->request->params['form']['image']['name'] != '') {
            $image = $this->getUniqueFileName($img_name_will_be_use, $this->request->params['form']['image']['name']);
            if ($this->uploadImage($this->request->params, $this->getUniqueFileName($img_name_will_be_use, $this->request->params['form']['image']['name']))) {

            } else {
                $this->redirect(['action' => 'profile', $authenticated_user_id, 'The file is too large or invalid file format']);
            }
        } else {

        }
        $form_data = [
            'username' => $this->request->data['User']['username'],
            'fullname' => $this->request->data['User']['fullname'],
            'email' => $this->request->data['User']['email'],
            'age' => $this->request->data['User']['age'],
            'address' => $this->request->data['User']['address'],
            'bio' => $this->request->data['User']['bio'],
            'image' => $image
        ];
        $this->User->id = $authenticated_user_id;
        $this->User->set($form_data);
        if ($this->User->save()) {
            $this->redirect(['action' => 'profile', $authenticated_user_id, 'Success']);
        } else {
            $this->redirect(['action' => 'profile', $authenticated_user_id, 'Some of your inputted information are invalid']);
        }
    }
    /**
     * get the current user information. This is for navigation bar purposes
     *
     * @param string $index
     * @return void
     */
    public function getCurrentUser($index = 'username')
    {
        $authenticated_user_id = $this->Auth->user('id');
        $data = $this->User->find('first', ['conditions' => ['id' => $authenticated_user_id]]);
        $this->set('data', $data['User'][$index]);
    }
    /**
     * This function is used to send mail in the user that gives the user authority to change password
     *
     * @return void
     */
    public function sendNewPassword()
    {
        $authenticated_user_id = $this->Auth->user('id');
        $activation = Security::hash(uniqid());
        if ($this->request->data['User']['password'] != $this->request->data['User']['password_confirm']) {
            $this->redirect(['action' => 'profile', $authenticated_user_id, 'Password not match!']);
        }
        $password = $this->request->data['User']['password'];
        $data = $this->User->find('first', ['conditions' => ['id', $authenticated_user_id]]);
        $this->User->id = $this->User->field('id', ['email' => $data['User']['email']]);
        $form_data = [
            'change_password_activation' => $activation,
            'password_to_be_use' => $password
        ];
        $this->User->set($form_data);
        if ($this->User->save()) {
            $email = new CakeEmail('gmail');
            $email->template('change_password', null);
            $email->emailFormat('html');
            $email->to($data['User']['email']);
            $email->subject('Verify change password!');
            $data = [
                'link' => 'http://' . $_SERVER['HTTP_HOST'] . '/Users/changePassword/' . $data['User']['email'] . '/' . $activation,
                'fullname' => $data['User']['fullname']
            ];
            $email->send(json_encode($data));
            return $this->redirect(['action' => 'logout']);
        } else {
            $this->redirect(['action' => 'profile', $authenticated_user_id, 'The password must have at least 1 capital, 1 small case, 1 number and minimum of 8 characters']);
        }
    }
    /**
     * This function is used to change the password of the user by clicking the link that is sent via email
     *
     * @param [type] $email
     * @param [type] $activate_code
     * @return void
     */
    public function changePassword($email = null, $activate_code = null)
    {
        if ($email == null || $activate_code == null) {
            return $this->redirect([
                'controller' => 'Errors',
                'action' => 'missingAction'
            ]);
        }
        $data = $this->User->find('first', ['conditions' => ['email' => $email, 'change_password_activation' => $activate_code]]);
        $this->User->id = $this->User->field('id', ['email' => $email, 'change_password_activation' => $activate_code]);
        if ($this->User->id) {
            $change = Security::hash(uniqid());
            $this->User->set(['change_password_activation' => $change, 'password' => $data['User']['password_to_be_use'], 'password_to_be_use' => '12345678aA']);
            $this->User->save();
        } else {
            return $this->redirect([
                'controller' => 'Errors',
                'action' => 'missingAction'
            ]);
        }
    }
}