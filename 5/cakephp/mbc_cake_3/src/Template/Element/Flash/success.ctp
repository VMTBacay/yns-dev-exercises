<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script>
    $(function() {
        successNotification('<?= $message ?>');
    });

    function successNotification(message) {
        "use strict";
        $.toast({
            heading: `<small><b>${message}</b></small>`,
            text: '<small>Thank you!</small>',
            position: 'top-left',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 4500,
            stack: 6
        });
    }
</script>