<h1>Edit Username</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('oldpass', array('label' => 'Old Password', 'type' => 'password'));
echo '<br>';
echo $this->Form->input('password', array('label' => 'New Password'));
echo $this->Form->input('repass', array('label' => 'Re-enter New Password', 'type' => 'password'));
echo $this->Form->end('Save Password');
?>