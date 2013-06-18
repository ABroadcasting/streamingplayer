<?php
include_once('channel.conf');
//echo $date = date("Y-m-d H:i:s");echo "\n";
echo $date = date("H:i");echo "\n";

include_once('parser.php');
$stat = new Icestat;
//заполнить данные
//пример: $output->getfile('юзер', 'пароль', 'сервер', 'порт');
$stat->getfile($stream_admin, $stream_password, $stream_server, $stream_port);
$stat->parsefile();
$stat->currentmount();
	//Output screen
	$current_dj = $stat->current['server_description'];
  if ($stat->current['mount_name'] == $stream_nonstop){
#echo 'mount point: <b>'.$point_name.'</b><br>';
#echo 'm3u: <a href="'.$pount_m3u.'">'.$pount_m3u.'</a><br>';
#echo 'Сейчас слушает: <b>'.$point_listners_count.'</b><br><br><br>';
    echo '<br><b><font color="green">Сейчас Играет:</font></b><br><div style="margin-top:2px";><b>'. $stat->current['title'].'</b></div><br>';
	}
	else
	{
	echo '<br><font color="red"><b>Прямой Эфир</b></font><br><div style="margin-top:2px";><font "color="blue"><b>'.$current_dj.'</b></font></div><div style="margin-top:2px";><b>'. $stat->current['title'].'</b></div><br>';
	}
 
?>