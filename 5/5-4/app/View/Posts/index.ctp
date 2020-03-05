<h1>Add Post</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file', 'url' => array('action' => 'add')));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->file('Post.pic');
echo $this->Form->end('Save Post');

$allPosts = array_merge($posts, $reposts);
usort($allPosts, function($b, $a) {
    $x = !array_key_exists('Like', $a) ? 'Repost' : 'Post';
    $y = !array_key_exists('Like', $b) ? 'Repost' : 'Post';
     return strtotime($a[$x]['created']) - strtotime($b[$y]['created']);
});

define('PAGE_LIMIT', 5);
$postCount = count($allPosts);
$pages = ceil($postCount / PAGE_LIMIT);
$page = min($pages, array_key_exists('page', $this->params['url']) ? $this->params['url']['page'] : 1);
$offset = ($page - 1)  * PAGE_LIMIT;
$end = min(($offset + PAGE_LIMIT), $postCount);
?>

<h1><?php echo $userOnly === null ? 'Posts' : 'Your Posts' ?></h1>
<?php for ($i = $offset; $i < $end; $i++): ?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                $post = $allPosts[$i];

                if (!array_key_exists('Like', $post)) {
                    foreach ($repostPosts as $repostPost) {
                        if ($repostPost['Post']['id'] === $post['Post']['id']) {
                            $post = $repostPost;
                        }
                    }
                }

                echo $this->Html->image($post['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo h($post['User']['username']) . ' says:&nbsp;';
                echo $this->Html->link($post['Post']['title'], array('controller' => 'comments', $post['Post']['id']));
                ?>
            </span>
            <span style="color: gray">
                <?php
                if (!array_key_exists('Like', $allPosts[$i])) {
                    echo 'Reposted on: ' . h($allPosts[$i]['Repost']['created']) . ' by ' . h($allPosts[$i]['User']['username']);
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
<?php endfor; ?>

<div style="text-align: center;">
    <?php
    if ($page != 1) {
        echo $this->Html->link('<<first', $this->Html->url(array(
            'controller' => 'posts',
            'action' => 'index',
            "?" => array('page' => 1)
        )));
        echo  ' ';
        echo $this->Html->link('<<Previous', $this->Html->url(array(
            'controller' => 'posts',
            'action' => 'index',
            "?" => array('page' => $page - 1)
        )));
        $this->Space->spaceMaker();
    }

    if ($page != $pages) {
        echo $this->Html->link('Next>>', $this->Html->url(array(
            'controller' => 'posts',
            'action' => 'index',
            "?" => array('page' => $page + 1)
        )));
        echo ' ';
        echo $this->Html->link('last>>', $this->Html->url(array(
            'controller' => 'posts',
            'action' => 'index',
            "?" => array('page' => $pages)
        )));
    }
    ?>
</div>