<div id="myModal_share" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Share this post?</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                            <?php 
                                            $curret_page = str_replace("/",false,"$_SERVER[REQUEST_URI]");
                                            echo $this->Form->create(
                                                'Post',
                                                array(
                                                    'url' => array('controller' => 'Posts', 'action' => 'sharePost', $curret_page),
                                                    'class' => 'form-horizontal form-material',
                                                    'type' => 'post'
                                                )
                                            ); ?>

                                <?php echo $this->Form->input('description', array(
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'id' => 'share_description',
                                    'name' => 'description',
                                    'value' => ' '
                                ));
                                echo $this->Form->input('parent_post_id', array(
                                    'type' => 'hidden',
                                    'class' => 'form-control',
                                    'id' => 'parent_post_id',
                                    'name' => 'parent_post_id',
                                    'label' => '',
                                    'readonly'
                                ));
                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-info waves-effect" type="submit">Share</button>
                                                <?php echo $this->Form->end(); ?>   
                                            </div>
        </div>
    </div>
</div>