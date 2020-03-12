<h1>Edit Profile Picture</h1>
<span style="margin-left: 10px">
    <?php echo $this->Html->image(' ', array('height' => '150px', 'width' => '150px', 'id' => 'preview')); ?>
</span>
<?php
echo $this->Form->create('User', array('type' => 'file'));
echo $this->Form->file('User.pic');
echo $this->Form->end('Upload Profile Picture');
?>
<script type="text/javascript">
    $("#UserPic").on("input", function() {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("preview").src = e.target.result;
        };
        reader.readAsDataURL(document.getElementById("UserPic").files[0]);
    });
</script>