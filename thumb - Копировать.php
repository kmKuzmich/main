<?php

error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', false);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);


define('RD', dirname (__FILE__));

function create_image_thumb($thumb,$thumb_url,$size,$height,$bl=0){if ($bl==""){$bl=0;}
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	$er=1;
	if ($thumb!=""){ if (file_exists("uploads/images/$thumb")){$img_src="uploads/images/$thumb"; $er=0;}}
	if ($thumb_url!=""){ if (file_exists("http://avtolider-ua.com/uploads/images/$thumb")){$img_src="http://avtolider-ua.com/uploads/images/$thumb"; $er=0;}}
	if ($er==1){$img_src="uploads/images/nofoto.jpg";$er=0;}
	
	if ($er==0){
		$sizes = getimagesize($img_src);if ($size==""){$size=$sizes[0];}
		$aspect_ratio = $sizes[0]/$sizes[1];  $type=$sizes[2];
		if ($sizes[0]>=$sizes[1]){
			if ($sizes[0] <= $size){
				$new_width = $sizes[0];
				$new_height = $sizes[1];
			}else{
				$new_width = $size;
				$new_height = abs($new_width/$aspect_ratio);
			}
		}
		if ($sizes[0]<$sizes[1]){
			if ($sizes[1] <= $size){
				$new_width = $sizes[0];
				$new_height = $sizes[1];
			}else{
				$new_height = $size;
				$new_width = abs($new_height*$aspect_ratio);
			}
		}
		if ($new_height<$size){
			$new_height = $size;
			$new_width = abs($new_height*$aspect_ratio);
			
		}
		if ($new_width<$size){
			$new_width = $size;
			$new_height = abs($new_width/$aspect_ratio);
		}
		header("Content-Type:image/jpg");
		$destimg=imagecreatetruecolor($new_width,$new_height);
		$destimg=imagecreatetruecolor($new_width,$new_height);
		if ($type==1){	$srcimg=ImageCreateFromGIF($img_src); }
		if ($type==2){	$srcimg=ImageCreateFromJPEG($img_src); }
		if ($type==3){	$srcimg=ImageCreateFromPNG($img_src); }
		if ($type==4){ 	$srcimg=ImageCreateFromWBMP($img_src); }
		if ($type==6){ 	$srcimg=ImageCreateFromWBMP($img_src); }
		imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
		if ($bl!=1){
			ImageJPEG($destimg,$prod_img,100);		
			ImageDestroy ($destimg);
		}
		if ($bl==1){
			$tlx = floor(($new_width / 2)-($size / 2) );
    	    $tly = floor(($new_height / 2)-($size/ 2));
		
			$resimg=imagecreatetruecolor($size,$size);
			imagecopyresampled($resimg,$destimg,0,0,$tlx,$tly,$size,$size,$size,$size);
			ImageJPEG($resimg,$prod_img,100);		
			ImageDestroy ($resimg);
		}
	}
}
if ($_GET["image"]!="" or $_GET["image_url"]!=""){ create_image_thumb($_GET["image"],$_GET["image_url"],$_GET["size"],$_GET["height"],$_GET["bl"]);}
?>