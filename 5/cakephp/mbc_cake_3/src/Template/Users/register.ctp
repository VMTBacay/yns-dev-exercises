<style>
.error-message{
    color: red;
    font-size: 12px;
}
</style>
<section id="wrapper" style="background-image:url(/img/back.jpg); background-size: cover;">
    <div class="login-box card" style="margin-left: 73.8%; opacity: 0.7;">
        <div class="card-body">
            <?= $this->Form->create(
                $user,
                [
                    'type' => 'post',
                    'class' => 'form-horizontal form-material',
                    'id' => 'loginform'
                ]
            ) ?>
            <div class="text-center">
                <a href="javascript:void(0)" class="db"><img src="/img/logo_auth1.png" alt="Home" height="150" /></a>
                <h3 class="box-title m-t-40 m-b-0">Register Now</h3><small>Create your account and enjoy</small>
            </div>
            <div class="form-group m-t-20">
                <div class="col-xs-12">
                    <?= $this->Form->control('username', [
                        'class' => 'form-control',
                        'type' => 'text',
                    ]) ?>
                </div>
            </div>
            <div class="form-group ">
                <div class="col-xs-12">
                    <?= $this->Form->control('password', [
                        'class' => 'form-control',
                        'type' => 'password',
                    ]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <?= $this->Form->control('confirm_password', [
                        'class' => 'form-control',
                        'type' => 'password',
                    ]) ?>
                </div>
            </div>
            <div class="form-group m-t-20">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <?= $this->Form->control('fullname', [
                            'class' => 'form-control',
                            'type' => 'text',
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="form-group m-t-20">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <?= $this->Form->control('age', [
                            'class' => 'form-control',
                            'type' => 'number',
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="form-group m-t-20">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <?= $this->Form->control('email', [
                            'class' => 'form-control',
                            'type' => 'email',
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="form-group m-t-20">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <?= $this->Form->control('bio', [
                            'class' => 'form-control',
                            'type' => 'textarea',
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="form-group m-t-20">
                <div class="col-xs-12">
                    <div class="col-xs-12">
                        <?= $this->Form->control('image', [
                            'type' => 'file',
                            'id' => 'input-file-now',
                            'class' => 'dropify',
                            'data-max-file-size'=>'2M',
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" style="background-color: rgb(52, 54, 53);">Sign Up</button>
                </div>
            </div>
            <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                    <p>Already have an account? <a href="/" class="text-info m-l-5"><b>Sign In</b></a></p>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</section>
<script>
    $(function() {
        $('.footer').hide();
    });
</script>