<h1>Repost with content</h1>
Original post:<br>
<?php
$this->Putter->putPost($post, $this->Session->read('user.follows'), true);
echo $this->Form->create('Post', array('type' => 'file'));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
?>
<span style="margin-left: 10px;">Image:</span>
<span style="display: flex; align-items: center;">
    <?php echo $this->Html->image('no_image.jpg', array('height' => '100px', 'id' => 'preview', 'style' => 'margin: 10px;')); ?>
    <button type="button" id="removeImage" hidden>Remove Image</button>
</span>
<?php
echo $this->Form->file('Post.pic');
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
        document.getElementById("preview").src = '/img/no_image.jpg';
        document.getElementById('PostPic').value = "";
        $(this).hide();
    });
</script>