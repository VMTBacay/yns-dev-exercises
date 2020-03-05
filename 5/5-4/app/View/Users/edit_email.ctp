<h1>Edit Email</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('email', array('label' => 'New Email'));
echo $this->Form->end('Save Email');
?>