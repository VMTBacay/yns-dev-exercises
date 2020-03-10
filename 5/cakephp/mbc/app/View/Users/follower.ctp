<?php 
// pr($data);
for ($i = 0; $i < count($data['user_information']); $i++) { ?>
    <?php if (1) {
    } ?>
        <tr>
            <td><img src="/app/webroot/img/blog/<?= h($data['user_information'][$i]['detail']['image']) ?>" width="50"></td>
            <td><a class="text-dark" href="/users/profile/<?= $data['user_information'][$i]['detail']['id'] ?>"><?= h($data['user_information'][$i]['detail']['fullname']) ?></a></td>
            <td><?= date('F, Y', strtotime($data['user_information'][$i]['detail']['created'])); ?></td>
            <td><?= h($data['user_information'][$i]['detail']['email']) ?></td>          
        </tr>
<?php 
} ?>