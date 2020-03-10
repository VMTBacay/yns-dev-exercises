<?php

App::uses('AppModel', 'Model');
App::uses('AppController', 'Controller');

class PostsController extends AppController
{
    public $helpers = ['Html', 'Form'];

    public $name = 'Posts';

    public $components = ['Paginator'];
    /**
     * This is used to show all the post of the user and its following/follower
     *
     * @param [type] $message
     * @return void
     */
    public function index($message = null)
    {
        $authenticated_user_id = $this->Auth->user('id');
        if ($message != null) {
            $this->Flash->error(__($message));
        }
        $search = '';
        if (isset($this->request->data['search_post_description'])) {
            $search = $this->request->data['search_post_description'];
        }
        $this->paginate = [
            'conditions' => [
                'Post.is_deleted' => 0,
                'Follower.is_deleted' => 0,
                'Following.is_deleted' => 0,
                'Post.description LIKE' => "%" . $search . "%",
                'OR' => [
                    'hasRelation.user_id_from' => $authenticated_user_id,
                    'hasRelation.user_id_to' => $authenticated_user_id,
                ]
            ],
            'limit' => 6,
            'group' => 'Post.id',
            'order' => ['id' => 'desc']
        ];
        if ($this->paginate('Post') == []) {
            $this->paginate = [
                'conditions' => [
                    'Post.is_deleted' => 0,
                    'Post.description LIKE' => "%" . $search . "%",
                    'Post.user_id' => $authenticated_user_id
                ],
                'limit' => 6,
                'group' => 'Post.id',
                'order' => ['id' => 'desc']
            ];
        }
        if ($search != '' && $this->paginate('Post') == []) {
            return $this->redirect(['action' => 'noResultFound', $search]);
        }
        $result = $this->paginate('Post');
        $this->set('data', $result);
        $this->set('home', 'this is home');
    }
    /**
     * This is only used to show that the post is not exist
     *
     * @param [type] $search
     * @return void
     */
    public function noResultFound($search)
    {
        $this->set('search', $search);
    }
    /**
     * This post is used to upload post information
     *
     * @return void
     */
    public function addPost()
    {
        $authenticated_user_id = $this->Auth->user('id');
        if (!($this->request->data['Post']['user_id'] == $authenticated_user_id)) {
            return $this->redirect(['action' => 'index', 'Invalid action perform']);
        } else {
            if ($this->request->is('post')) {
                $img_name_will_be_use = uniqid();
                $image_name = $this->getUniqueFileName($img_name_will_be_use, $this->request->params['form']['image']['name']);
                if ($this->request->params['form']['image']['name'] == '') {
                    $image_name = '';
                }
                $form_data = [
                    'user_id' => $this->request->data['Post']['user_id'],
                    'description' => $this->request->data['Post']['description'],
                    'image' => $image_name,
                ];
                $this->Post->create($form_data);
                if ($this->uploadImage($this->request->params, $this->getUniqueFileName($img_name_will_be_use, $this->request->params['form']['image']['name']))) {
                    if ($this->Post->save($this->request->data)) return $this->redirect(['action' => 'index']);
                    else return $this->redirect(['action' => 'index', 'Invalid action perform!']);
                } else {
                    return $this->redirect(['action' => 'index', 'The file is too large or invalid file format']);
                }
            }
        }
    }
    /**
     * This is used to upload image
     *
     * @param [type] $img_obj
     * @return void
     */
    public function uploadImage($img_obj, $img_name_will_be_use)
    {
        $img_name = $img_name_will_be_use;
        $img_temp = $img_obj['form']['image']['tmp_name'];
        $img_ext = substr(strrchr($img_name, "."), 1);
        $img_path = "img/blog/post/" . $img_name;
        if ($img_obj['form']['image']['name'] == '') {
            return true;
        } else {
            if (move_uploaded_file($img_temp, WWW_ROOT . $img_path)) {
                return true;
            } else {
                return false;
            }
        }
    }
    /**
     * This function create a unique name for image
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
     * This is use to share post
     *
     * @return void
     */
    public function sharePost($current_page = null)
    {
        $authenticated_user_id = $this->Auth->user('id');
        if ($this->request->is('post')) {
            $form_data = [
                'user_id' => $authenticated_user_id,
                'parent_post_id' => $this->request->data['parent_post_id'],
                'description' => $this->request->data['description']
            ];
            $this->Post->create($form_data);
            if ($this->Post->save($form_data)) {
                if ($current_page == 'Posts') {
                    $this->redirect(['action' => 'index']);
                } else {
                    $this->redirect(['controller' => 'Users', 'action' => 'profile', $authenticated_user_id]);
                }
            } else {
                $this->Flash->error(__('Oops something went wrong!!'));
            }

        }
    }
    /**
     * This post used to soft delete the post
     *
     * @return void
     */
    public function deletePost()
    {
        $authenticated_user_id = $this->Auth->user('id');
        if ($this->request->is('post')) {
            $this->Post->id = $this->Post->field('id', ['id' => $this->request->data['id'], 'user_id' => $authenticated_user_id]);
            if ($this->Post->id) {
                if ($this->Post->saveField('is_deleted', 1)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo 'invalid';
            }
        }
        $this->autoRender = false;
    }
    /**
     * This post is used to get the post information to be updated
     *
     * @return void
     */
    public function getPostInfo()
    {
        $this->autoRender = false;
        $authenticated_user_id = $this->Auth->user('id');
        $data = $this->Post->find(
            'first',
            ['conditions' => ['Post.id' => $this->request->data['id'], 'Post.user_id' => $authenticated_user_id]]
        );
        echo json_encode($data, true);
    }
    /**
     * This post is used to upload post
     *
     * @return void
     */
    public function updatePost()
    {
        $img_name_will_be_use = uniqid();
        $image = '';
        $authenticated_user_id = $this->Auth->user('id');
        if ($this->request->params['form']['image']['name'] == '') {
            $data = $this->Post->field('image', ['id' => $this->request->data['update_post_id']]);
            $image = $data;
        } else {
            if ($this->uploadImage($this->request->params, $this->getUniqueFileName($img_name_will_be_use, $this->request->params['form']['image']['name']))) {
                $image = $this->getUniqueFileName($img_name_will_be_use, $this->request->params['form']['image']['name']);
            } else {
                return $this->redirect(['action' => 'index', 'The file is too large or invalid file format']);
            }
        }
        $form_data = [
            'description' => $this->request->data['update_description'],
            'image' => $image,
        ];

        $this->Post->id = $this->Post->field('id', [
            'id' => $this->request->data['update_post_id'],
            'user_id' => $authenticated_user_id
        ]);
        if ($this->Post->id) {
            $this->Post->set($form_data);
            $this->Post->save();
            $this->redirect(['action' => 'index']);
        } else {
            return $this->redirect(['action' => 'index', 'You are not authorized to update post using other accounts credentials']);
        }
    }
}