<?php
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->script('/node_modules/jquery/jquery-3.2.1.min.js') ?>
    <?= $this->Html->script('/node_modules/popper/popper.min.js') ?>
    <?= $this->Html->script('/node_modules/bootstrap/dist/js/bootstrap.min.js') ?>
    <?= $this->Html->script('/js/waves.js') ?>
    <?= $this->Html->script('/js/custom.min.js') ?>
    <?= $this->Html->script('/node_modules/toast-master/js/jquery.toast.js') ?>
    <?= $this->Html->script('/js/pages/toastr.js') ?>
    <?= $this->Html->script('/node_modules/dropify/dist/js/dropify.min.js') ?>

    <?= $this->Html->css('/node_modules/toast-master/css/jquery.toast.css') ?>
    <?= $this->Html->css('/css/dist/css/pages/login-register-lock.css') ?>
    <?= $this->Html->css('/node_modules/dropify/dist/css/dropify.min.css') ?>
    <?= $this->Html->css('/css/dist/css/style.min.css') ?>
    <?= $this->Html->css('/css/dist/css/pages/other-pages.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body class="horizontal-nav skin-default fixed-layout default-theme">

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading</p>
        </div>
    </div>
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->fetch('content'); ?>

</body>

<footer class="footer">
    © 2019 Microblog Chaste -Joselin T. Macayanan
</footer>
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    }); 
        $(document).ready(function() {
            // Basic
            var s;
            $('.dropify').dropify({
                allowedFileExtensions: ["gif", "GIF", "jpeg", "JPEG", "png", "PNG", "jpg", "JPG"]
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            s

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
</script>

</html>