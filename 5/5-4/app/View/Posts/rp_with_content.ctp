<h1>Repost with content</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file'));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
?>
<span style="margin-left: 10px">
    <?php echo $this->Html->image(' ', array('height' => '100px', 'id' => 'preview')); ?>
</span>
<?php
echo $this->Form->file('pic');
echo $this->Form->end('Save Post');
?>
<script type="text/javascript">
    $("#PostPic").on("input", function() {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("preview").src = e.target.result;
        };
        reader.readAsDataURL(document.getElementById("PostPic").files[0]);
    });
</script>