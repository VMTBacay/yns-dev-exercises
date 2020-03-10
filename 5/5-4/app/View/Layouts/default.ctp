<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->fetch('title'); ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <?php
    echo $this->Html->meta('icon');
    echo $this->HTML->css('microblog2');
    ?>
</head>
<body>
    <div class="topbar">
        <span class="home"><?php echo $this->Html->link('Home', array('controller' => 'posts', 'action' => 'index'), array('style' => 'color: white;')); ?></span>
        <span style="float: right;">
            <table style="border-collapse: collapse; border-style: hidden;">
                <?php
                echo $this->Form->create(
                    'Search', array('url' => array('controller' => 'searches', 'action' => 'index'), 'type' => 'get')
                );
                ?>
                <tr>
                    <td><?php echo $this->Form->input('terms', array('label' => '', 'type' => 'text', 'style' => 'width: 200px')); ?></td>
                    <td><?php echo $this->Form->end('Search'); ?></td>
                    <td>
                        <?php
                        echo $this->Html->link(
                            'Log out', array('controller' => 'posts', 'action' => 'logout'), array('style' => 'color: white')
                        );
                        ?>
                    </td>
                </tr>
            </table>
        </span>
    </div>
    <div class="sidebar">
        <?php
        $user = isset($viewUser) ? $viewUser : $this->Session->read('user');
        echo $this->Html->image($user['profile_pic'], array('height' => '150px', 'width' => '150px'));
        echo $this->Html->link($user['username'], array('controller' => 'posts', 'action' => 'index', $user['id'], null), array('style' => 'color: white; font-size: 15px'));
        echo $this->Html->link('User\'s Posts', array('controller' => 'posts', 'action' => 'index', $user['id'], 1));
        echo $this->Html->link('Following', array('controller' => 'followers', 'action' => 'following', $user['id']));
        echo $this->Html->link('Followers', array('controller' => 'followers', 'action' => 'index', $user['id']));
        if ($this->Session->read('user.id') === $user['id']) {
            echo $this->Html->link('Edit Username', array('controller' => 'users', 'action' => 'editUsername'));
            echo $this->Html->link('Edit Password', array('controller' => 'users', 'action' => 'editPassword'));
            echo $this->Html->link('Edit Email', array('controller' => 'users', 'action' => 'editEmail'));
            echo $this->Html->link('Edit Profile Picture', array('controller' => 'users', 'action' => 'editProfilePic'));
        } else {
            if (in_array($user['id'], $this->Session->read('user.follows'))) {
                echo $this->Form->postlink(
                    'Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $user['id'])
                );
            } else {
                echo $this->Form->postlink(
                    'Follow User', array('controller' => 'followers', 'action' => 'follow', $user['id'])
                );
            }
        }
        ?>
    </div>
    <div id="content" style="margin-left: 190px;">
        <?php echo $this->Flash->render();?>
        <?php echo $this->fetch('content'); ?>
    </div>
</body>
<script type="text/javascript">
    document.getElementsByClassName('sidebar')[0].style.height = (document.body.scrollHeight - 100) + 'px';
</script>
</html>