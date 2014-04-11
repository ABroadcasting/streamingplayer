<?php
session_start();
//Icecast stats.xml parser
include_once('channel.conf');

class Icestat {
private $xml = array();
private $stat = array();
var $current = array();

    function getfile($user, $pass, $serv, $port) {
    
        $url = "http://".$user.":".$pass."@".$serv.":".$port."/admin/stats.xml";
        $this->xml = simplexml_load_file($url);    
        
    }    
        
    function parsefile() {
        
        $mcount = count($this->xml->source);
        
        for ($i=0; $i<$mcount; $i++) {
            
            foreach ($this->xml->source as $arr) {
        
                $mnt=str_replace("/","",$arr['mount']);
                $this->stat[$mnt]['mount_name'] = $mnt;
                $this->stat[$mnt]['audio_info'] = $arr->audio_info;
                $this->stat[$mnt]['bitrate'] = $arr->bitrate;
                $this->stat[$mnt]['genre'] = $arr->genre;
                $this->stat[$mnt]['listener_peak'] = $arr->listener_peak;
                $this->stat[$mnt]['listeners'] = $arr->listeners;   
                $this->stat[$mnt]['max_listeners'] = $arr->max_listeners;           
                $this->stat[$mnt]['server_description'] = $arr->server_description;       
                $this->stat[$mnt]['server_name'] = $arr->server_name;
                $this->stat[$mnt]['title'] = $arr->title;
                        
            }
            
        }
        return $this->current;
    }
    
    function currentmount() {
	require('channel.conf');
        if (!$this->stat[$stream_mount]['audio_info']) {
            $this->current = $this->stat[$stream_nonstop]; 
        
        } else {
        
            $this->current = $this->stat[$stream_mount]; 
        
        } 

        $this->stat = 0;
            
    }
    
    function printcurrent() {
    
    //Output data (+ design if you need). You can change it as you wish
        print "
            <nowrap>
            Active mount: ".$this->current['mount_name']."<br />
            Mount name: ".$this->current['server_name']."<br />
            Mount description: ".$this->current['server_description']."<br />
            Now playing: ".$this->current['title']."<br />";
    
        if (!$this->current['bitrate']) { 

        print "
            Bitrate: 96 Kb/s<br />";            
        
        } else {
        
        print "
            Bitrate: ".$this->current['bitrate']." Kb/s<br />";            
        
        }

        print "
            Listeners: ".$this->current['listeners']."<br />
            Listeners peak: ".$this->current['listener_peak']."
            </nowrap>";
    
    }
    
}


//Directly output

$output = new Icestat;
$output->getfile($stream_admin, $stream_password, $stream_server, $stream_port);
$output->parsefile();
//$output->currentmount();
//$output->printcurrent();
 
//echo $output->current['title'];

//End of file
?>
