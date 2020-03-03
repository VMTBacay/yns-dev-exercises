<h1>Edit Profile Picture</h1>
<?php
echo $this->Form->create('User', array('type' => 'file'));
echo $this->Form->file('User.pic');
echo $this->Form->end('Upload Profile Picture');
?>