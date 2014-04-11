<img class="logo" src="<?php echo 'template/', $template, '/img/logo_mini.png';?>">
<div class="now">Сейчас в эфире</div>
<marquee behavior="alternate" scrollamount="2" width="130" class="song"><?php if ($stat->current['mount_name'] == $stream_nonstop){
    echo $stat->current['title'];
	}
	else
	{
	echo $current_dj.'-'.$stat->current['title'];
	}?></marquee>
	