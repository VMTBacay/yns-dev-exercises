<?php
if ($this->Session->read('user.id') === $viewUser['id']) {
    echo '<h1>Add Post</h1>';
    echo $this->Form->create('Post', array('type' => 'file', 'url' => array('action' => 'add')));
    echo $this->Form->input('title');
    echo $this->Form->input('body', array('rows' => '3'));
    ?>
    <span style="margin-left: 10px">
        <?php echo $this->Html->image(' ', array('height' => '100px', 'id' => 'preview')); ?>
    </span>
    <?php
    echo $this->Form->file('Post.pic');
    echo $this->Form->end('Save Post');
}

$allPosts = array_merge($posts, $reposts);
usort($allPosts, function($b, $a) {
    $x = !array_key_exists('Like', $a) ? 'Repost' : 'Post';
    $y = !array_key_exists('Like', $b) ? 'Repost' : 'Post';
     return strtotime($a[$x]['created']) - strtotime($b[$y]['created']);
});

define('PAGE_LIMIT', 5);
$postCount = count($allPosts);
$pages = max(ceil($postCount / PAGE_LIMIT), 1);
$page = min($pages, array_key_exists('page', $this->params['url']) ? $this->params['url']['page'] : 1);
$offset = ($page - 1)  * PAGE_LIMIT;
$end = min(($offset + PAGE_LIMIT), $postCount);
?>

<h1><?php echo $userOnly === null ? 'Feed' : 'User\'s Posts' ?></h1>
<hr><br>
<?php
if ($postCount === 0) {
    echo 'No posts yet';
}

for ($i = $offset; $i < $end; $i++) {
    $this->Putter->putPost($allPosts[$i], $this->Session->read('user.follows'), $repostPosts);
}
?>

<div style="text-align: center;">
    <?php
    if ($page != 1) {
        echo $this->Html->link('<<first', $this->Html->url(array(
            'controller' => 'posts',
            'action' => 'index', $viewUser['id'], $userOnly,
            "?" => array('page' => 1)
        )));
        echo  ' ';
        echo $this->Html->link('<<Previous', $this->Html->url(array(
            'controller' => 'posts',
            'action' => 'index', $viewUser['id'], $userOnly,
            "?" => array('page' => $page - 1)
        )));
        $this->Space->spaceMaker();
    }

    if ($page != $pages) {
        echo $this->Html->link('Next>>', $this->Html->url(array(
            'controller' => 'posts',
            'action' => 'index', $viewUser['id'], $userOnly,
            "?" => array('page' => $page + 1)
        )));
        echo ' ';
        echo $this->Html->link('last>>', $this->Html->url(array(
            'controller' => 'posts',
            'action' => 'index', $viewUser['id'], $userOnly,
            "?" => array('page' => $pages)
        )));
    }
    ?>
</div>
<script type="text/javascript">
    $("#PostPic").on("input", function() {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("preview").src = e.target.result;
        };
        reader.readAsDataURL(document.getElementById("PostPic").files[0]);
    });
</script>