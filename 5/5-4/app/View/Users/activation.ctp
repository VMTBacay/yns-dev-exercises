<div class="sulibox">
    <div style="margin: 10px;">
        An activation code has been sent to your email.<br>
        Enter it to activate your account.
        <?php
        echo $this->Form->create('User');
        echo $this->Form->input('code');
        echo $this->Form->end(array('label' => 'Activate', 'name' => 'activate'));
        if (isset($this->validationErrors['User']['activation_code_date'][0])) {
            echo $this->validationErrors['User']['activation_code_date'][0];
         }
        echo $this->Html->link('Resend code', array('action' => 'activation', $id, 1));
        ?>
    </div>
</div>