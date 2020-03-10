<?php

Router::connect('/', array('controller' => 'Users', 'action' => 'login'));
Router::connect('/users/register', array('controller' => 'Users', 'action' => 'register'));
Router::connect('/home', array('controller' => 'Home', 'action' => 'index'));
Router::connect('/delete-post', array('controller' => 'Posts', 'action' => 'deletePost'));
Router::connect('/add-comment', array('controller' => 'PostComments', 'action' => 'addComment'));
Router::connect('/show-comment', array('controller' => 'PostComments', 'action' => 'showComment'));
Router::connect('/share-post', array('controller' => 'Posts', 'action' => 'sharePost'));
Router::connect('/like-post', array('controller' => 'PostLikes', 'action' => 'like'));
Router::connect('/unlike-post', array('controller' => 'PostLikes', 'action' => 'unlike'));
Router::connect('/count-post-like', array('controller' => 'PostLikes', 'action' => 'countlike'));
Router::connect('/forbidden', array('controller' => 'Posts', 'action' => 'forbidden'));
Router::connect('/get-post-info', array('controller' => 'Posts', 'action' => 'getPostInfo'));
Router::connect('/count-comment', array('controller' => 'PostComments', 'action' => 'countComment'));
CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';