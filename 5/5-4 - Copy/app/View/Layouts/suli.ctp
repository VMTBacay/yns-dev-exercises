<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->fetch('title'); ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Include external files and scripts here (See HTML helper for more info.) -->
    <?php
    echo $this->Html->meta('icon');
    echo $this->HTML->css('microblog.default');
    echo $this->fetch('script');
    ?>
</head>
<body>
    <!-- If you'd like some sort of menu to
    show up on all of your views, include it here -->
    <div class="topbar">
        <?php
        if ($this->Session->read('User.id') !== null) {
            ?>
            Home <span style="float: right;">Search <?php echo $this->Html->link('Log out', array('action' => 'logout'), array('style' => 'color: white')) ?></span>
            <?php
        }
        ?>
    </div>
    <div id="content">
        <!-- Here's where I want my views to be displayed -->
        <?php echo $this->fetch('content'); ?>
    </div>
</body>
</html>