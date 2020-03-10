<?php $this->Putter->putPost($post, $this->Session->read('user.follows')); ?>
<br>

Comments
<hr>
<?php foreach ($comments as $comment): ?>
    <div style="border-style: ridge; margin: 10px; padding: 5px;">
        <div style="display: flex; align-items: center;">
            <?php
            echo '<img src="' . $this->webroot . 'img/' . $comment['User']['profile_pic'] . '" height="50px" width="50px">';
            $this->Space->spaceMaker();
            echo $this->Html->link($comment['User']['username'], array('controller' => 'posts', 'action' => 'index', $comment['User']['id'], null)) . '&nbsp;says:';
            ?>
        </div>
        <p style="margin: 10px"><?php echo h($comment['Comment']['body']); ?></p>
        <div style="margin: 10px; display: flex; justify-content: space-between;">
            <span style="text-align: left; color: gray">
                Posted on: <?php echo h($comment['Comment']['created']) ?>
            </span>
            <span>
                <?php
                if ($comment['Comment']['user_id'] === $this->Session->read('user.id')) {
                    echo $this->Form->postLink(
                        'Delete',
                        array('action' => 'delete', $comment['Comment']['id']),
                        array('confirm' => 'Are you sure?')
                    );
                    $this->Space->spaceMaker();

                    echo $this->Html->link(
                        'Edit', array('action' => 'edit', $comment['Comment']['id'])
                    );
                    $this->Space->spaceMaker();
                }
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

<?php
echo $this->Form->create('Comment');
echo $this->Form->input('body', array('rows' => '3', 'label' => 'Add Comment'));
echo $this->Form->end('Submit Comment');
?>