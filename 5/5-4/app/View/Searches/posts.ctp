<h1>Post Search Results</h1>

<h1>Posts with "<?php echo h($terms) ?>" in their title or body</h1>
<?php
foreach ($posts as $post) {
    $this->Putter->putPost($post, $this->Session->read('User.follows'));
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