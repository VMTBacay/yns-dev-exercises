<!-- File: /app/View/Posts/edit.ctp -->

<h1>Edit Comment</h1>
<?php
echo $this->Form->create('Comment');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Comment');
?>