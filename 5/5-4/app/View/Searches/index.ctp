<?php
if ($type === null) {
    ?>
    <h1>Search Results</h1>
    <?php
} elseif ($type === 'users') {
    ?>
    <h1>Users Results</h1>
    <?php
} elseif ($type === 'posts') {
    ?>
    <h1>Posts Results</h1>
    <?php
}
?>

<h1>Users with "<?php echo $terms ?>" in their username</h1>
<?php
if (empty($users)) {
    echo "No users found";
}
foreach ($users as $user):
?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                echo $this->Html->image($user['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo $user['User']['username']
                ?>
            </span>
            <span>
                <?php
                if (in_array($user['User']['id'], $follows)) {
                    echo $this->Form->postlink(
                        'Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $user['User']['id'])
                    );
                } else {
                    echo $this->Form->postlink(
                        'Follow User', array('controller' => 'followers', 'action' => 'follow', $user['User']['id'])
                    );
                }
                ?>
            </span>
        </div>
    </div>
<?php 
endforeach; 
if (count($users) > 5) {
    echo $this->Form->postlink(
        'More Results', array('action' => 'index', 'users')
    );
}
?>
<br><br>

<h1>Posts with "<?php echo $terms ?>" in their title or body</h1>
<?php
if (empty($posts)) {
    echo "No posts found";
}
foreach ($posts as $post):
?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                echo $this->Html->image($post['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo $post['User']['username'] . ' says:&nbsp;';
                echo $this->Html->link($post['Post']['title'], array('controller' => 'comments', $post['Post']['id']));
                ?>
            </span>
            <span style="color: gray">
                <?php
                if (!array_key_exists('Like', $post)) {
                    echo 'Reposted on: ' . $post['Repost']['created'] . ' by ' . $post['User']['username'];
                }
                ?>
            </span>
        </div>
        <div style="margin: 10px">
            <?php echo $post['Post']['body'] ?>
        </div>
        <div style="margin: 10px; display: flex; justify-content: space-between;">
            <span style="text-align: left; color: gray">
                Posted on: <?php echo $post['Post']['created']?>
            </span>
            <span>
                <?php
                if ($this->Session->read('User.id') === $post['Post']['user_id']) {
                    echo $this->Form->postLink(
                        'Delete',
                        array('action' => 'delete', $post['Post']['id']),
                        array('confirm' => 'Are you sure?')
                    );
                    $this->Space->spaceMaker();

                    echo $this->Html->link(
                        'Edit', array('action' => 'edit', $post['Post']['id'])
                    );
                    $this->Space->spaceMaker();
                } else {
                    if (in_array($post['Post']['user_id'], $follows)) {
                        echo $this->Form->postlink(
                            'Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $post['User']['id'])
                        );
                    } else {
                        echo $this->Form->postlink(
                            'Follow User', array('controller' => 'followers', 'action' => 'follow', $post['User']['id'])
                        );
                    }
                    $this->Space->spaceMaker();
                }

                $hasLiked = false;
                $likeId = 0;
                foreach ($post['Like'] as $like) {
                    if ($like['user_id'] == $this->Session->read('User.id') && !$like['deleted']) {
                        $hasLiked = true;
                        $likeId = $like['id'];
                        break;
                    }
                }
                if ($hasLiked) {
                    echo $this->Form->postlink(
                        'Undo like', array('action' => 'undoLike', $likeId)
                    );
                } else {
                    echo $this->Form->postlink(
                        'Like', array('action' => 'like', $post['Post']['id'])
                    );
                }
                echo ' ' . count($post['Like']) . ' like(s)';
                $this->Space->spaceMaker();

                $hasReposted = false;
                $repostId = 0;
                foreach ($post['Repost'] as $repost) {
                    if ($repost['user_id'] == $this->Session->read('User.id') && !$repost['deleted']) {
                        $hasReposted = true;
                        $repostId = $repost['id'];
                        break;
                    }
                }
                if ($hasReposted) {
                    echo $this->Form->postlink(
                        'Undo repost', array('action' => 'undoRepost', $repostId)
                    );
                } else {
                    echo $this->Form->postlink(
                        'Repost', array('action' => 'repost', $post['Post']['id'])
                    );
                }
                echo ' ' . count($post['Repost']) . ' repost(s)';
                $this->Space->spaceMaker();

                echo $this->Html->link(
                    'Comment', array('controller' => 'comments', $post['Post']['id'])
                );
                echo ' ' . count($post['Comment']) . ' comment(s)';
                ?>
            </span>
        </div>
    </div>
<?php 
endforeach; 
if (count($users) > 5) {
    echo $this->Form->postlink(
        'More Results', array('action' => 'index', 'posts')
    );
}
?>