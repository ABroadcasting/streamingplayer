<?php
include_once('parser.php');
$date = date("H:i");
$stat = new Icestat;
$stat->getfile($stream_admin, $stream_password, $stream_server, $stream_port);
$stat->parsefile();
$stat->currentmount();
?>
<head> 
    <script src="js/jquery.min.js"></script>
    <script src="js/mediaelement-and-player.min.js"></script>
    <link rel="stylesheet" href="<?php echo 'template/', $template, '/css/style.css';?>" media="screen">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>