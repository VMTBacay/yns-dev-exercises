<h1>Edit Username</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('oldpass', array('label' => 'Old Password'));
?>
<br>
<?php
echo $this->Form->input('password', array('label' => 'New Password'));
echo $this->Form->input('repass', array('label' => 'Re-enter New Password'));
echo $this->Form->end('Save Password');
?>