    <section id="wrapper">
        <div class="login-register" style="background-image:url(/app/webroot/img/back.jpg);">
            <div class="login-box card" style="opacity: 0.7; border-radius: 2%">
                <div class="card-body" style="margin-top:-118px">
                <img src="/img/logo_auth1.png" width="190" style="margin-top:-10px; margin-left:90px">
                
                    <?php echo $this->Session->flash('auth'); ?>
                    <?php echo $this->Form->create(
                        'User',
                        array(
                            'url' => array('controller' => 'Users', 'action' => 'login'),
                            'class' => 'form-horizontal form-material',
                            'id' => 'loginform',
                            'type' => 'post',
                            'onsubmit' => 'disableField()'
                        )
                    ); ?>
                        <h3 class="text-center m-b-20 font-weight-normal">Sign In</h3>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo $this->Form->input('username', array(
                                    'type' => 'text',
                                    'class' => 'form-control'
                                )); ?>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <?php echo $this->Form->input('password', array(
                                    'type' => 'password',
                                    'class' => 'form-control'
                                )); ?>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit" style="background-color: rgb(52, 54, 53);">Log In</button>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Don't have an account? <a href="/users/register" class="text-info m-l-5"><b style="color: rgb(52, 54, 53);">Sign Up</b></a>
                            </div>
                        </div>
                        
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>