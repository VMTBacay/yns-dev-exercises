<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->fetch('title'); ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Include external files and scripts here (See HTML helper for more info.) -->
    <?php
    echo $this->Html->meta('icon');
    echo $this->HTML->css('microblog.2');
    echo $this->fetch('script');
    ?>
</head>
<body>
    <!-- If you'd like some sort of menu to
    show up on all of your views, include it here -->
    <div class="topbar">
        <div class="home">
            <?php
            echo $this->Html->link('Sign Up', array('controller' => 'users', 'action' => 'signUp'), array('style' => 'color: white;'));
            $this->Space->spaceMaker();
            echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'), array('style' => 'color: white;'))
            ?>
        </div>
    </div>
    <div id="content">
        <!-- Here's where I want my views to be displayed -->
        <?php echo $this->Flash->render();?>
        <?php echo $this->fetch('content'); ?>
    </div>
</body>
</html>