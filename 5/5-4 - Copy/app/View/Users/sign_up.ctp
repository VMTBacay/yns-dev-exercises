<div class="sulibox">
    microblog.<br>
    it's a blog. but micro.
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->input('repass', array('label' => 'Re-Enter Password'));
    echo $this->Form->input('email');
    echo $this->Form->end('Sign up');
    ?>
</div>