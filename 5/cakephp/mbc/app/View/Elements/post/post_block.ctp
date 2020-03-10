<?php
for ($i = 0; $i < count($data); $i++) {
    if (1) {
        ?>
                <div class="row">
                <div class="col-md-2"></div>      
                    <div class="col-md-8">
                    <?php if ($i == 0) { ?>
                        <h3 class="card-title">Newsfeed</h3>
                    <?php 
                } ?>
                        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                                <?php $user = $this->Session->read('Auth.User');
                                if ($user['id'] == $data[$i]['Post']['user_id']) {
                                    ?>
                                    <button type="button" class="btn float-right waves-effect waves-dark" onclick="post().delete(<?= $data[$i]['Post']['id']; ?>)">
                                        <i class="ti-trash"></i>
                                    </button>
                                    <button type="button" class="btn float-right waves-effect waves-dark" onclick="post().update(<?= $data[$i]['Post']['id']; ?>)" data-toggle="modal" data-target=".bs-example-modal-lg" class="model_img img-responsive">
                                        <i class="ti-pencil"></i>
                                    </button>
                                <?php 
                            } ?>
                                <a class="nav-link waves-effect waves-dark profile-pic text-dark" href="/users/profile/<?= $data[$i]['User']['id'] ?>"><img src="/img/blog/<?= $data[$i]['User']['image']; ?>" alt="user" width="50" height="50"> 
                                    <span class="">   <?= h($data[$i]['User']['fullname']); ?> &nbsp;</span> </a>
                                    <div><span class="sl-date"><?=$data[$i]['User']['created']?></span></div>
                                <hr>
                                <!-- share post information -->
                            <?php
                            if ($data[$i]['Parent']['is_deleted'] == 1) { ?>
                            <?= h($data[$i]['Post']['description']); ?>
                                <?php if ($data[$i]['Post']['image'] != '') { ?>
                                <center><img src="/img/blog/post/<?= $data[$i]['Post']['image']; ?>" width="auto" style="max-height:80px;"></center>
                                <?php 
                            } ?>
                                    <center><img src="/img/parent_not_exist1.gif" width="300"></center>
                                    <center>
                                        <h5><b>This post has been deleted by the owner. Sorry for the inconvenience!</b></h5>
                                        <small>-MicroBlog Chaste Team</small>
                                    </center>
                            <?php 
                        }
                        if ((string)$data[$i]['Parent']['is_deleted'] != '' && (string)$data[$i]['Parent']['is_deleted'] != '1') { ?>
                                <?= h($data[$i]['Post']['description']); ?>
                                <?php if ($data[$i]['Post']['image'] != '') { ?>
                                <center><img src="/img/blog/post/<?= $data[$i]['Post']['image']; ?>" width="auto" style="max-height:80px;"></center>
                                <?php 
                            } ?>
                                <hr>
                                <div class="jumbotron">
                                <?= $this->requestAction(['controller' => 'users', 'action' => 'getParentProfile', $data[$i]['Parent']['user_id']], ['return']); ?>
                                <p><?php echo h($data[$i]['Parent']['description']); ?></p>
                                <hr>
                                <?php 
                                if ($data[$i]['Parent']['image'] != '') { ?>
                                <center><img src="/img/blog/post/<?= $data[$i]['Parent']['image']; ?>" width="auto" style="max-height:280px;"></center>
                                <?php 
                            } ?>
                                </div>
                                <!--  -->
                            <?php 
                        } ?> 
                            <!-- end share post information -->
                            
                            <!-- regular post (the one with no share) -->
                        <?php if ($data[$i]['Parent']['is_deleted'] == null) { ?>
                                <p><?php echo h($data[$i]['Post']['description']); ?></p>
                                <hr>
                                <?php 
                                if ($data[$i]['Post']['image'] != '') { ?>
                                <center><img src="/img/blog/post/<?= $data[$i]['Post']['image']; ?>" width="auto" style="max-height:280px;"></center>
                                <?php 
                            } ?>
                            <?php 
                        } ?>
                                <?php 
                                $parent_id = $data[$i]['Post']['id'];
                                if (isset($data[$i]['Post']['parent_post_id'])) {
                                    $parent_id = $data[$i]['Post']['parent_post_id'];
                                }
                                ?>
                                <br><hr>             
                            <!-- regular post (the one with no share) -->
                <div class="container text-center">
                <div class="row align-items-start">
                    <div class="col">
                    <button type="button" class="btn waves-effect waves-dark" onclick="post().like(<?= $data[$i]['Post']['id']; ?>)"><i class="icon-like fa-lg"></i><font class="font-medium" id="like_post<?= $data[$i]['Post']['id']; ?>"> <?= count($data[$i]['PostLike']); ?></font></button>
                    </div>
                    <div class="col">
                    <button type="button" title="double click to hide the comment   " data-toggle="tooltip" class="btn comment waves-effect waves-dark" ng-click="show_comment(<?= $data[$i]['Post']['id'] ?>)"><i class="ti-eye"></i> Comment 
                        <font class="font-medium" id="comment_post<?= $data[$i]['Post']['id']; ?>">[<?= count($data[$i]['PostComment']); ?>]</font>
                    </button>
                    </div>
                    <div class="col">
                    <button type="button" class="btn waves-effect waves-dark" id="share-button" data-toggle="modal" data-target="#myModal_share" onclick="post().share(<?= $user['id']; ?>, <?= $parent_id; ?>, '<?php echo h($data[$i]['Post']['description']); ?>', '<?php echo h($data[$i]['Post']['image']); ?>')"><i class="icon-action-redo fa-lg"></i> Share</button>
                    </div>
                </div>
                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-md-2"></div> 
                <div class="col-md-2"></div> 
                    <div class="col-md-8 comment_section position-static" id="comment_section_<?= $data[$i]['Post']['id'] ?>">
                        <div class="card">
                            <div class="card-body border border-dark">
                            <?php 
                            echo $this->Form->create(
                                'Post',
                                array(
                                    'url' => array('controller' => 'Posts', 'action' => ''),
                                    'class' => 'floating-labels m-t-40'
                                )
                            ); ?>
                            <div class="row" style="margin-top:-30px">
                                <div class="col-11">
                            <?= $this->Form->input('description', array(
                                'type' => 'textarea',
                                'class' => 'form-control  border-0',
                                'id' => 'comment_description' . $i,
                                'label' => '',
                                'rows' => '2',
                                'placeholder' => 'What are you thinking about this?'
                            ));
                            ?>
                                </div>
                                <div class="col-1 text-right">
                            <?= $this->Form->button('', array(
                                'type' => 'button',
                                'class' => 'btn btn-dark btn-circle fas fa-paper-plane',
                                'onclick' => 'comment().add(' . $data[$i]['Post']['id'] . ', ' . $i . ')',
                                'ng-click' => 'show_comment(' . $data[$i]['Post']['id'] . ')'
                            ));
                            ?>    
                                </div>
                            </div>
                            <hr>
                                <?php echo $this->Form->end(); ?>
                                <div id="show_comment<?= $data[$i]['Post']['id'] ?>" style=" max-height:280px; overflow: auto;">
                                    <?= $this->element('post/comment_section'); ?>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            <?php 
        }
    }
    ?> 

            <?= $this->element('post/update_post'); ?>
            <?= $this->element('post/share_info'); ?>