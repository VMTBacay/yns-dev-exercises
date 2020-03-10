<?php 
// pr($data);
$user = $this->Session->read('Auth.User');
for ($i = 0; $i < count($data); $i++) { ?>
        <tr>
            <td><img src="/app/webroot/img/blog/<?= h($data[$i]['User']['image']) ?>" width="50"></td>
            <td><a class="text-dark" href="/users/profile/<?= $data[$i]['User']['id'] ?>"><?= h($data[$i]['User']['fullname']) ?></a></td>
            <td><?= date('F, Y', strtotime($data[$i]['User']['created'])); ?></td>
            <td><?= h($data[$i]['User']['email']) ?></td>
        <br>
            <?php 
            $user = $this->Session->read('Auth.User');
            $already_followed = true;
            for ($j = 0; $j < count($data[$i]['Followers']); $j++) {
                if ($data[$i]['Followers'][$j]['is_deleted'] == 0 && $user['id'] == $data[$i]['Followers'][$j]['user_id_from']) {
                    $already_followed = false;
                }
            }
            if (($already_followed)) { ?>
            <!-- followed -->
            <td>
                <?= $this->Form->create('Post', array(
                    'url' => array('controller' => 'Followers', 'action' => 'followUser'),
                    'type' => 'post'
                )); ?>

                <?= $this->Form->input('user_id_to', array(
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'label' => '',
                    'name' => 'user_id_to',
                    'value' => $data[$i]['User']['id']
                )); ?>
                <button type="submit" class="btn btn-secondary btn-outline">
                    <i class="icon-user-follow"></i>
                    <span class="text">Follow</span>
                </button>
                <?= $this->Form->end(); ?>
            </td>
            <!-- end followed -->
            <?php 
        }
        if (!($already_followed)) { ?>
            <!-- already followed -->
            <td>
                <!-- <span class="badge badge-success">Already Followed</span> -->
                <?= $this->Form->create('Post', array(
                    'url' => array('controller' => 'Followers', 'action' => 'unFollowUser'),
                    'type' => 'post'
                )); ?>

                <?= $this->Form->input('user_id_to', array(
                    'type' => 'hidden',
                    'class' => 'form-control',
                    'label' => '',
                    'name' => 'user_id_to',
                    'value' => $data[$i]['User']['id']
                )); ?>
                    <button type="submit" class="btn btn-secondary btn-outline">
                        <i class="icon-user-unfollow"></i>
                        <span class="text">unFollow</span>
                    </button>
                <?= $this->Form->end(); ?>
            </td>
            <!-- end already followed -->
            <?php 
        } ?>
        </tr>
<?php 
} ?>