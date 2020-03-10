<?php
$current_user = $this->Session->read('Auth.User');
if ((isset($profile_data['user_info']['User']['id']) && $current_user['id'] == $profile_data['user_info']['User']['id']) || isset($home)) {
    ?>
<div class="row">
<div class="col-md-2"></div> 
                    <div class="col-md-8 shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card">
                            <div class="card-body">
                                <?php echo $this->Form->create(
                                    'Post',
                                    array(
                                        'url' => array('controller' => 'Posts', 'action' => 'addPost'),
                                        'type' => 'post',
                                        'enctype' => 'multipart/form-data',
                                        'class' => 'floating-labels m-t-40'
                                    )
                                ); ?>                                   

                                <?php 
                                $user = $this->Session->read('Auth.User');
                                echo $this->Form->input('user_id', array(
                                    'type' => 'hidden',
                                    'value' => $user['id'],
                                    'label' => ''
                                ));
                                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group m-b-5">
                                <div class="">
                                </div>  
                                <?php echo $this->Form->input('description', array(
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'rows' => '10',
                                    'label' => ''
                                ));
                                ?>
                                        <span class="bar"></span>
                                        <label for="input7">What are you thinking?</label>
                                <br>
                                <center>
                                <div class="col-md-5">
                                        <?php echo $this->Form->input('image', array(
                                            'type' => 'file',
                                            'id' => 'input-file-now',
                                            'class' => 'dropify',
                                            'name' => 'image',
                                            'data-max-file-size'=>'2M',
                                            'label' => ''
                                        ));
                                        ?>
                                </div>
                                <label name="size" class="text-danger"></label>
                                </center>
                                <br>
                <div class="container text-center">
                    <div class="row align-items-start">
                        <div class="col">
                            <div class="row button-group">
                                <div class="col-lg-12">
                                    <?php echo $this->Form->input('Submit Post', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-rounded btn-block btn-outline-success',
                                        'label' => '',
                                        'id' => 'submit_post'
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div> 
                </div>
<script>
$(document).ready(function () {
    $('#submit_post').click(function (e) { 
        $('#submit_post').hide();
        setTimeout(() => {
            $('#submit_post').show();
        }, 1000);
    });
});
</script>

<?php 
} ?>