<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script>
    $(function() {
        errorNotification('<?= $message ?>');
    });

    function errorNotification(message) {
        "use strict";
        $.toast({
            heading: `<small><b>${message}</b></small>`,
            text: '<small>Sorry for the inconvenience!</small>',
            position: 'top-left',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 4500,
            stack: 6
        });
    }
</script>