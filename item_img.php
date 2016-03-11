<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
function file_post_contents($url,$headers=false) {
    $url = parse_url($url);
    if (!isset($url['port'])) {
      if ($url['scheme'] == 'http') { $url['port']=80; }
      elseif ($url['scheme'] == 'https') { $url['port']=443; }
    }
    $url['query']=isset($url['query'])?$url['query']:'';
    $url['protocol']=$url['scheme'].'://';
    $eol="\r\n";
    $headers =  "POST ".$url['protocol'].$url['host'].$url['path']." HTTP/1.0".$eol.
                "Host: ".$url['host'].$eol.
                "Referer: ".$url['protocol'].$url['host'].$url['path'].$eol.
                "Content-Type: application/x-www-form-urlencoded".$eol.
                "Content-Length: ".strlen($url['query']).$eol.
                $eol.$url['query'];
    $fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 30);
    if($fp) {
      fputs($fp, $headers);
      $result = '';$i=0;
      while(!feof($fp)) {$i++; $data=fgets($fp, 128);if ($i==4){$file_name=$data;} if ($i>9){$result.=$data; }}
      fclose($fp);
	  $file_name=str_replace('Content-Disposition: attachment;filename="','','image.png');
	  $file_name=substr($file_name,0,-3);
	  print "result=$result";
	  if ($result!=""){ $im=imagecreatefromstring($result);}
	  if ($result==""){ $im=ImageCreateFromPNG("/uploads/images/spacer.png");}
	  if ($im !== false) {
	    header('Content-Type: image/png');
    	imagepng($im);
	    imagedestroy($im);
	  }
    }
}
if ($_GET["item_id"]!="" and $_GET["doc_id"]!=""){ file_post_contents("http://webservicepilot.tecdoc.net/pegasus-2-0/documents/20122/".$_GET["doc_id"]."/0");}
?>