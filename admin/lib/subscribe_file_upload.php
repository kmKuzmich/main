<?php
include_once 'slave_class.php';
class file_upload{
	function get_subscribe_id(){ if ($_POST["subscribe_id"]==""){return $_GET["subscribe_id"];} if ($_POST["subscribe_id"]!=""){return $_POST["subscribe_id"];} }
	
	function upload (){
		session_start();
		$ses_id=session_id();
		$subscribe_id=$this->get_subscribe_id();
		if ($subscribe_id==""){$file_dir=$ses_id;}
		if ($subscribe_id!=""){$file_dir=$subscribe_id;}
		$er = 0;
		if (is_uploaded_file($_FILES["file"]['tmp_name'])){ chmod ($_FILES["file"]['tmp_name'], 0755);
			$slave=new slave;
			$file_name=$slave->translit(basename( $_FILES['file']['name']));
			if (!file_exists("../../uploads/file/subscribe/".$file_dir)){mkdir("../../uploads/file/subscribe/".$file_dir,0755);}
			$file_path = "../../uploads/file/subscribe/$file_dir/$file_name";
			move_uploaded_file($_FILES["file"]['tmp_name'],$file_path);
		}
		if (!is_uploaded_file($_FILES["file"]['tmp_name'])){ $er=1; }
		return $this->show_form();
	}
	function drop_subscribe($subscribe_id){
		if (is_dir("../uploads/file/subscribe/$subscribe_id")) {
		    if ($dh = opendir("../uploads/file/subscribe/$subscribe_id")) {
        		while (($file = readdir($dh)) !== false) {
					if( $file != "." and $file != ".."){
						if (file_exists("../uploads/file/subscribe/$subscribe_id/$file")){unlink("../uploads/file/subscribe/$subscribe_id/$file");}
					}
		        }
        		closedir($dh);
	    	}
			rmdir("../uploads/file/subscribe/$subscribe_id");
		}
		return;
	}
	function drop_img ($code,$file){
		session_start();
		$subscribe_id=$this->get_subscribe_id();
		if (file_exists("../../uploads/file/subscribe/$subscribe_id/$file")){unlink("../../uploads/file/subscribe/$subscribe_id/$file");}
		return $this->show_form();
	}
	function show_form(){
		session_start();
		$ses_id=session_id();
		$subscribe_id=$this->get_subscribe_id();
		
		if ($subscribe_id==""){$file_dir=$ses_id;}
		if ($subscribe_id!=""){$file_dir=$subscribe_id;}
		
		$form="
		<form method='post' enctype='multipart/form-data'>
		<input type='hidden' name='w' value='upload_file'>
		<input type='hidden' name='subscribe_id' value='$subscribe_id'>
		<input type='file' style='width: 250px;' name='file'><input type='submit' value='Добавить'><br>
		</form>
		<span id='files'><table width='100%' border=1>";
		
		if (is_dir("../../uploads/file/subscribe/$file_dir")) {
		    if ($dh = opendir("../../uploads/file/subscribe/$file_dir")) {
        		while (($file = readdir($dh)) !== false) {
					if( $file != "." and $file != ".."){
						$size=filesize("../../uploads/file/subscribe/$file_dir/$file");
						$form.="
							<tr align='center'>
								<td><a href='?w=drop_img&model=$model&file=$file'><img src='../images/drop.png' border=0></a></td>
								<td align='left'>&nbsp; $file_dir/$file</td>
								<td align='right'>&nbsp; $size bytes</td>
							</tr>";
					}
		        }
        		closedir($dh);
	    	}
		}
		$form.="</table></span>";
		echo $form;
	} 
	function convert_files($subscribe_id){
		session_start();
		$ses_id=session_id();
		$file_dir=$subscribe_id;
		if (is_dir("../uploads/file/subscribe/$ses_id")) {
	    	if ($dh = opendir("../uploads/file/subscribe/$ses_id")) {
        		while (($file = readdir($dh)) !== false) {
					if( $file != "." and $file != ".."){
						if (!file_exists("../uploads/file/subscribe/".$file_dir)){mkdir("../uploads/file/subscribe/".$file_dir,0755);}
						copy("../uploads/file/subscribe/$ses_id/$file","../uploads/file/subscribe/$file_dir/$file");
						unlink ("../uploads/file/subscribe/$ses_id/$file");
					}
	    	    }
        		closedir($dh);
				rmdir("../uploads/file/subscribe/$ses_id");
	    	}
		}
		return true;
	}
	function show_file_list($file_dir){
		$form="
		<table width='100%' border=1>";
		if (is_dir("../uploads/file/subscribe/$file_dir")) {
		    if ($dh = opendir("../uploads/file/subscribe/$file_dir")) {
        		while (($file = readdir($dh)) !== false) {
					if( $file != "." and $file != ".."){
						$size=filesize("../uploads/file/subscribe/$file_dir/$file");
						$form.="
							<tr align='center'>
								<td align='left'>&nbsp; $file_dir/<strong>$file</strong></td>
								<td align='right' width='150'>&nbsp; <strong>$size bytes</strong></td>
							</tr>";
					}
		        }
        		closedir($dh);
    		}
		}
		$form.="</table>";
		return $form;
	}
}

if ($w=="upload_file"){ $fu=new file_upload; echo $fu->upload();}
if ($w=="show_form"){ $fu=new file_upload; echo $fu->show_form(); }
if ($w=="drop_subscribe"){ $fu=new file_upload; echo $fu->drop_subscribe($_GET["subscribe_id"],$_GET["file"]); }
?> 