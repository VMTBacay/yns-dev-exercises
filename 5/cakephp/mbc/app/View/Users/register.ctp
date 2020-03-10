<section id="wrapper"  style="background-image:url(/img/back.jpg);  background-position: center center; background-size:     cover; ">
<br><br><br><br><br><br><br>
        <div>
            <div class="login-box card" style="opacity: 0.7; border-radius: 2%; margin-top: -5%">
                <div class="card-body" style="margin-top:-118px">
                <img src="/img/logo_auth1.png" width="150" style="margin-top:10px; margin-left:96px"><?php echo $this->Session->flash('auth'); ?>
                    <?php echo $this->Form->create(
                        'User',
                        array(
                            'url' => array('controller' => 'Users', 'action' => ''),
                            'class' => 'form-horizontal form-material',
                            'id' => 'registerform',
                            'type' => 'post',
                            'enctype' => 'multipart/form-data',
                            'style' => 'margin-top: -5%',
                            'onsubmit' => 'disableField()'
                        )
                    ); ?>
                        <h3 class="text-center m-b-20 font-weight-normal">Sign Up</h3>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo $this->Form->input('username', array(
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                    
                                ));
                                echo $this->Form->input('password', array(
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                ));
                                echo $this->Form->input('password_confirm', array(
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                ));
                                echo $this->Form->input('fullname', array(
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                ));
                                echo $this->Form->input('age', array(
                                    'type' => 'number',
                                    'class' => 'form-control',
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                ));
                                echo $this->Form->input('address', array(
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                ));
                                echo $this->Form->input('email', array(
                                    'type' => 'email',
                                    'class' => 'form-control',
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                ));
                                echo $this->Form->input('bio', array(
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'rows' => 3,
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                )); ?>                  
                                <div class="drop_image">
                                <?php 
                                echo $this->Form->input('image', array(
                                    'type' => 'file',
                                    'id' => 'input-file-now',
                                    'class' => 'dropify',
                                    'name' => 'image',
                                    'data-max-file-size'=>'2M',
                                    'label' => 'Profile Image: (Optional)',
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                )); 
                                echo $this->Form->input('size', array(
                                    'type' => 'label',
                                    'class' => 'form-control',
                                    'label' => false,
                                    'name' => 'size',
                                    'readonly',
                                    'error' => ['attributes' =>['class' => 'text-danger']]
                                ));
                                ?>  
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" id="on-submit" type="submit" style="background-color: rgb(52, 54, 53);">Sign Up</button>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                Already have an account? <a href="/users/login" class="text-info m-l-5"><b style="color: rgb(52, 54, 53);">Sign In</b></a>
                            </div>
                        </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <br><br>
    </section>