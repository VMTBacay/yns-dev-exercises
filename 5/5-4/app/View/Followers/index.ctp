<h1>Followers</h1>
<?php
if (empty($followers)) {
    echo 'No followers yet';
}

foreach ($followers as $follower) {
    $this->Putter->putUser($follower['FollowerProfile']);
}
?>

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