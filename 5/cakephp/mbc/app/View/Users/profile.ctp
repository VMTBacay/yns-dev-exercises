<?php echo $this->element('navbar');
$user = $this->Session->read('Auth.User');
// pr($profile_data);
?>
<div id="main-wrapper" ng-app="myComment" ng-controller="commentCtrl">
    <div class="page-wrapper" style="background-image:url(/app/webroot/img/home_back.jpg);">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor"><b>Profile</b></h4>
                </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/Posts">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                    </div>
            </div>


            <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                            <?php if ($user['id'] == $profile_data['user_info']['User']['id']) { ?>
                                    <button type="button" class="btn float-right waves-effect waves-dark" data-toggle="modal" data-target="#verticalcenter" class="model_img img-responsive" >
                                        <i class="ti-pencil fa-lg"></i>
                                    </button>
                            <?php 
                        } ?>
                                <center class="m-t-30"> <img src="/img/blog/<?= h($profile_data['user_info']['User']['image']); ?>" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?= h($profile_data['user_info']['User']['fullname']); ?></h4>
                                    <h6 class="card-subtitle"><?= h($profile_data['user_info']['User']['bio']); ?></h6>
                                    <div class="row text-center justify-content-md-center">
                                    <div class="col-6"><a href="javascript:void(0)" class="link"><i class="icon-user-follow"></i> <font class="font-medium"><?= count($profile_data['user_info']['Followers']) ?></font></a></div>
                                        <div class="col-6"><a href="javascript:void(0)" class="link"><i class="icon-user-following"></i> <font class="font-medium"><?= count($profile_data['user_info']['Following']) ?></font></a></div>
                                        
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?= h($profile_data['user_info']['User']['email']); ?></h6> <small class="text-muted p-t-30 db">Age</small>
                                <h6><?= h($profile_data['user_info']['User']['age']); ?></h6> <small class="text-muted p-t-30 db">Address</small>
                                <h6><?= h($profile_data['user_info']['User']['address']); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <!-- <div class="card-body p-b-0">
                                <h4 class="card-title">Customtab Tab</h4>
                                <h6 class="card-subtitle">Use default tab with class <code>customtab</code></h6> </div> -->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Follower</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Following</span></a> </li>
                                <?php if ($user['id'] == $profile_data['user_info']['User']['id']) { ?>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Change Password</span></a> </li>
                                <?php } ?>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home2" role="tabpanel">
                                    <div class="">
                                    <div class="col-12">
                            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Follower</h4> -->
                                    <div class="table-responsive m-t-40 hide_border">
                                        <table id="myTable_following" class="table table-bordered table-striped hide_border">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Fullname</th>
                                                    <th>Date Followed</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?= $this->requestAction(['controller' => 'users', 'action' => 'follower', $profile_data['user_info']['User']['id']], ['return']); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile2" role="tabpanel">
                                    
                                <div class="col-12">
                            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Following</h4> -->
                                    <div class="table-responsive m-t-40 hide_border">
                                        <table id="myTable_follower" class="table table-bordered table-striped hide_border">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th>Fullname</th>
                                                    <th>Date Followed</th>
                                                    <th>Email</th>
                                                    <th>Follow</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?= $this->requestAction(['controller' => 'users', 'action' => 'following', $profile_data['user_info']['User']['id']], ['return']); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>

                                </div>
                                <div class="tab-pane p-20" id="messages2" role="tabpanel">
                                
