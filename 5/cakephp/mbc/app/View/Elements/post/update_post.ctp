<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"><i class="ti-pencil"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
                <div class="modal-body">
                

                        <?php echo $this->Form->create(
                            'User',
                            array(
                                'url' => array('controller' => 'Posts', 'action' => 'updatePost'),
                                'class' => 'form-horizontal form-material',
                                'id' => 'loginform',
                                'type' => 'post',
                                'enctype' => 'multipart/form-data'
                            )
                        ); ?>

                        <h3 class="text-center m-b-20 font-weight-normal">Stop updating <b>Start Living</b></h3>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo $this->Form->input('update_description', array(
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'id' => 'update_description',
                                    'name' => 'update_description'
                                ));

                                echo $this->Form->input('update_post_id', array(
                                    'type' => 'hidden',
                                    'class' => 'form-control',
                                    'id' => 'update_post_id',
                                    'name' => 'update_post_id',
                                    'readonly',
                                    'hide'
                                ));
                                ?>
                                
                            </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('image', array(
                                'type' => 'file',
                                'id' => 'input-file-now',
                                'class' => 'dropify',
                                'name' => 'image',
                                'data-max-file-size'=>'2M',
                                'label' => ''
                            ));
                            echo $this->Form->input('update_image_temp', array(
                                'type' => 'hidden',
                                'class' => 'form-control',
                                'id' => 'update_image_temp',
                                'name' => 'update_image_temp',
                                'readonly',
                                'hide',
                                'label' => ''
                            ));
                            ?>

                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Update</button>
                            </div>
                        </div>
                        <div class="row">
                        </div>                      
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>
</div>