<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Post Comments'), ['controller' => 'PostComments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Comment'), ['controller' => 'PostComments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Post Likes'), ['controller' => 'PostLikes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post Like'), ['controller' => 'PostLikes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('fullname');
            echo $this->Form->control('age');
            echo $this->Form->control('address');
            echo $this->Form->control('email');
            echo $this->Form->control('image');
            echo $this->Form->control('bio');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
