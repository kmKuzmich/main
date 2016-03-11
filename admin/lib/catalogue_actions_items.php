<?php
error_reporting(E_ERROR);
@ini_set('display_errors', true);@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
include_once 'slave_class.php';
class file_upload{
	function get_model(){ if ($_POST["model"]==""){return $_GET["model"];} if ($_POST["model"]!=""){return $_POST["model"];} }
	
	function upload (){ include_once '../../lib/mysql_class.php'; session_start(); $ses_id=session_id(); $model=$this->get_model();	$er = 0;
		$file_dir=$ses_id; if ($model!=""){$file_dir=$model;}
		if (is_uploaded_file($_FILES["file"]['tmp_name'])){ chmod ($_FILES["file"]['tmp_name'], 0755);
			if (!file_exists("../../uploads/images/catalogue/".$file_dir)){mkdir("../../uploads/images/catalogue/".$file_dir,0755);}
			$db=new db;	$slave=new slave;
			$caption=$slave->qq($_POST["caption"]);$main=$slave->qq($_POST["main"]);$lenta=$slave->qq($_POST["lenta"]);
			$r=$db->query("select max(id) as mid from catalogue_galery;");$mid=$db->result($r,0,"mid")+1;
			$db->query("insert into catalogue_galery values('$mid','$file_dir','$caption','$main','$lenta');");
			move_uploaded_file($_FILES["file"]['tmp_name'],"../../uploads/images/catalogue/$file_dir/$mid.jpg");
		}
		if (!is_uploaded_file($_FILES["file"]['tmp_name'])){ $er=1; }
		return $this->show_form();
	}
	function drop_model($model){include_once '../lib/mysql_class.php';$db=new db;
		$r=$db->query("select id from catalogue_galery where cat='$model';");$n=$db->num_rows($r);
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			if (file_exists("../uploads/images/catalogue/$model/$id.jpg")){unlink("../uploads/images/catalogue/$model/$id.jpg");}
		}
		$db->query("delete from catalogue_galery where cat='$model';");
		return;
	}
	function drop_img ($model,$file){include_once '../../lib/mysql_class.php';session_start();$db=new db;
		$db->query("delete from catalogue_galery where id='$file';");
		if (file_exists("../../uploads/images/catalogue/$model/$file.jpg")){unlink("../../uploads/images/catalogue/$model/$file.jpg");}
		return $this->show_form();
	}
	function show_form(){include_once '../../lib/mysql_class.php';session_start();$db=new db;$ses_id=session_id();$model=$this->get_model();
		$file_dir=$ses_id;if ($model!=""){$file_dir=$model;}
		$form="
		<script type='text/javascript' src='../js/catalogue_actions/cat.js'></script>
		<script src='../js/wind_up/wind_up.js' type='text/javascript'></script>
		<form method='post' enctype='multipart/form-data'>
		<input type='hidden' name='w' value='upload_file'>
		<input type='hidden' name='action_id' value='$action_id'>
		<table width='100%' border=0 bgcolor='#ccCCCC' style='font:14px normal Tahoma;'><tr><td width='200' align='right'>Товар</td><td width='200'><input type='hidden' name='model' id='model' value='0'><span id='model_caption'> &nbsp; &mdash; &nbsp; </span> &nbsp; <a href='javascript:show_items_form(\"0\");'>Выберете модель</a></td><td width='200' align='right'>Цена для акции, $</td><td width='200'><input type='text' name='price' value='0' style='width:150px;'></td><td><input type='submit' value='Добавить'></td><td>&nbsp;</td></tr></table>
		</form><br />
		<table width='100%' border=0 bgcolor='#e6e6e6'>";$m=0;
		$r=$db->query("select * from catalogue_galery where cat='$file_dir' order by main,lenta asc;");$n=$db->num_rows($r);$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$main=$db->result($r,$i-1,"main");
			$lenta=$db->result($r,$i-1,"lenta");
			
			$img="<img src='../../thumb.php?image=catalogue/$file_dir/$id.jpg&size=150' border=0>";
			$edit_img="<img src='../images/edit.png' border=0>";
			$edit="?w=edit_img&model=$model&file=$id";
			$del_img="<img src='../images/drop.png' border=0>";
			$del="?w=drop_img&model=$model&file=$id";
			
			if ($m==1){$form.="<tr align='center'>";}
			$form.="<td align='center'>$img<br>$caption<br />поз: $lenta<br /><a href='$edit'>$edit_img</a><a href='$del'>$del_img</a></td>";
			if ($m==5){$form.="</tr>";$m=0;}
		}
		$form.="</table>";
		echo $form;
	}
	function edit_form($model,$file){include_once '../../lib/mysql_class.php';session_start();$db=new db;$ses_id=session_id();
		$file_dir=$ses_id;if ($model!=""){$file_dir=$model;}
		$r=$db->query("select * from catalogue_galery where id='$file' limit 0,1;");$n=$db->num_rows($r);
		if ($n==1){
			$caption=$db->result($r,0,"caption");
			$caption_en=$db->result($r,0,"caption_en");
			$main=$db->result($r,0,"main");$checked="";if ($main==1){$checked="checked=\"checked\"";}
			$lenta=$db->result($r,0,"lenta");
			$img="<img src='../../thumb.php?image=catalogue/$model/$file.jpg&size=80' border=0>";
		}
		$form="
		<form method='post' enctype='multipart/form-data'>
		<input type='hidden' name='w' value='save_img'>
		<input type='hidden' name='model' value='$model'>
		<input type='hidden' name='file_id' value='$file'>
		<table width='100%' align='left' border=0 bgcolor='#e6e6e6' style='font:14px normal Tahoma;'>
			<tr><td width='200' align='right'>Основная фотография</td><td width='50'><input type='checkbox' name='main' value='1' $checked></td></tr>
			<tr><td width='200' align='right'>Позиция</td><td width='200'><input type='text' name='lenta' value='$lenta' style='width:60px;'></td></tr>
			<tr><td width='200' align='right'>Подпись фотографии</td><td width='200'><input type='text' name='caption' value='$caption' style='width:180px;'></td></tr>
			<tr><td align='right' width='100'>Имя файла</td><td width='250'><input type='file' style='width: 250px;' name='file'></td></tr>
			<tr><td align='right' width='100'>Текущий файл</td><td width='250'>$img</td></tr>
			<tr><td align='right'><input type='submit' value='Сохранить'></td><td><input type='button' value='Отмена' onclick='location.href=\"?w=show_form&model=$model\"'></td></tr>
		</table>
		</form>";
		echo $form;
	}
	function edit_save(){ include_once '../../lib/mysql_class.php'; session_start(); $ses_id=session_id();	$er = 0; $db=new db;	$slave=new slave;
		$caption=$slave->qq($_POST["caption"]);$main=$_POST["main"];$lenta=$slave->qq($_POST["lenta"]);$file_id=$_POST["file_id"];$model=$_POST["model"];
		$db->query("update catalogue_galery set caption='$caption',  main='$main', lenta='$lenta' where id='$file_id';");
		$file_dir=$ses_id; if ($model!=""){$file_dir=$model;}

		if (is_uploaded_file($_FILES["file"]['tmp_name'])){ chmod ($_FILES["file"]['tmp_name'], 0755);
			if (!file_exists("../../uploads/images/catalogue/".$file_dir)){mkdir("../../uploads/images/catalogue/".$file_dir,0755);}
			move_uploaded_file($_FILES["file"]['tmp_name'],"../../uploads/images/catalogue/$file_dir/$file_id.jpg");
		}
		return $this->show_form();
	}
	function convert_files($model){session_start();$db=new db;$ses_id=session_id();$file_dir=$model;
		if (is_dir("../uploads/images/catalogue/$ses_id")) {
	    	if ($dh = opendir("../uploads/images/catalogue/$ses_id")) {
        		while (($file = readdir($dh)) !== false) {
					if( $file != "." and $file != ".."){
						if (!file_exists("../uploads/images/catalogue/".$file_dir)){mkdir("../uploads/images/catalogue/".$file_dir,0755);}
						copy("../uploads/images/catalogue/$ses_id/$file","../uploads/images/catalogue/$file_dir/$file");
						unlink ("../uploads/images/catalogue/$ses_id/$file");
					}
	    	    }
        		closedir($dh);
				rmdir("../uploads/images/catalogue/$ses_id");
	    	}
		}
		$db->query("update catalogue_galery set cat='$model' where cat='$ses_id';");
		return true;
	}
}
if ($w=="upload_file"){ $fu=new file_upload; echo $fu->upload();}
if ($w=="show_form"){ $fu=new file_upload; echo $fu->show_form(); }
if ($w=="drop_img"){ $fu=new file_upload; echo $fu->drop_img($_GET["model"],$_GET["file"]); }
if ($w=="edit_img"){ $fu=new file_upload; echo $fu->edit_form($_GET["model"],$_GET["file"]); }
if ($w=="save_img"){ $fu=new file_upload; echo $fu->edit_save($_GET["model"],$_GET["file"]); }
?> 