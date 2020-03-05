<div style="border-style: solid; margin: 10px; padding: 5px;">
    <div style="display: inline-flex; align-items: center;">
        <?php
        echo $this->Html->image($post['User']['profile_pic'], array('height' => '50px', 'width' => '50px'));
        $this->Space->spaceMaker();
        echo h($post['User']['username']) . ' says:&nbsp;';
        echo '<b>' . h($post['Post']['title']) . '</b>';
        ?>
    </div>
    <p style="margin: 10px;">
        <?php
        echo h($post['Post']['body']) . '<br>';
        echo $this->Html->image($post['Post']['image'], array('style' => 'height: 100px;'));
        ?>
    </p>
    <div style="margin: 10px; color: gray">
        Posted on: <?php echo h($post['Post']['created']); ?>
    </div>
</div>
<br>

Comments
<hr>
<?php foreach ($comments as $comment): ?>
    <div style="border-style: ridge; margin: 10px; padding: 5px;">
        <div style="display: flex; align-items: center;">
            <?php
            echo '<img src="' . $this->webroot . 'img/' . $comment['User']['profile_pic'] . '" height="50px" width="50px">';
            $this->Space->spaceMaker();
            echo $comment['User']['username'] . ' says:';
            ?>
        </div>
        <p style="margin: 10px"><?php echo h($comment['Comment']['body']); ?></p>
        <div style="margin: 10px; display: flex; justify-content: space-between;">
            <span style="text-align: left; color: gray">
                Posted on: <?php echo h($comment['Comment']['created']) ?>
            </span>
            <span>
                <?php
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