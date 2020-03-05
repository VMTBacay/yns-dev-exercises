<h1>User Search Results</h1>
<h1>Users with "<?php echo h($terms) ?>" in their username</h1>
<?php
foreach ($users as $user):
?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                echo $this->Html->image($user['User']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo h($user['User']['username']);
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