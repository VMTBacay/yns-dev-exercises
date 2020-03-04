<?php
if ($userOnly !== null) {
    ?>
    <h1>Your Posts</h1>
    <?php
} else {
    ?>
    <h1>Posts</h1>
    <p><?php echo $this->Html->link('Add Post', array('action' => 'add'));?></p>
    <?php
}

$allPosts = array_merge($posts, $reposts);
usort($allPosts, function($b, $a) {
    $x = !array_key_exists('Like', $a) ? 'Repost' : 'Post';
    $y = !array_key_exists('Like', $b) ? 'Repost' : 'Post';
     return strtotime($a[$x]['created']) - strtotime($b[$y]['created']);
});

foreach ($allPosts as $post): 
?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                $ogPost = $post;
                if (!array_key_exists('Like', $post)) {
                    foreach ($repostPosts as $p) {
                        if ($p['Post']['id'] === $post['Post']['id']) {
                            $ogPost = $p;
                        }
                    }
                }

                echo $this->Html->image($ogPost['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo $ogPost['User']['username'] . ' says:&nbsp;';
                echo $this->Html->link($ogPost['Post']['title'], array('controller' => 'comments', $ogPost['Post']['id']));
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
                if ($this->Session->read('User.id') === $ogPost['Post']['user_id']) {
                    echo $this->Form->postLink(
                        'Delete',
                        array('action' => 'delete', $ogPost['Post']['id']),
                        array('confirm' => 'Are you sure?')
                    );
                    $this->Space->spaceMaker();

                    echo $this->Html->link(
                        'Edit', array('action' => 'edit', $ogPost['Post']['id'])
                    );
                    $this->Space->spaceMaker();
                } else {
                    if (in_array($ogPost['Post']['user_id'], $follows)) {
                        echo $this->Form->postlink(
                            'Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $ogPost['User']['id'])
                        );
                    } else {
                        echo $this->Form->postlink(
                            'Follow User', array('controller' => 'followers', 'action' => 'follow', $ogPost['User']['id'])
                        );
                    }
                    $this->Space->spaceMaker();
                }

                $hasLiked = false;
                $likeId = 0;
                foreach ($ogPost['Like'] as $like) {
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
                        'Like', array('action' => 'like', $ogPost['Post']['id'])
                    );
                }
                echo ' ' . count($ogPost['Like']) . ' like(s)';
                $this->Space->spaceMaker();

                $hasReposted = false;
                $repostId = 0;
                foreach ($ogPost['Repost'] as $repost) {
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
                        'Repost', array('action' => 'repost', $ogPost['Post']['id'])
                    );
                }
                echo ' ' . count($ogPost['Repost']) . ' repost(s)';
                $this->Space->spaceMaker();

                echo $this->Html->link(
                    'Comment', array('controller' => 'comments', $ogPost['Post']['id'])
                );
                echo ' ' . count($ogPost['Comment']) . ' comment(s)';
                ?>
            </span>
        </div>
    </div>
<?php endforeach; ?>