<?php if ($user['id'] == $profile_data['user_info']['User']['id']) { ?>
                    <div>
                        <?php echo $this->Form->create(
                            'User',
                            array(
                                'url' => array('controller' => 'Users', 'action' => 'sendNewPassword'),
                                'class' => 'form-horizontal form-material',
                                'type' => 'post'
                            )
                        ); ?>
                        
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php
                                echo $this->Form->input('password', array(
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    // 'name' => 'password',
                                    'placeholder' => 'Change your password and verified via email',
                                    'label' => '',
                                ));
                                echo $this->Form->input('password_confirm', array(
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    // 'name' => 'password_confirm',
                                    'placeholder' => 'Retype password',
                                    'label' => '',
                                ));
                                ?>
                            </div>
                        </div>
                    <?= $this->Form->end('Send'); ?>
                    </div>
<?php 
} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php echo $this->element('post/post_creation');
                $user = $this->Session->read('Auth.User');
                ?>
                <!--  -->
                <?php //$this->requestAction(['controller'=>'Posts', 'action'=>'postDetails' , $profile_data['user_info']['User']['id']], ['return']); ?>
                <!--  -->
                            <!--  -->
        <?php echo $this->element('post/post_block'); ?>
        <?php
        $paginator = $this->Paginator;
        ?>
    <center>
        <div class="paging btn-group page-buttons">
            <?php
            if ($paginator->hasPrev()) echo $this->Paginator->prev('< ' . __d('users', 'PREVIOUS'), array('class' => 'btn btn-default prev', 'tag' => 'button'), null);
            echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-default', 'currentClass' => 'disabled', 'tag' => 'button'));
            if ($paginator->hasNext()) echo $this->Paginator->next(__d('users', 'NEXT') . ' >', array('class' => 'btn btn-default next', 'tag' => 'button'), null, array('class' => 'btn btn-default next disabled', 'tag' => 'button'));
            ?>
        </div>
        <br>
        <?= $paginator->first('< ' . __d('users', 'FIRST'), array('class' => 'btn btn-default', 'tag' => 'button'), null); ?>
        <?= $this->paginator->counter(); ?>
        <?= $paginator->last('> ' . __d('users', 'LAST'), array('class' => 'btn btn-default', 'tag' => 'button'), null); ?>
    </center>

        </div>  
    </div>
</div> 

                                <div id="verticalcenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="vcenter">My Account</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                            
                    <!-- <form class="form-material" action="/Users/updateUserAccount" method="post" style="margin-top: -5%" enctype='multipart/form-data'> -->
                    <?php echo $this->Form->create(
                        'User',
                        array(
                            'url' => array('controller' => 'Users', 'action' => 'updateUserAccount'),
                            'class' => 'form-horizontal form-material',
                            'type' => 'post',
                            'enctype' => 'multipart/form-data',
                            'style' => 'margin-top: -5%'
                        )
                    ); ?>
                        <div class="form-group">
                            <div class="col-xs-12">
                            <br>
                                <?php echo $this->Form->input('username', array(
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'label' => 'username',
                                    'value' => h($profile_data['user_info']['User']['username']),
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                )); ?>
                                <?php echo $this->Form->input('fullname', array(
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'label' => 'Fullname',
                                    'value' => h($profile_data['user_info']['User']['fullname']),
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                )); ?>
                                <?php echo $this->Form->input('email', array(
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'label' => 'email',
                                    'value' => h($profile_data['user_info']['User']['email']),
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                )); ?>
                                <?php echo $this->Form->input('age', array(
                                    'type' => 'number',
                                    'class' => 'form-control',
                                    'label' => 'Age',
                                    'value' => $profile_data['user_info']['User']['age'],
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                )); ?> 
                                <?php echo $this->Form->input('address', array(
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'label' => 'Address',
                                    'value' => h($profile_data['user_info']['User']['address']),
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                )); ?>
                                <?php echo $this->Form->input('bio', array(
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'label' => 'Bio',
                                    'value' => h($profile_data['user_info']['User']['bio']),
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                )); ?>   
                                <?php echo $this->Form->input('image', array(
                                    'type' => 'file',
                                    'id' => 'input-file-now',
                                    'class' => 'dropify',
                                    'name' => 'image',
                                    'data-max-file-size'=>'2M',
                                    'label' => 'Profile Image:',
                                )); ?> 
                                <?php echo $this->Form->input('temp_image', array(
                                    'type' => 'hidden',
                                    'class' => 'form-control',
                                    'placeholder' => 'temp_image',
                                    'label' => '',
                                    'value' => h($profile_data['user_info']['User']['image']),
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                )); ?>   
                                    <center><img src="/app/webroot/img/blog/<?= h($profile_data['user_info']['User']['image']) ?>" width="150"></center>  
                            </div>
                        </div>                    
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn waves-effect waves-light btn-success">Submit</button>
                                                <?=  $this->Form->end(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
$(document).ready(function () {
    $('#myTable_search').DataTable();
    $('#myTable_follower').DataTable();
    $('#myTable_following').DataTable();
});
</script>