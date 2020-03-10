<!-- <h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('username') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?> -->

<section id="wrapper" class="login-register login-sidebar" style="background-image:url(/img/back.jpg);">
    <div class="login-box card" style="opacity: 0.7;">
        <div class="card-body">
            <?= $this->Form->create(
                'User',
                [
                    'type' => 'post',
                    'class' => 'form-horizontal form-material',
                    'id' => 'loginform'
                ]
            ) ?>
            <div class="text-center">
                <a href="javascript:void(0)" class="db"><img src="/img/logo_auth1.png" alt="Home" height="150" /><br></a>
                <h3 class="box-title m-t-40 m-b-0 ">Login Now</h3><small>Use account and enjoy</small>
            </div>
            <div class="form-group m-t-40">
                <div class="col-xs-12">
                    <?= $this->Form->control('username', [
                        'class' => 'form-control',
                        'type' => 'text',
                    ]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <?= $this->Form->control('password', [
                        'class' => 'form-control',
                        'type' => 'password',
                    ]) ?>
                </div>
            </div>
            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <?= $this->Form->button('Login', [
                        'class' => 'btn btn-info btn-lg btn-block btn-rounded',
                        'type' => 'submit',
                        'style' => 'background-color: rgb(52, 54, 53);'
                    ]) ?>
                </div>
            </div>
            <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                    Don't have an account? <a href="/users/register" class="text-primary m-l-5"><b>Sign Up</b></a>
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