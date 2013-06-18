<div class="time"><?php echo $date;?></div>
	<img class="logo" src="<?php echo 'template/', $template, '/img/logo.png';?>">
	<?php if ($stat->current['mount_name'] == $stream_nonstop){
    echo '<img class="online" src="template/',$template,'/img/on.gif" alt="">';
	}
	else
	{
	echo '<img class="online" src="template/',$template,'/img/off.gif" alt="">';
	}?>
    <h1><marquee behavior="scroll" direction="left"><?php if ($stat->current['mount_name'] == $stream_nonstop){
    echo $stat->current['title'];
	}
	else
	{
	echo $current_dj.'-'.$stat->current['title'];
	}?></marquee></h1>