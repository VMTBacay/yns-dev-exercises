<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file'));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
?>
<span style="margin-left: 10px;">Image:</span>
<span style="display: flex; align-items: center;">
    <?php
        $hidden = '';
        if ($image === null) {
            $image = 'no_image.jpg';
            $hidden = 'hidden';
        }
        echo $this->Html->image($image, array('height' => '100px', 'id' => 'preview', 'style' => 'margin: 10px;')); 
    ?> 
    <button type="button" id="removeImage" <?php echo $hidden; ?>>Remove Image</button>
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
            $("#removeImage").show();
        };
        reader.readAsDataURL(document.getElementById("PostPic").files[0]);
    });

    $("#removeImage").click(function() {
        $.post("<?php echo Router::url(array('controller'=>'posts','action'=>'removeImage', $id)); ?>");
        document.getElementById("preview").src = '/img/no_image.jpg';
        document.getElementById('PostPic').value = "";
        $(this).hide();
    });
</script>