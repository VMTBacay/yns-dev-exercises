<h1>User Search Results</h1>
<h1>Users with "<?php echo h($terms) ?>" in their username</h1>
<?php
foreach ($users as $user) {
    $this->Putter->putUser($user['User']);
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