<h1>Post Search Results</h1>

<h1>Posts with "<?php echo h($terms) ?>" in their title or body</h1>
<?php
foreach ($posts as $post):
?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                echo $this->Html->image($post['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo h($post['User']['username']) . ' says:&nbsp;';
                echo $this->Html->link($post['Post']['title'], array('controller' => 'comments', $post['Post']['id']));
                ?>
            </span>
            <span style="color: gray">
                <?php
                if (!array_key_exists('Like', $post)) {
                    echo 'Reposted on: ' . h($post['Repost']['created']) . ' by ' . h($post['User']['username']);
                }
                ?>
            </span>
        </div>
        <div style="margin: 10px">
            <?php
            echo h($post['Post']['body']) . '<br>';
            echo $this->Html->image($post['Post']['image'], array('style' => 'height: 100px;'));
            ?>
        </div>
        <div style="margin: 10px; display: flex; justify-content: space-between;">
            <span style="text-align: left; color: gray">
                Posted on: <?php echo h($post['Post']['created']) ?>
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
<?php endforeach; ?>
<div style="text-align: center;">
    <?php
    if ($this->Paginator->first()) {
        echo $this->Paginator->first() . ' ';
        echo $this->Paginator->prev();
        $this->Space->spaceMaker();
    }

    if ($this->Paginator->last()) {
        echo $this->Paginator->next() . ' ';
        echo $this->Paginator->last();
    }
    ?>
</div>