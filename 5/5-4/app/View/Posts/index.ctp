<h1>Posts</h1>
<p><?php echo $this->Html->link('Add Post', array('action' => 'add'));?></p>
<?php
$allPosts = array_merge($posts, $reposts);
usort($allPosts, function($b, $a) {
    $x = array_key_exists('Repost', $a) ? 'Repost' : 'Post';
    $y = array_key_exists('Repost', $b) ? 'Repost' : 'Post';
     return strtotime($a[$x]['created']) - strtotime($b[$y]['created']);
});
?>

<?php foreach ($allPosts as $post): ?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                echo '<img src="img/' . $post['User']['profile_pic'] . '" height="50px" width="50px">';
                $this->Space->spaceMaker();
                echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));
                ?>
            </span>
            <span style="color: gray">
                <?php
                if (array_key_exists('Repost', $post)) {
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

                $ogPost = $post;
                if (array_key_exists('Repost', $post)) {
                    foreach ($posts as $p) {
                        if ($p['Post']['id'] === $post['Post']['id']) {
                            $ogPost = $p;
                        }
                    }
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
                        'Like', array('action' => 'like', $post['Post']['id'])
                    );
                }
                
                $this->Space->spaceMaker();

                if (array_key_exists('Repost', $post)) {
                    echo $this->Form->postlink(
                        'Undo repost', array('action' => 'undoRepost', $post['Repost']['id'])
                    );
                } else {
                    echo $this->Form->postlink(
                        'Repost', array('action' => 'repost', $post['Post']['id'])
                    );
                }
                $this->Space->spaceMaker();

                echo $this->Html->link(
                    'Comment', array('action' => 'comment', $post['Post']['id'])
                );
                $this->Space->spaceMaker();

                echo $this->Form->postlink(
                    'Follow', array('action' => 'follow', $post['Post']['id'])
                );
                ?>
            </span>
        </div>
    </div>
<?php endforeach; ?>