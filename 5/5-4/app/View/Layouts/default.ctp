<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->fetch('title'); ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script src="/js/jquery-3.4.1.js"></script>
    <?php
    echo $this->Html->meta('icon');
    echo $this->HTML->css('microblog.2');
    ?>
</head>
<body>
    <div class="topbar">
        <span class="home">
            <?php echo $this->Html->link('Home', array('controller' => 'posts', 'action' => 'index'), array('style' => 'color: white;')); ?>
        </span>
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
        echo $this->Html->link(
            $user['username'], array(
                'controller' => 'posts', 'action' => 'index', $user['id'], null), array('style' => 'color: white; font-size: 15px'
            )
        );
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
                echo $this->Form->postlink('Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $user['id']));
            } else {
                echo $this->Form->postlink('Follow User', array('controller' => 'followers', 'action' => 'follow', $user['id']));
            }
        }
        ?>
    </div>
    <div id="content" style="margin-left: 190px;">
        <?php
        if ($this->Session->read('Message.flash')) {
            $_SESSION['Message']['flash'] = array_unique($this->Session->read('Message.flash'), SORT_REGULAR);
        }
        echo $this->Flash->render();
        echo $this->fetch('content');
        ?>
    </div>
</body>
<script type="text/javascript">
    function unlike(me) {
        $.post("<?php echo Router::url(array('controller'=>'posts','action'=>'unlike')); ?>/" + me.attr("id"));
        me.attr('class', 'like link');
        me.html("Like");
        $("#likeCount-" + me.attr("id")).html(parseInt($("#likeCount-" + me.attr("id")).html() - 1));
        me.unbind('click');
        me.click(function() {
            like($(this));
        });
    }

    function like(me) {
        $.post("<?php echo Router::url(array('controller'=>'posts','action'=>'like')); ?>/" + me.attr("id"));
        me.attr('class', 'unlike link');
        me.html("Unlike");
        $("#likeCount-" + me.attr("id")).html(parseInt($("#likeCount-" + me.attr("id")).html() + 1));
        me.unbind('click');
        me.click(function() {
            unlike($(this));
        });
    }

    function unrepost(me) {
        $.post("<?php echo Router::url(array('controller'=>'posts','action'=>'unrepost')); ?>/" + me.attr("id"));
        me.attr('class', 'repost link');
        me.html("Repost");
        $("#repostCount-" + me.attr("id")).html(parseInt($("#repostCount-" + me.attr("id")).html() - 1));
        me.unbind('click');
        me.click(function() {
            repost($(this));
        });
    }

    function repost(me) {
        $.post("<?php echo Router::url(array('controller'=>'posts','action'=>'repost')); ?>/" + me.attr("id"));
        me.attr('class', 'unrepost link');
        me.html("Unrepost");
        $("#repostCount-" + me.attr("id")).html(parseInt($("#repostCount-" + me.attr("id")).html() + 1));
        me.unbind('click');
        me.click(function() {
            unrepost($(this));
        });
    }

    $(".unlike").click(function() {
        unlike($(this));
    });
    $(".like").click(function(){
        like($(this));
    });
    $(".unrepost").click(function() {
        unrepost($(this));
    });
    $(".repost").click(function(){
        repost($(this));
    });

    document.getElementsByClassName('sidebar')[0].style.height = (document.body.scrollHeight - 100) + 'px';
</script>
</html>