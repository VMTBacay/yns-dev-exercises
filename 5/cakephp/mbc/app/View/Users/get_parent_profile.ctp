<a class="nav-link waves-effect waves-dark profile-pic text-dark" href="/users/profile/<?= $data['User']['id'] ?>">
    <img src="/img/blog/<?= $data['User']['image'] ?>" alt="user" width="50" height="50"> 
    <span class=""> &nbsp;<?= h($data['User']['fullname']) ?></span>
</a>
<div><span class="sl-date"><?=$data['User']['created']?></span></div>