<div class="sulibox">
    <div style="margin: 4px; text-align: center; font-size: 20px">
        microblog.<br>
        it's a blog. but micro.
    </div>
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('username'). '<br>';
    echo $this->Form->input('password');
    echo $this->Form->input('repass', array('label' => 'Re-Enter Password', 'type' => 'password')) . '<br>';
    echo $this->Form->input('email');
    echo $this->Form->end('Sign up');
    ?>

    <div style="margin: 8px;">
    <?php echo $this->Html->link('Login', array('action' => 'login')); ?>
    </div>
</div>