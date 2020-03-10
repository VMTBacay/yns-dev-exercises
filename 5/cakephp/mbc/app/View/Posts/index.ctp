<?php echo $this->element('navbar');
?>
<div id="main-wrapper" ng-app="myComment" ng-controller="commentCtrl">
        <div class="page-wrapper" style="background-image:url(/app/webroot/img/home_back.jpg);">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor"><b>Welcome to MicroBlog Chaste</b></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Welcome to MicroBlog Chaste</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <?php echo $this->element('post/post_creation');
                $user = $this->Session->read('Auth.User');
                ?>
        <?= $this->element('post/post_block'); ?>
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
        <?= $paginator->first('< ' . __d('users', 'FIRST'), array('class' => 'btn btn-default', 'tag' => 'button'), null);?>
        <?= $this->paginator->counter();?>
        <?= $paginator->last('> ' . __d('users', 'LAST'), array('class' => 'btn btn-default', 'tag' => 'button'), null);?>
    </center>
            </div>  
            </div>
        </div> <?= $this->element('post/update_post'); ?>
        <?= $this->element('post/share_info'); ?>      