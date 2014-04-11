<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include('channel.conf');
$tmain="template/$template/main.tpl";
$tbody="template/$template/body.tpl";
include $tmain;?>
<div class="audio-player">
<?php include $tbody;?>
<audio id="audio-player" src="<?php echo 'http://',$stream_server,':',$stream_port,'/',$stream_mount;?>" type="audio/mp3" controls="controls"></audio>
</div>
<script src="template/default/script.js"></script>
<html>
