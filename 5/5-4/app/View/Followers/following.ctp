<h1>Following</h1>
<?php
if (empty($follows)) {
    echo 'Following no one yet';
}

foreach ($follows as $follow) {
    $this->Putter->putUser($follow['User']);
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