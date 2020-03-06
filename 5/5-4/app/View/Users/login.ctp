<div class="sulibox">
    <div style="margin: 4px; text-align: center; font-size: 20px">
        microblog.<br>
        it's a blog. but micro.
    </div>
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->end('Login');
    ?>

    <div style="margin: 8px;">
    <?php echo $this->Html->Link('Sign up', array('action' => 'signup')); ?>
    </div>
</div>