<?php
class PutterHelper extends AppHelper {
    public $helpers = array('Html', 'Form', 'Flash', 'Space', 'Session');

    public function putUser($user) {
    ?>
        <div style="border-style: solid;">
            <div style="margin: 10px; display : flex; justify-content: space-between;">
                <span style="display: inline-flex; align-items: center;">
                    <?php
                    echo $this->Html->image($user['profile_pic'], array('height' => '50', 'width' => '50'));
                    $this->Space->spaceMaker();
                    echo $this->Html->link($user['username'], array('controller' => 'posts', 'action' => 'index', $user['id'], null));
                    ?>
                </span>
                <span>
                    <?php
                    if ($user['id'] !== $this->Session->read('user.id')) {
                        if (in_array($user['id'], $this->Session->read('user.follows'))) {
                            echo $this->Form->postlink(
                                'Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $user['id'])
                            );
                        } else {
                            echo $this->Form->postlink(
                                'Follow User', array('controller' => 'followers', 'action' => 'follow', $user['id'])
                            );
                        }
                    }
                    ?>
                </span>
            </div>
        </div>
    <?php
    }

    public function putPost($ogPost, $follows, $repostPosts = null) {
    ?>
        <div style="border-style: solid;">
            <div style="margin: 10px; display : flex; justify-content: space-between;">
                <span style="display: inline-flex; align-items: center;">
                    <?php
                    $post = $ogPost;

                    if (!array_key_exists('Like', $post)) {
                        foreach ($repostPosts as $repostPost) {
                            if ($repostPost['Post']['id'] === $post['Post']['id']) {
                                $post = $repostPost;
                            }
                        }
                    }

                    echo $this->Html->image($post['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                    $this->Space->spaceMaker();
                    echo $this->Html->link($post['User']['username'], array('controller' => 'posts', 'action' => 'index', $post['User']['id'], null)) . '&nbsp;says:&nbsp;';
                    echo $this->Html->link($post['Post']['title'], array('controller' => 'comments', $post['Post']['id']));
                    ?>
                </span>
                <span style="color: gray">
                    <?php
                    if (!array_key_exists('Like', $ogPost)) {
                        echo 'Reposted on: ' . h($ogPost['Repost']['created']) . ' by ' . h($ogPost['User']['username']);
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
                    if ($this->Session->read('user.id') === $post['Post']['user_id']) {
                        echo $this->Form->postLink(
                            'Delete',
                            array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']),
                            array('confirm' => 'Are you sure?')
                        );
                        $this->Space->spaceMaker();

                        echo $this->Html->link(
                            'Edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])
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
                        if ($like['user_id'] == $this->Session->read('user.id') && !$like['deleted']) {
                            $hasLiked = true;
                            $likeId = $like['id'];
                            break;
                        }
                    }
                    if ($hasLiked) {
                        echo $this->Form->postlink(
                            'Undo like', array('controller' => 'posts', 'action' => 'undoLike', $likeId)
                        );
                    } else {
                        echo $this->Form->postlink(
                            'Like', array('controller' => 'posts', 'action' => 'like', $post['Post']['id'])
                        );
                    }
                    echo ' ' . count($post['Like']) . ' like(s)';
                    $this->Space->spaceMaker();

                    $hasReposted = false;
                    $repostId = 0;
                    foreach ($post['Repost'] as $repost) {
                        if ($repost['user_id'] == $this->Session->read('user.id') && !$repost['deleted']) {
                            $hasReposted = true;
                            $repostId = $repost['id'];
                            break;
                        }
                    }
                    if ($hasReposted) {
                        echo $this->Form->postlink(
                            'Undo repost', array('controller' => 'posts', 'action' => 'undoRepost', $repostId)
                        );
                    } else {
                        echo $this->Form->postlink(
                            'Repost', array('controller' => 'posts', 'action' => 'repost', $post['Post']['id'])
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
    }
}