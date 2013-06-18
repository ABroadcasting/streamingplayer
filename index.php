<?php include('channel.conf');
$tmain="template/$template/main.tpl";
$tbody="template/$template/body.tpl";
include $tmain;?>
<div class="audio-player">
<?php include $tbody;?>
<audio id="audio-player" src="<?php echo 'http://',$stream_server,':',$stream_port,'/',$stream_mount;?>" type="audio/mp3" controls="controls"></audio>
</div>
<script src="template/default/script.js"></script>
