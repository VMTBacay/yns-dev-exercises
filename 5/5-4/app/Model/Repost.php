<?php
class Repost extends AppModel {
    public $belongsTo = array('User', 'Post');
}