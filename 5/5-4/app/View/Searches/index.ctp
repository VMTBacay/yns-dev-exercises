<h1>Search Results</h1>
<h1>Users with "<?php echo h($terms) ?>" in their username</h1>
<?php
define('RESULTS_LIMIT', 2);

if (empty($users)) {
    echo "No users found";
}
for ($i = 0; $i < min(RESULTS_LIMIT, count($users)); $i++) {
    $this->Putter->putUser($users[$i]['User']);
}

if (count($users) > 3) {
    echo $this->Html->link('More user results', $this->Html->url(array(
        'controller' => 'searches',
        'action' => 'users',
        "?" => array('terms' => $terms)))
    );
}
?>
<br><br>

<h1>Posts with "<?php echo h($terms) ?>" in their title or body</h1>
<?php
if (empty($posts)) {
    echo 'No posts found';
}
for ($i = 0; $i < min(RESULTS_LIMIT, count($posts)); $i++) {
    $this->Putter->putPost($posts[$i], $this->Session->read('user.follows'));
}

if (count($posts) > 3) {
    echo $this->Html->link('More post results', $this->Html->url(array(
        'controller' => 'searches',
        'action' => 'posts',
        '?' => array('terms' => $terms)))
    );
}
?>