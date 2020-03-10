<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Comments'), ['controller' => 'PostComments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Comment'), ['controller' => 'PostComments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Post Likes'), ['controller' => 'PostLikes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post Like'), ['controller' => 'PostLikes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Change Password Activation') ?></th>
            <td><?= h($user->change_password_activation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password To Be Use') ?></th>
            <td><?= h($user->password_to_be_use) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fullname') ?></th>
            <td><?= h($user->fullname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bio') ?></th>
            <td><?= h($user->bio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activation Code') ?></th>
            <td><?= h($user->activation_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Age') ?></th>
            <td><?= $this->Number->format($user->age) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activated') ?></th>
            <td><?= $this->Number->format($user->activated) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Image') ?></h4>
        <?= $this->Text->autoParagraph(h($user->image)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Post Comments') ?></h4>
        <?php if (!empty($user->post_comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Post Id') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->post_comments as $postComments): ?>
            <tr>
                <td><?= h($postComments->id) ?></td>
                <td><?= h($postComments->description) ?></td>
                <td><?= h($postComments->user_id) ?></td>
                <td><?= h($postComments->post_id) ?></td>
                <td><?= h($postComments->is_deleted) ?></td>
                <td><?= h($postComments->modified) ?></td>
                <td><?= h($postComments->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PostComments', 'action' => 'view', $postComments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PostComments', 'action' => 'edit', $postComments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PostComments', 'action' => 'delete', $postComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postComments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Post Likes') ?></h4>
        <?php if (!empty($user->post_likes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Unique') ?></th>
                <th scope="col"><?= __('Post Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->post_likes as $postLikes): ?>
            <tr>
                <td><?= h($postLikes->id) ?></td>
                <td><?= h($postLikes->unique) ?></td>
                <td><?= h($postLikes->post_id) ?></td>
                <td><?= h($postLikes->user_id) ?></td>
                <td><?= h($postLikes->is_deleted) ?></td>
                <td><?= h($postLikes->modified) ?></td>
                <td><?= h($postLikes->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'PostLikes', 'action' => 'view', $postLikes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'PostLikes', 'action' => 'edit', $postLikes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'PostLikes', 'action' => 'delete', $postLikes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $postLikes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Posts') ?></h4>
        <?php if (!empty($user->posts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Parent Post Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Is Deleted') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->posts as $posts): ?>
            <tr>
                <td><?= h($posts->id) ?></td>
                <td><?= h($posts->user_id) ?></td>
                <td><?= h($posts->parent_post_id) ?></td>
                <td><?= h($posts->description) ?></td>
                <td><?= h($posts->image) ?></td>
                <td><?= h($posts->is_deleted) ?></td>
                <td><?= h($posts->modified) ?></td>
                <td><?= h($posts->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
