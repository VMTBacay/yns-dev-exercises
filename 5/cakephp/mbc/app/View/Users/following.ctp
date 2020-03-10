<?php 
// pr($data);
$authenticate_user = $this->Session->read('Auth.User');
for ($i = 0; $i < count($data['user_information']); $i++) { ?>
    <?php if (1) {
    } ?>
        <tr>
            <td><img src="/app/webroot/img/blog/<?= $data['user_information'][$i]['detail']['image'] ?>" width="50"></td>
            <td><a class="text-dark" href="/users/profile/<?= $data['user_information'][$i]['detail']['id'] ?>"><?= h($data['user_information'][$i]['detail']['fullname']) ?></a></td>
            <td><?= date('F, Y', strtotime($data['user_information'][$i]['detail']['created'])); ?></td>
            <td><?= h($data['user_information'][$i]['detail']['email']) ?></td>

            <td>
                <?= $this->Form->create('Post', array(
                    'url' => array('controller' => 'Followers', 'action' => 'unFollowUser'),
                    'type' => 'post'
                )); ?>

                <?= $this->Form->input('user_id_to', array(
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'label' => '',
                    'name' => 'user_id_to',
                    'value' => $data['user_information'][$i]['detail']['id']
                )); ?>
                <?php if ($authenticate_user['id'] == $current_user) { ?>
                    <button type="submit" class="btn btn-secondary btn-outline">
                        <i class="icon-user-unfollow"></i>
                        <span class="text">unFollow</span>
                    </button>
                <?php 
            } ?>
                <?= $this->Form->end(); ?>
            </td>            
        </tr>
<?php 
} ?>