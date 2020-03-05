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
                <?php echo $this->Form->create('Search', array('url' => array('controller' => 'searches', 'action' => 'index'), 'type' => 'get')); ?>
                <tr>
                    <td><?php echo $this->Form->input('terms', array('label' => '', 'type' => 'text', 'style' => 'width: 200px')); ?></td>
                    <td><?php echo $this->Form->end('Search'); ?></td>
                    <td><?php echo $this->Html->link('Log out', array('controller' => 'posts', 'action' => 'logout'), array('style' => 'color: white')); ?></td>
                </tr>
            </table>
        </span>
    </div>
    <div class="sidebar">
        <?php
        echo $this->Html->image($this->Session->read('User.profile_pic'), array('height' => '150px', 'width' => '150px'));
        echo $this->Session->read('User.username');
        echo $this->Html->link('Your Posts', array('controller' => 'posts', 'action' => 'index', 1));
        echo $this->Html->link('Following', array('controller' => 'followers', 'action' => 'following'));
        echo $this->Html->link('Followers', array('controller' => 'followers', 'action' => 'index'));
        echo $this->Html->link('Edit Username', array('controller' => 'users', 'action' => 'editUsername'));
        echo $this->Html->link('Edit Password', array('controller' => 'users', 'action' => 'editPassword'));
        echo $this->Html->link('Edit Email', array('controller' => 'users', 'action' => 'editEmail'));
        echo $this->Html->link('Edit Profile Picture', array('controller' => 'users', 'action' => 'editProfilePic'));
        ?>
    </div>
    <div id="content" style="margin-left: 160px;">
        <?php echo $this->Flash->render();?>
        <?php echo $this->fetch('content'); ?>
    </div>
</body>
<script type="text/javascript">
        document.getElementsByClassName('sidebar')[0].style.height = (document.body.scrollHeight - 80) + 'px';
</script>
</html>