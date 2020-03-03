<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->fetch('title'); ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <?php
    echo $this->Html->meta('icon');
    echo $this->HTML->css('hello.world');
    ?>
</head>
<body>
    <div class="topbar">
       <span class="home"><?php echo $this->Html->link('Home', array('action' => 'index'), array('style' => 'color: white;')); ?></span> 
        <span style="float: right;">
            <table style="border-collapse: collapse; border-style: hidden;">
                <?php echo $this->Form->create('Search'); ?>
                <tr>
                    <td><?php echo $this->Form->input('terms', array('label' => '', 'type' => 'text', 'style' => 'width: 200px')); ?></td>
                    <td><?php echo $this->Form->end('Search'); ?></td>
                    <td><?php echo $this->Html->link('Log out', array('action' => 'logout'), array('style' => 'color: white')); ?></td>
                </tr>
            </table>
        </span>
    </div>
    <div class="sidebar">
        <?php echo $this->Html->image($this->Session->read('User.profile_pic')) ?>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
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