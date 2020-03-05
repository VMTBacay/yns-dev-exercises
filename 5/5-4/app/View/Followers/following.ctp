<h1>Following</h1>
<?php foreach ($follows as $follow): ?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                echo $this->Html->image($follow['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo h($follow['User']['username']);
                ?>
            </span>
            <span>
                <?php
                echo $this->Form->postlink(
                    'Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $follow['User']['id'])
                );
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