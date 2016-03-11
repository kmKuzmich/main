<?php
define('RD', dirname (__FILE__));
require_once ("../lib/mysql_class.php");

function create_model_thumb($brand){
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
//	header("Content-Type:image/jpg");
	$size=60;$max_height=60;
	$db= new db; $er=1;
	$r=$db->query("select count(id) as kol from model where brand='$brand';");
	$kol=$db->result($r,0,"kol");
	while($er==1){
		$nom=rand(1,$kol);
		$r=$db->query("select id from model where brand='$brand' limit $nom,1;");
		$n=$db->num_rows($r);
		if ($n>0){
			$id=$db->result($r,0,"id");
			if (file_exists("../uploads/images/catalogue/g_$id.jpg")){$img_src="../uploads/images/catalogue/g_$id.jpg"; $er=0;}
		}
	}
	if ($er==0){
		$sizes = getimagesize($img_src);
		$aspect_ratio = $sizes[0]/$sizes[1]; 
		$type=$sizes[2];header("Content-Type:image/$type");
		if ($sizes[0]>=$sizes[1]){$size=90;
			if ($sizes[0] <= $size){
				$new_width = $sizes[0];
				$new_height = $sizes[1];
			}else{
				$new_width = $size;
				$new_height = abs($new_width/$aspect_ratio);
			}
		}
		if ($sizes[0]<$sizes[1]){$size=60;
			if ($sizes[1] <= $size){
				$new_width = $sizes[0];
				$new_height = $sizes[1];
			}else{
				$new_height = $size;
				$new_width = abs($new_height*$aspect_ratio);
			}
		}
		if ($new_height>$max_height){
			$new_height = $max_height;
			$new_width = abs($new_height*$aspect_ratio);
		}
		
		$destimg=imagecreatetruecolor($new_width,$new_height);
		
		if ($type==1){	$srcimg=ImageCreateFromGIF($img_src); }
		if ($type==2){	$srcimg=ImageCreateFromJPEG($img_src); }
		if ($type==3){	$srcimg=ImageCreateFromPNG($img_src); }
		if ($type==4){	$srcimg=ImageCreateFromWBMP($img_src); }
		
		imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));

		$newwidth=90;
		$newheight=60;
		$newimg=imagecreatetruecolor($newwidth, $newheight);
		$white = imagecolorallocate($newimg, 255, 255, 255);
		$gray = imagecolorallocate($newimg, 165, 173, 152);

		imagefilledrectangle($newimg, 0, 0, $newwidth, $newheight, $white);
		$startx=($newwidth-$new_width)/2;
		$starty=($newheight-$new_height)/2;
		imagecopy($newimg, $destimg, $startx, $starty, 0, 0, $new_width,$new_height);
		imagerectangle($newimg, 0, 0, $newwidth-1, $newheight-1, $gray);
		
		if ($type==1){ ImageGIF($newimg,$prod_img_thumb,100);  }
		if ($type==2){	ImageJPEG($newimg,$prod_img_thumb,100); }
		if ($type==3){	ImagePNG($newimg,$prod_img_thumb,0,100); }
		if ($type==4){	ImageWBMP($newimg,$prod_img_thumb,100); }
		
		
		ImageDestroy ($destimg);
	}
}

function create_thumb($thumb,$size){
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	$er=1;
	if (file_exists("../uploads/images/catalogue/$thumb.jpg")){$img_src="../uploads/images/catalogue/$thumb.jpg"; $er=0;}
	if (file_exists("../uploads/images/catalogue/$thumb.gif")){$img_src="../uploads/images/catalogue/$thumb.gif"; $er=0;}
	if (file_exists("../uploads/images/catalogue/$thumb.png")){$img_src="../uploads/images/catalogue/$thumb.png"; $er=0;}
	if ($er==1){$img_src="../uploads/images/catalogue/nofoto.jpg";$er=0;}
	
	if ($er==0){
		$sizes = getimagesize($img_src);
		$aspect_ratio = $sizes[0]/$sizes[1]; 
		$type=$sizes[2];header("Content-Type:image/$type");
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
		if ($new_height>$size){
			$new_height = $size;
			$new_width = abs($new_height*$aspect_ratio);
		}
		$destimg=imagecreatetruecolor($new_width,$new_height);
		if ($type==1){	$srcimg=ImageCreateFromGIF($img_src); }
		if ($type==2){	$srcimg=ImageCreateFromJPEG($img_src); }
		if ($type==3){	$srcimg=ImageCreateFromPNG($img_src); }
		if ($type==4){	$srcimg=ImageCreateFromWBMP($img_src); }
		imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
		$black = imagecolorallocate($destimg, 0, 0, 0);
		if ($type==1){  imagecolortransparent($destimg, $black);  ImageGIF($destimg,$prod_img_thumb,100);  }
		if ($type==2){	ImageJPEG($destimg,$prod_img_thumb,100); }
		if ($type==3){	imagecolortransparent($destimg, $black);ImagePNG($destimg,$prod_img_thumb,100); }
		if ($type==4){	ImageWBMP($destimg,$prod_img_thumb,100); }
		ImageDestroy ($destimg);
	}
}

