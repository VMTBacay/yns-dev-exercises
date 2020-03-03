<h1>Edit Username</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('username', array('label' => 'New Username'));
echo $this->Form->end('Save Username');
?>