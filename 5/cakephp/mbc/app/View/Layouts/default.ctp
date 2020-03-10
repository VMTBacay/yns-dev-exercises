<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
    <link rel="icon" type="image/png" sizes="16x16" href="/app/webroot/img/logo_auth1.png">
<?php
echo $this->Html->meta('icon');
echo $this->Html->script('/app/webroot/node_modules/popper/popper.min.js');
echo $this->Html->script('/app/webroot/node_modules/jquery/jquery-3.2.1.min.js');
echo $this->Html->script('/app/webroot/js/perfect-scrollbar.jquery.min.js');
echo $this->Html->script('/app/webroot/node_modules/bootstrap/dist/js/bootstrap.min.js');
echo $this->Html->script('/app/webroot/node_modules/dropify/dist/js/dropify.min.js');
echo $this->Html->script('/app/webroot/js/sidebarmenu.js');
echo $this->Html->script('/app/webroot/js/waves.js');
echo $this->Html->script('/app/webroot/js/pages/jasny-bootstrap.js');
echo $this->Html->script('/app/webroot/node_modules/datatables/datatables.min.js');
echo $this->Html->script('https://cdn.jsdelivr.net/npm/sweetalert2@8');
echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js');
echo $this->Html->script('/app/webroot/js/custom.min.js');
echo $this->Html->script('/app/webroot/js/controller/post_script.js?aaa');
// echo $this->Html->script('/app/webroot/node_modules/toast-master/js/jquery.toast.js');
// echo $this->Html->script('/app/webroot/node_modules/toast-master/js/jquery.toast.js');

// echo $this->Html->css('/app/webroot/node_modules/toast-master/css/jquery.toast.css');
echo $this->Html->css('/app/webroot/node_modules/datatables/media/css/dataTables.bootstrap4.css');
echo $this->Html->css('/app/webroot/css/dist/css/pages/error-pages.css');
echo $this->Html->css('/app/webroot/css/dist/css/style.min.css');
echo $this->Html->css('/app/webroot/css/dist/css/pages/dashboard1.css');
echo $this->Html->css('/app/webroot/css/dist/css/pages/login-register-lock.css');
echo $this->Html->css('/app/webroot/css/dropify.min.css');
echo $this->Html->css('/app/webroot/css/dist/css/pages/floating-label.css');
echo $this->Html->css('/app/webroot/css/dist/css/pages/stylish-tooltip.css');
echo $this->Html->css('/app/webroot/css/dist/css/pages/tab-page.css');

echo $this->Html->css('/app/webroot/css/my_custome_style.css');

echo $this->fetch('css');
echo $this->fetch('script');

echo $this->fetch('meta');
?>
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
            $('[data-toggle="tooltip"]').tooltip();
        });
        function disableField() {  
            $("input").prop("readonly", true);
            $("button").prop("disabled", true);
        }
    </script>
</html>


 <script>
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
        });s

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
    // document.addEventListener('contextmenu', function(e) {
    //     e.preventDefault();
    // });
    // document.onkeydown = function(e) {
    //     if(event.keyCode == 123) {
    //         return false;
    //     }
    //     if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
    //         return false;
    //     }
    //     if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
    //         return false;
    //     }
    //     if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
    //         return false;
    //     }
    //     if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
    //         return false;
    //     }
    // }
    </script>