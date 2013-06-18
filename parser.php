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
                $this->stat[$mnt]['mount_name'] = $mnt; //ID маунта (например: ices)
                $this->stat[$mnt]['audio_info'] = $arr->audio_info; //инфо маунта
                $this->stat[$mnt]['bitrate'] = $arr->bitrate; //битрейт
                $this->stat[$mnt]['genre'] = $arr->genre; //жанр    
                //$this->stat[$mnt]['channels'] = $arr->ice-channels; //каналы (моно, стерео)
                $this->stat[$mnt]['listener_peak'] = $arr->listener_peak; //пик слушателей
                $this->stat[$mnt]['listeners'] = $arr->listeners; //текущее кол-во слушателей    
                $this->stat[$mnt]['max_listeners'] = $arr->max_listeners; //максимум слушателей            
                $this->stat[$mnt]['server_description'] = $arr->server_description; //описание маунта        
                $this->stat[$mnt]['server_name'] = $arr->server_name; //название маунта
                $this->stat[$mnt]['title'] = $arr->title; // название текущей песни
                        
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
    
    /*function printcurrent() {
    
    //Выводимая инфа (+ диз если нужно). Можно дополнять и изменять 
        print "
            <nowrap>
            Активный маунт: ".$this->current['mount_name']."<br />
            Название маунта: ".$this->current['server_name']."<br />
            Описание маунта: ".$this->current['server_description']."<br />
            Композиция: ".$this->current['title']."<br />";
    
        if (!$this->current['bitrate']) { 

        print "
            Битрейт: 96 Кб/с<br />";            
        
        } else {
        
        print "
            Битрейт: ".$this->current['bitrate']." Кб/с<br />";            
        
        }

        print "
            Слушателей: ".$this->current['listeners']."<br />
            Пик слушателей: ".$this->current['listener_peak']."
            </nowrap>";
    
    }*/
    
}


//Непосредственно вывод

$output = new Icestat;
//заполнить данные
//пример: $output->getfile('юзер', 'пароль', 'сервер', 'порт');
$output->getfile($stream_admin, $stream_password, $stream_server, $stream_port);
$output->parsefile();
//$output->currentmount();
//$output->printcurrent();
 
//echo $output->current['title'];

//End of file
?>