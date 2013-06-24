<?php
# Playlist generator allows you to generate playlist's formats for the streaming.
#
# @category		i-SHCP
# @copyright	2013 by i-SHCP
# @author		Vilaliy Zhukov <dragonzx@yandex.ru>
# @license		http://www.gnu.org/licenses/gpl-2.0.html GPL v2
# @version		1.0.2
#
# Usage: playlist.php?name=playlist&pltype=m3u&stream=myradio.tld:8000/myradio

$type=$_GET['type'];
$pltype=$_GET['pltype'];
$stream=$_GET['stream'];
$name=$_GET['name'];

#Undefined varible check
if($type != "audio" and $type != "video"){$type="audio";}; //TODO
if($name == ""){$name="playlist";};
if($pltype != "m3u" 
and $pltype != "ram" 
and $pltype != "asx" 
and $pltype != "wpl"
and $pltype != "zpl"
and $pltype != "smil"
and $pltype != "pls"
and $pltype != "m3u8"
and $pltype != "xfps"
and $pltype != "qtl"
)
{$pltype="m3u";};

#Making the file
header("Content-Type: application/download; charset=utf-8");
header("Content-Disposition: attachment; filename=$name.$pltype");

# m3u/ram
if($pltype == "m3u" or $pltype == "ram"){echo("$stream");};

# asx
if($pltype == "asx")
{
print("<ASX version = \"3.0\">
<Entry>
<REF HREF=\"$stream\" />
</Entry>
</ASX>");
};

#wpl/smil
if($pltype == "wpl" or $pltype == "smil")
{
if($pltype == "smil") //The difference
{
print("<smil xmlns=\"http://www.w3.org/2001/SMIL20/Language\">");
} 
else 
{
print("<?wpl version=\"1.0\"?>
<smil>");
};
print(" <head>
        <meta name=\"Generator\" content=\"Microsoft Windows Media Player -- 11.0.5721.5145\" />
        <meta name=\"TotalDuration\" content=\"1102\" />
        <meta name=\"ItemCount\" content=\"1\" />
        <author/>
        <title>$name</title>
    </head>
    <body>
        <seq>
            <media src=\"$stream\" />
        </seq>
    </body>
</smil>");
};

#zpl
if($pltype == "zpl")
{
print("ac=$stream
nm=$stream
dr=-1
br!");
};

#pls
if($pltype == "pls")
{
print("[playlist]
File1=$stream
Title1=$name
NumberOfEntries=1
Version=2");
};

#m3u8
if($pltype == "m3u8")
{
print("#EXTM3U
#EXTINF:0,$name
#EXTVLCOPT:network-caching=1000
$stream");
};

#xfps
if($pltype == "xfps")
{
print("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<playlist version=\"1\" xmlns=\"http://xspf.org/ns/0/\">
  <trackList>
    <track>
      <title>$name</title>
      <location>$stream</location>
    </track>
  </trackList>
</playlist>");
};

#qtl
if($pltype == "qtl")
{
print("<?xml version=\"1.0\"?>
<?quicktime type=\"application/x-quicktime-media-link\"?>
<embed
autoplay=\"true\"
moviename=\"$name\"
src=\"$stream\"
/>");
};
?>
