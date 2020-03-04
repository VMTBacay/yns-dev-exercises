<h1>Followers</h1>
<?php foreach ($followers as $follower): ?>
    <div style="border-style: solid;">
        <div style="margin: 10px; display : flex; justify-content: space-between;">
            <span style="display: inline-flex; align-items: center;">
                <?php
                echo $this->Html->image($follower['FollowerProfile']['profile_pic'], array('height' => '50', 'width' => '50'));
                $this->Space->spaceMaker();
                echo $follower['FollowerProfile']['username']
                ?>
            </span>
            <span>
                <?php
                if (in_array($follower['FollowerProfile']['id'], $follows)) {
                    echo $this->Form->postlink(
                        'Unfollow User', array('controller' => 'followers', 'action' => 'unfollow', $follower['FollowerProfile']['id'])
                    );
                } else {
                    echo $this->Form->postlink(
                        'Follow User', array('controller' => 'followers', 'action' => 'follow', $follower['FollowerProfile']['id'])
                    );
                }
                ?>
            </span>
        </div>
    </div>
<?php endforeach; ?>