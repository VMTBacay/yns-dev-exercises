<div class="sulibox">
    microblog.<br>
    it's a blog. but micro.
    <?php
    echo $this->Form->create('User');
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->end('Login');
    ?>
</div>