<h1>Search Results</h1>
<h1>Users with "<?php echo h($terms) ?>" in their username</h1>
<?php
define('RESULTS_LIMIT', 2);

if (empty($users)) {
    echo "No users found";
}
for ($i = 0; $i < min(RESULTS_LIMIT, count($users)); $i++):
?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                echo $this->Html->image($users[$i]['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo h($users[$i]['User']['username']);
                ?>
            </span>
            <span>
                <?php
                if (in_array($users[$i]['User']['id'], $follows)) {
                    echo $this->Form->postlink(
                        'Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $users[$i]['User']['id'])
                    );
                } else {
                    echo $this->Form->postlink(
                        'Follow User', array('controller' => 'followers', 'action' => 'follow', $users[$i]['User']['id'])
                    );
                }
                ?>
            </span>
        </div>
    </div>
<?php 
endfor; 
if (count($users) > 3) {
    echo $this->Html->link('More user results', $this->Html->url(array(
        'controller' => 'searches',
        'action' => 'users',
        "?" => array('terms' => $terms)
    )));
}
?>
<br><br>

<h1>Posts with "<?php echo h($terms) ?>" in their title or body</h1>
<?php
if (empty($posts)) {
    echo 'No posts found';
}
for ($i = 0; $i < min(RESULTS_LIMIT, count($posts)); $i++):
?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                echo $this->Html->image($posts[$i]['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo h($posts[$i]['User']['username']) . ' says:&nbsp;';
                echo $this->Html->link($posts[$i]['Post']['title'], array('controller' => 'comments', $posts[$i]['Post']['id']));
                ?>
            </span>
            <span style="color: gray">
                <?php
                if (!array_key_exists('Like', $posts[$i])) {
                    echo 'Reposted on: ' . h($posts[$i]['Repost']['created']) . ' by ' . h($posts[$i]['User']['username']);
                }
                ?>
            </span>
        </div>
        <div style="margin: 10px">
            <?php
            echo h($posts[$i]['Post']['body']) . '<br>';
            echo $this->Html->image($posts[$i]['Post']['image'], array('style' => 'height: 100px;'));
            ?>
        </div>
        <div style="margin: 10px; display: flex; justify-content: space-between;">
            <span style="text-align: left; color: gray">
                Posted on: <?php echo h($posts[$i]['Post']['created']) ?>
            </span>
            <span>
                <?php
                if ($this->Session->read('User.id') === $posts[$i]['Post']['user_id']) {
                    echo $this->Form->postLink(
                        'Delete',
                        array('action' => 'delete', $posts[$i]['Post']['id']),
                        array('confirm' => 'Are you sure?')
                    );
                    $this->Space->spaceMaker();

                    echo $this->Html->link(
                        'Edit', array('action' => 'edit', $posts[$i]['Post']['id'])
                    );
                    $this->Space->spaceMaker();
                } else {
                    if (in_array($posts[$i]['Post']['user_id'], $follows)) {
                        echo $this->Form->postlink(
                            'Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $posts[$i]['User']['id'])
                        );
                    } else {
                        echo $this->Form->postlink(
                            'Follow User', array('controller' => 'followers', 'action' => 'follow', $posts[$i]['User']['id'])
                        );
                    }
                    $this->Space->spaceMaker();
                }

                $hasLiked = false;
                $likeId = 0;
                foreach ($posts[$i]['Like'] as $like) {
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
                        'Like', array('action' => 'like', $posts[$i]['Post']['id'])
                    );
                }
                echo ' ' . count($posts[$i]['Like']) . ' like(s)';
                $this->Space->spaceMaker();

                $hasReposted = false;
                $repostId = 0;
                foreach ($posts[$i]['Repost'] as $repost) {
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
                        'Repost', array('action' => 'repost', $posts[$i]['Post']['id'])
                    );
                }
                echo ' ' . count($posts[$i]['Repost']) . ' repost(s)';
                $this->Space->spaceMaker();

                echo $this->Html->link(
                    'Comment', array('controller' => 'comments', $posts[$i]['Post']['id'])
                );
                echo ' ' . count($posts[$i]['Comment']) . ' comment(s)';
                ?>
            </span>
        </div>
    </div>
<?php 
endfor; 
if (count($posts) > 3) {
    echo $this->Html->link('More post results', $this->Html->url(array(
        'controller' => 'searches',
        'action' => 'posts',
        '?' => array('terms' => $terms)
    )));
}
?>