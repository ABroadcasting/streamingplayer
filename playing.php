<?php
include_once('channel.conf');
echo $date = date("H:i");echo "\n";

include_once('parser.php');
$stat = new Icestat;
$stat->getfile($stream_admin, $stream_password, $stream_server, $stream_port);
$stat->parsefile();
$stat->currentmount();
	//Output screen
	if (strlen ($stat->current['title']) <= 2){$stat->current['title']='Unknown - Unknown';}
	if (strlen ($current_dj) <= 2){$current_dj='Unknown DJ';}
	$current_dj = $stat->current['server_description'];
  if ($stat->current['mount_name'] == $stream_nonstop){
#echo 'mount point: <b>'.$point_name.'</b><br>';
#echo 'm3u: <a href="'.$pount_m3u.'">'.$pount_m3u.'</a><br>';
#echo 'Now listening: <b>'.$point_listners_count.'</b><br><br><br>';
    echo '<br><b><font color="green">Now playing</font></b><br><div style="margin-top:2px";><b>'. $stat->current['title'].'</b></div><br>';
	}
	else
	{
	echo '<br><font color="red"><b>On air</b></font><br><div style="margin-top:2px";><font "color="blue"><b>'.$current_dj.'</b></font></div><div style="margin-top:2px";><b>'. $stat->current['title'].'</b></div><br>';
	}
 
?>