function create_model($model,$file,$size){
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	$er=1;
	if (file_exists("../uploads/images/catalogue/$model/$file")){$img_src="../uploads/images/catalogue/$model/$file"; $er=0;}
	if ($er==1){$img_src="../uploads/images/catalogue/nofoto.jpg";$er=0;}
	
	if ($er==0){
		$sizes = getimagesize($img_src);
		$aspect_ratio = $sizes[0]/$sizes[1]; 
		$type=$sizes[2];header("Content-Type:image/$type");
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
		if ($new_height>$size){
			$new_height = $size;
			$new_width = abs($new_height*$aspect_ratio);
		}
		$destimg=imagecreatetruecolor($new_width,$new_height);
		$black = imagecolorallocate($destimg, 0, 0, 0);
		if ($type==1){	$srcimg=ImageCreateFromGIF($img_src); }
		if ($type==2){	$srcimg=ImageCreateFromJPEG($img_src); }
		if ($type==3){	$srcimg=ImageCreateFromPNG($img_src); }
		if ($type==4){	$srcimg=ImageCreateFromWBMP($img_src); }
		imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
		if ($type==1){  imagecolortransparent($destimg, $black); ImageGIF($destimg,NULL,100);  }
		if ($type==2){	ImageJPEG($destimg,$prod_img_thumb,100); }
		if ($type==3){	imagecolortransparent($destimg, $black);ImagePNG($destimg,NULL,100); }
		if ($type==4){	ImageWBMP($destimg,$prod_img_thumb,100); }
		ImageDestroy ($destimg);
	}
}
function create_image_thumb($thumb,$size){
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	$er=1;
	if (file_exists("../$thumb")){$img_src="../$thumb"; $er=0;}
	if ($er==1){$img_src="../uploads/images/catalogue/nofoto.jpg";$er=0;}
	
	if ($er==0){
		$sizes = getimagesize($img_src);
		$aspect_ratio = $sizes[0]/$sizes[1]; 
		$type=$sizes[2];header("Content-Type:image/$type");
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
		if ($new_height>$size){
			$new_height = $size;
			$new_width = abs($new_height*$aspect_ratio);
		}
		$destimg=imagecreatetruecolor($new_width,$new_height);
		if ($type==1){	$srcimg=ImageCreateFromGIF($img_src); }
		if ($type==2){	$srcimg=ImageCreateFromJPEG($img_src); }
		if ($type==3){	$srcimg=ImageCreateFromPNG($img_src); }
		if ($type==4){	$srcimg=ImageCreateFromWBMP($img_src); }
		imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
		$black = imagecolorallocate($destimg, 0, 0, 0);
		if ($type==1){ imagecolortransparent($destimg, $black); ImageGIF($destimg,$prod_img_thumb,100);  }
		if ($type==2){	ImageJPEG($destimg,$prod_img_thumb,100); }
		if ($type==3){	imagecolortransparent($destimg, $black);ImagePNG($destimg,$prod_img_thumb,100); }
		if ($type==4){	ImageWBMP($destimg,$prod_img_thumb,100); }
		ImageDestroy ($destimg);
	}
}

function create_logo_thumb($thumb){
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	$er=1;$size=100;
	if (file_exists("../uploads/images/catalogue/logo/$thumb.jpg")){$img_src="../uploads/images/catalogue/logo/$thumb.jpg"; $er=0;}
	if ($er==1){$img_src="../theme/images/logo.jpg";$er=0;}
	if ($er==0){
		$sizes = getimagesize($img_src);
		$aspect_ratio = $sizes[0]/$sizes[1]; 
		$type=$sizes[2];header("Content-Type:image/$type");
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
		if ($new_height>25){
			$new_height =25;
			$new_width = abs($new_height*$aspect_ratio);
		}
		$destimg=imagecreatetruecolor($new_width,$new_height);
		if ($type==1){	$srcimg=ImageCreateFromGIF($img_src); }
		if ($type==2){	$srcimg=ImageCreateFromJPEG($img_src); }
		if ($type==3){	$srcimg=ImageCreateFromPNG($img_src); }
		if ($type==4){	$srcimg=ImageCreateFromWBMP($img_src); }
		imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
		$black = imagecolorallocate($destimg, 0, 0, 0);
		if ($type==1){ imagecolortransparent($destimg, $black); ImageGIF($destimg,$prod_img_thumb,100);  }
		if ($type==2){	ImageJPEG($destimg,$prod_img_thumb,100); }
		if ($type==3){	imagecolortransparent($destimg, $black);ImagePNG($destimg,$prod_img_thumb,0,100); }
		if ($type==4){	ImageWBMP($destimg,$prod_img_thumb,100); }
		ImageDestroy ($destimg);
	}
}
if ($_GET["logo"]!=""){ create_logo_thumb($_GET["logo"]);}
if ($_GET["image"]!=""){ create_image_thumb($_GET["image"],$_GET["size"]);}
if ($_GET["thumb"]!=""){ create_thumb($_GET["thumb"],$_GET["size"]);}
//if ($_GET["model"]!=""){ create_model_thumb($_GET["model"],$_GET["status"]);}
if ($_GET["file"]!=""){ create_model($_GET["model"],$_GET["file"],$_GET["size"]);}
?>