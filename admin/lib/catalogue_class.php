<?php
class catalogue {
	function get_top_id(){ if ($_POST["top_id"]==""){return $_GET["top_id"];} if ($_POST["top_id"]!=""){return $_POST["top_id"];} }
	function get_cat_id(){ if ($_POST["cat_id"]==""){return $_GET["cat_id"];} if ($_POST["cat_id"]!=""){return $_POST["cat_id"];} }
	
	function get_caption(){ if ($_POST["caption"]==""){return $_GET["caption"];} if ($_POST["caption"]!=""){return $_POST["caption"];} }
	function get_mod_id(){ if ($_POST["mod_id"]==""){return $_GET["mod_id"];} if ($_POST["mod_id"]!=""){return $_POST["mod_id"];} }
	function get_sp(){ if ($_POST["sp"]==""){return $_GET["sp"];} if ($_POST["sp"]!=""){return $_POST["sp"];} }
	function get_rp(){ if ($_POST["rp"]==""){return $_GET["rp"];} if ($_POST["rp"]!=""){return $_POST["rp"];} }
	function get_sl(){ if ($_POST["sl"]==""){return $_GET["sl"];} if ($_POST["sl"]!=""){return $_POST["sl"];} }
	function get_bs(){ if ($_POST["bs"]==""){return $_GET["bs"];} if ($_POST["bs"]!=""){return $_POST["bs"];} }
	
	function show_search_form(){session_start();$db=new db;$slave=new slave;$w=$slave->get_w();$mdl=new module;		$file=$slave->get_file();
		$form_htm=RD."/tpl/catalogue_search_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$pst=$_POST["pst"];
		if ($pst=="search"){
			$mod_id=$slave->qqback($_POST["mod_id"]);$_SESSION["mod_id"]=$mod_id;
			$sp=$slave->qqback($_POST["sp"]);$_SESSION["sp"]=$sp;
			$rp=$slave->qqback($_POST["rp"]);$_SESSION["rp"]=$rp;
			$sl=$slave->qqback($_POST["sl"]);$_SESSION["sl"]=$sl;
			$bs=$slave->qqback($_POST["bs"]);$_SESSION["bs"]=$bs;
			$caption=$slave->qqback($_POST["caption"]);$_SESSION["caption"]=$caption;
			$_SESSION["ses_file"]=$file;
		}
		if ($pst==""){ $ses_file=$_SESSION["ses_file"];
			if ($ses_file==$file){
				$mod_id=$_SESSION["mod_id"];
				$caption=$_SESSION["caption"];
				$sp=$_SESSION["sp"];
				$rp=$_SESSION["rp"];
				$sl=$_SESSION["sl"];
				$bs=$_SESSION["bs"];
			}
			if ($ses_file!=$file){
				$_SESSION["mod_id"]="";
				$_SESSION["caption"]="";
				$_SESSION["sp"]="";
				$_SESSION["rp"]="";
				$_SESSION["sl"]="";
				$_SESSION["bs"]="";
			}
		}
		if ($sp=="1") {$sp_checked="checked";}if ($sp!="1") {$sp_checked="";}
		if ($rp=="1") {$rp_checked="checked";}if ($rp!="1") {$rp_checked="";}
		if ($sl=="1") {$sl_checked="checked";}if ($sl!="1") {$sl_checked="";}
		if ($bs=="1") {$bs_checked="checked";}if ($bs!="1") {$bs_checked="";}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form = str_replace("{w}", $w, $form);
		$form = str_replace("{mod_id}", $mod_id, $form);
		$form = str_replace("{caption}", $caption, $form);
		$form = str_replace("{sp_checked}", $sp_checked, $form);
		$form = str_replace("{rp_checked}", $rp_checked, $form);
		$form = str_replace("{sl_checked}", $sl_checked, $form);
		$form = str_replace("{bs_checked}", $bs_checked, $form);
		return $form;
	}
	function show_catalogue_tree($cat_id){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$form_htm=RD."/tpl/catalogue_tree.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		if ($cat_id==""){$cat_id="0";}$k=0;
		$r=$db->query("select * from catalogue where top_id='$cat_id' and ison='1' order by is_folder,id asc;"); $n=$db->num_rows($r);$list="";
		if ($n>0){
			for ($i=1;$i<=$n;$i++){ $k++;
				$id=$db->result($r,$i-1,"id");
				$top_id=$db->result($r,$i-1,"top_id");
				$caption=$db->result($r,$i-1,"caption");
				$short_caption=$db->result($r,$i-1,"short_caption");
				$show_model="";if ($this->check_folder_nex_level($id)==2){ $show_model="&w=show_model_menu";}
				$tr_color="ffffff";	if ($k==2){$tr_color="f5f5f5"; $k=0;}
				$img="-";if (file_exists("../uploads/images/catalogue/$id.jpg")){$img="+";}
				$list.="
				<tr bgcolor='#$tr_color'>
					<th><a href='?$url&w=edit_folder&top_id=$top_id&cat_id=$id'><img src='images/edit.png' border=0 title='Редактировать' alt='Редактировать'></a></th>
					<th><a href='?$url&w=folder_params&top_id=$top_id&cat_id=$id'><img src='images/collapsed_button.gif' border=0 title='Параметры' alt='Параметры'></a></th>
					<th><a href='#' onclick=\"if(confirm('Удалить раздел?')){ window.location.href='?$url&w=delete_folder&conf=true&top_id=$cat_id&cat_id=$id'}\"><img src='images/drop.png' border=0></a></th>
					<th>$i</th>
					<td><a href='?$url$show_model&top_id=$top_id&cat_id=$id'>$short_caption</a></td>
					<td><a href='?$url$show_model&top_id=$top_id&cat_id=$id'>$caption</a></td>
					<th>$img</th>
					<th>$desc</th>
				</tr>";
			}
		}
		$form=str_replace("{list}", $list, $form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{menu}",$this->show_menu("","visible"),$form);
		$form=str_replace("{search_form}",$this->show_search_form(),$form);
		return $form;
	}
	
	function show_folder_params($top_id,$cat_id){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$form_htm=RD."/tpl/catalogue_param_list.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		if ($cat_id==""){$cat_id="0";}$k=0;
		$r=$db->query("select * from catalogue_params where cat_id='$cat_id' order by lenta asc;");$n=$db->num_rows($r);$list="";
		if ($n>0){
			for ($i=1;$i<=$n;$i++){ $k++;
				$id=$db->result($r,$i-1,"id");
				$type=$db->result($r,$i-1,"type");$type_caption=$this->get_param_type_caption($type);
				$caption=$db->result($r,$i-1,"caption");
				$tr_color="ffffff";if ($k==2){$tr_color="f5f5f5"; $k=0;}
				$list.="
				<tr bgcolor='#$tr_color'>
					<th><a href='?$url&w=edit_param&top_id=$top_id&cat_id=$cat_id&param_id=$id'><img src='images/edit.png' border=0 title='Редактировать' alt='Редактировать'></a></th>
					<th><a href='#' onclick=\"if(confirm('Удалить параметры?')){ window.location.href='?$url&w=delete_param&conf=true&top_id=$top_id&cat_id=$cat_id&param_id=$id'}\"><img src='images/drop.png' border=0></a></th>
					<th>$i</th>
					<td>$type_caption</a></td>
					<td>$caption</a></td>
				</tr>";
			}
		}
		$form=str_replace("{list}", $list, $form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{menu}",$this->show_param_menu(""),$form);
		return $form;
	}
	function show_model_menu($cat_id){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$form_htm=RD."/tpl/catalogue_model_tree.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$caption=$this->get_caption();if ($caption==""){$caption=$_SESSION["caption"];}
		$mod_id=$this->get_mod_id();if ($mod_id==""){$mod_id=$_SESSION["mod_id"];}
		
		$sp=$this->get_sp();if ($sp==""){$sp=$_SESSION["sp"];}
		$rp=$this->get_rp();if ($rp==""){$rp=$_SESSION["rp"];}
		$sl=$this->get_sl();if ($sl==""){$sl=$_SESSION["sl"];}
		$bs=$this->get_bs();if ($bs==""){$bs=$_SESSION["bs"];}
		
		$where="";
		//-----------
		if ($mod_id!=""){$where.=" id = '$mod_id'";}
		if ($caption!=""){$where.=" and caption LIKE '%$caption%' ";}
		if ($sp=="1"){$where.=" and special_offer!='0'";}
		if ($rp=="1"){$where.=" and red_price='1'";}
		if ($sl=="1"){$where.=" and sale='1'";}
		if ($bs=="1"){$where.=" and best='1'";}

		if ($where==""){$where=" and top_id='$cat_id'";}
		
		if ($cat_id==""){$cat_id="0";}$k=0;
		$r=$db->query("select * from catalogue where ison>'0' $where order by id,ison asc;");$n=$db->num_rows($r);$list="";
		if ($n>0){
			for ($i=1;$i<=$n;$i++){ $k++;
				$id=$db->result($r,$i-1,"id");
				$top_id=$db->result($r,$i-1,"top_id");
				$code=$db->result($r,$i-1,"code");
				$short_caption=$db->result($r,$i-1,"short_caption");
				$caption=$db->result($r,$i-1,"caption");
				$price1=$slave->int_to_money($db->result($r,$i-1,"price1"));
				$special_offer=$db->result($r,$i-1,"special_offer");$sp="-";if ($special_offer!="0"){$sp="+";}
				$red_price=$db->result($r,$i-1,"red_price");$rp="-";if ($red_price=="1"){$rp="+";}
				$sale=$db->result($r,$i-1,"sale");$sl="-";if ($sale=="1"){$sl="+";}
				$desc=$this->check_catalogue_desc($id);
				$ison=$db->result($r,$i-1,"ison");
				$tr_color="ffffff";if ($k==2){$tr_color="f5f5f5"; $k=0;}if ($ison=="9"){$tr_color="grey"; $k=0;}
				$img=$this->check_model_img($id);
				$list.="
				<tr bgcolor='#$tr_color'>
					<th><a href='?$url&w=edit_model&model=$id&top_id=$top_id&cat_id=$cat_id'><img src='images/edit.png' border=0 title='Редактировать' alt='Редактировать'></a></th>
					<th><a href='?$url&w=copy_model&model=$id&top_id=$top_id&cat_id=$cat_id'><img src='images/copy.png' border=0 title='Копировать' alt='Копировать'></a></th>";
					if ($ison=="1"){$list.="
					<th><a href='#' onclick=\"if(confirm('Списать модель?')){ window.location.href='?$url&w=arch_model&conf=true&model=$id&top_id=$top_id&cat_id=$cat_id'}\"><img src='images/arch.png' border=0></a></th>";}
					if ($ison!="1"){$list.="
					<th><a href='#' onclick=\"if(confirm('Активировать модель?')){ window.location.href='?$url&w=dearch_model&conf=true&model=$id&top_id=$top_id&cat_id=$cat_id'}\"><img src='images/dearch.png' border=0></a></th>"; }
				$list.="
					<th>$i</th>
					<td>$code</td>
					<td>$short_caption</td>
					<td>$caption</td>
					<td align='right'>$price1 &nbsp; </td>
					<th>$sp</th>
					<th>$rp</th>
					<th>$sl</th>
					<th>$img</th>
					<th>$desc</th>
					<th><a href='#' onclick=\"if(confirm('Удалить модель?')){ window.location.href='?$url&w=delete_model&conf=true&model=$id&top_id=$top_id&cat_id=$cat_id'}\"><img src='images/drop.png' border=0></a></th>
				</tr>";
			}
		}
		$form=str_replace("{list}", $list, $form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{menu}",$this->show_menu("","hidden"),$form);
		$form=str_replace("{search_form}",$this->show_search_form(),$form);
		return $form;
	}
	function check_folder_nex_level($cat_id){$db=new db; if ($cat_id==""){$cat_id="0";}$next=1;
		$r=$db->query("select id from catalogue where top_id='$cat_id' and ison='1' and is_folder='2' order by is_folder,caption,id asc limit 0,1;");$n=$db->num_rows($r);if ($n>0){ $model_ex=2;}if ($n==0){ $model_ex=1;}
		$r=$db->query("select id from catalogue where top_id='$cat_id' and ison='1' and is_folder='1' order by is_folder,caption,id asc limit 0,1;");$n=$db->num_rows($r);if ($n>0){ $folder_ex=2;}if ($n==0){ $folder_ex=1;}
		if ($model_ex==2 and $folder_ex==1){return 2;}
		if ($model_ex==1 and $folder_ex==1){return 1;}
		if ($model_ex==2 and $folder_ex==2){return 1;}
		if ($model_ex==1 and $folder_ex==2){return 1;}
	}
	function check_catalogue_desc($id){ $db=new db;
		$r=$db->query("select * from catalogue where id='$id' limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){ 
			$short_desc=$db->result($r,0,"short_desc");
			$desc=$db->result($r,0,"desc");
			$few_words=$db->result($r,0,"few_words");
			$desc_more=$db->result($r,0,"desc_more");
			$fw="-";if ($few_words!=""){$fw="+";}
			$de="-";if ($desc!=""){$de="+";}
			$sd="-";if ($short_desc!=""){$sd="+";}
			$dm="-";if ($desc_more!=""){$dm="+";}
			return"$fw/$sd/$de/$dm";
		}
		if ($n==0){return"-/-/-/-";}
	}
	function get_max_provider_id(){ $db=new db; $r=$db->query("select max(id) as mid from catalogue_provider;"); return $db->result($r,0,"mid")+1; }
	function get_max_catalogue_id(){ $db=new db; $r=$db->query("select max(id) as mid from catalogue;"); return $db->result($r,0,"mid")+1; }
	function get_max_catalogue_param_id(){ $db=new db; $r=$db->query("select max(id) as mid from catalogue_params;"); return $db->result($r,0,"mid")+1; }
	function get_is_folder($cat_id){ $db=new db; 
		$r=$db->query("select is_folder from catalogue where id='$cat_id' limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){  return $db->result($r,0,"is_folder");}
		if ($n==0){ return 1;}
	}
	function find_top_id($cat_id){ $db=new db; if ($cat_id==""){$cat_id="0";}
		$r=$db->query("select top_id from catalogue where id='$cat_id' and ison='1' limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"top_id");}
		if ($n==0){ return "0";}
	}
	function get_catalogue_caption($id){$db=new db;
		$r=$db->query("select caption from catalogue where id='$id' limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"caption");}
		if ($n==0){ return "0";}
	}
	function check_model_img($model){$db=new db; $r=$db->query("select count(id) as kol from catalogue_galery where cat='$model';");return $db->result($r,0,"kol"); }
	function new_folder_form($top_id){ $db=new db; $slave=new slave;if ($top_id==""){$top_id=0;}
		$form_htm=RD."/tpl/catalogue_folder_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Создать", $form);

		$form=str_replace("{top_menu}", "", $form);
		$form=str_replace("{top_id}", $top_id, $form);
		$form=str_replace("{cat_id}", "", $form);
		$form=str_replace("{lenta}", "9999", $form);
		$form=str_replace("{short_caption}", "", $form);
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{keywords}", "", $form);
		$form=str_replace("{seo_info}", "", $form);
		include_once "lib/articles_class.php";$articles=new articles;$form=str_replace("{articles_form}", $articles->show_arttheme_form(""), $form);
		$form=str_replace("{navigation}",$this->show_navigation($top_id,""),$form);
		return $form;
	}
	function add_folder_form(){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$top_id=$_POST["top_id"]; $lenta=$slave->qq($_POST["lenta"]); if ($top_id==""){$top_id=0;}$articles=$slave->qq($_POST["articles"]);$top_menu=$_POST["top_menu"];
		$caption=$slave->qq($_POST["caption"]); $short_caption=$slave->qq($_POST["short_caption"]); $keywords=$slave->qq($_POST["keywords"]); $seo_info=$slave->qq($_POST["seo_info"]);
		$mid=$this->get_max_catalogue_id();
		$db->query("insert into catalogue (`id`,`top_id`,`main_menu`,`short_caption`,`caption`,`seo_info`,`keywords`,`lenta`,`ison`,`update`,`is_folder`) values('$mid','$top_id','$top_menu','$short_caption','$caption','$seo_info','$keywords','$lenta','1',CURDATE(),'1');");
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Раздел &quot;$caption&quot; успешно создано";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку разделов",$form);
		$form=str_replace("{back_url}","?$url&top_id=$top_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function edit_folder_form($top_id,$cat_id){ $db=new db; $slave=new slave;
		$r=$db->query("select * from catalogue where id='$cat_id';");$n=$db->num_rows($r);
		if ($n>0){
			$lenta=$slave->qqback_in($db->result($r,0,"lenta"));
			$main_menu=$slave->qqback_in($db->result($r,0,"main_menu"));if ($main_menu==1){$tmenu=" checked=\"checked\"";}
			$short_caption=$slave->qqback_in($db->result($r,0,"short_caption"));
			$caption=$slave->qqback_in($db->result($r,0,"caption"));
			$keywords=$slave->qqback_in($db->result($r,0,"keywords"));
			$seo_info=$slave->qqback_in($db->result($r,0,"seo_info"));
			$articles_id=$db->result($r,0,"articles");
		}
		$form_htm=RD."/tpl/catalogue_folder_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Редактировать", $form);
		$form=str_replace("{top_id}", $top_id, $form);
		$form=str_replace("{cat_id}", $cat_id, $form);
		$form=str_replace("{top_menu}", $tmenu, $form);
		$form=str_replace("{short_caption}", $short_caption, $form);
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{keywords}", $keywords, $form);
		$form=str_replace("{seo_info}", $seo_info, $form);
		$form=str_replace("{lenta}", $lenta, $form);
		include_once "lib/articles_class.php";$articles=new articles;
		$form=str_replace("{articles_form}", $articles->show_arttheme_form($articles_id), $form);
		$form=str_replace("{navigation}",$this->show_navigation($top_id,""),$form);
		return $form;
	}
	function save_folder_form(){ $db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$cat_id=$_POST["cat_id"];$top_id=$_POST["top_id"];$lenta=$slave->qq($_POST["lenta"]); if ($top_id==""){$top_id=0;}$articles=$slave->qq($_POST["articles"]);$top_menu=$_POST["top_menu"];
		$caption=$slave->qq($_POST["caption"]); $short_caption=$slave->qq($_POST["short_caption"]); $keywords=$slave->qq($_POST["keywords"]); $seo_info=$slave->qq($_POST["seo_info"]);
		$db->query("update `catalogue` set lenta='$lenta', main_menu='$top_menu', articles='$articles', caption='$caption', short_caption='$short_caption', keywords='$keywords', seo_info='$seo_info' where id='$cat_id';");
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Раздел &quot;$caption&quot; успешно сохранено";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку разделов",$form);
		$form=str_replace("{back_url}","?$url&top_id=$top_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function new_param_form($top_id,$cat_id,$type_id){ $db=new db; $slave=new slave; if ($cat_id==""){$cat_id=0;}if ($type_id==""){$type_id=1;}
		$form_htm=RD."/tpl/catalogue_param_form.htm"; if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Добавить", $form);
		$form=str_replace("{top_id}", $top_id, $form);
		$form=str_replace("{cat_id}", $cat_id, $form);
		$form=str_replace("{param_id}", "", $form);
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{lenta}", "9999", $form);
		$form=str_replace("{type_form}", $this->show_type_form($top_id,$cat_id,$type_id), $form);
		if ($type_id==1){
			$list="<table width='100%' border=0>";
			for ($i=1;$i<=15;$i++){ $list.="<tr><td width='10%'>параметр $i-></td><td><input type='text' name='param$i' value='' style='width:200px;'></td></tr>"; }
			$list.="</table>";
		}
		if ($type_id==3){
			$list="<table width='100%' border=0><tr><td width='10%'></td><td>от <input type='text' name='param_from' value='' style='width:100px;'> до <input type='text' name='param_to' value='' style='width:100px;'></td></tr></table>";
		}
		$form=str_replace("{params}", $list, $form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		return $form;
	}
	function add_param_form(){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$top_id=$_POST["top_id"]; $cat_id=$_POST["cat_id"]; $lenta=$slave->qq($_POST["lenta"]); $caption=$slave->qq($_POST["caption"]);$type_id=$_POST["type_id"];
		$mid=$this->get_max_catalogue_param_id();
		$db->query("insert into catalogue_params (`id`,`cat_id`,`type`,`caption`,`lenta`) values('$mid','$cat_id','$type_id','$caption','$lenta');");
		if ($type_id==1){
			for ($i=1;$i<=15;$i++){ $param=$slave->qq($_POST["param$i"]);
				if ($param!=""){ $db->query("insert into catalogue_sub_params (`id`,`param_id`,`caption`,`lenta`) values('','$mid','$param','9999');");}
			}
		}
		if ($type_id==3){
			$from_caption=$slave->qq($_POST["param_from"]);$to_caption=$slave->qq($_POST["param_to"]);
			if ($from_caption!="" and $to_caption!=""){ 
				$db->query("insert into catalogue_sub_params (`param_id`,`caption`,`lenta`) values('$mid','$from_caption','999');");
				$db->query("insert into catalogue_sub_params (`param_id`,`caption`,`lenta`) values('$mid','$to_caption','999');");
			}
		}
		$r=$db->query("select params from catalogue where id='$cat_id' limit 0,1;");$n=$db->num_rows($r);
		if ($n==1){
			$params=$db->result($r,0,"params");
			$params.=$mid."|";
			$db->query("update catalogue set params='$params' where id='$cat_id';");
		}
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Параметр &quot;$caption&quot; успешно добавлен";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку параметров",$form);
		$form=str_replace("{back_url}","?$url&w=folder_params&top_id=$top_id&cat_id=$cat_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function edit_param_form($top_id,$cat_id,$param_id){ $db=new db; $slave=new slave; if ($cat_id==""){$cat_id=0;}if ($type_id==""){$type_id=1;}
		$r=$db->query("select * from catalogue_params where id='$param_id' limit 0,1;");$n=$db->num_rows($r);
		if ($n==1){
			$type_id=$db->result($r,0,"type");
			$cat_id=$db->result($r,0,"cat_id");
			$caption=$db->result($r,0,"caption");
			$lenta=$db->result($r,0,"lenta");
		}
		$form_htm=RD."/tpl/catalogue_param_form.htm"; if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Редактировать", $form);
		$form=str_replace("{top_id}", $top_id, $form);
		$form=str_replace("{cat_id}", $cat_id, $form);
		$form=str_replace("{param_id}", $param_id, $form);
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{lenta}", $lenta, $form);
		$form=str_replace("{type_form}", $this->show_type_form($top_id,$cat_id,$type_id), $form);
		if ($type_id==1){
			$list="<table width='100%' border=0>";
			$r=$db->query("select * from catalogue_sub_params where param_id='$param_id' order by lenta,id asc;");$n=$db->num_rows($r);
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$list.="<tr><td width='10%'>параметр $i-></td><td><input type='hidden' name='paramid$i' value='$id'><input type='text' name='param$i' value='$caption' style='width:200px;'></td></tr>";
			}
			for ($i=$n+1;$i<=$n+15;$i++){
				$list.="<tr><td width='10%'>параметр $i-></td><td><input type='text' name='param$i' value='' style='width:200px;'></td></tr>";
			}
			$list.="</table>";
		}
		if ($type_id==3){
			$r=$db->query("select * from catalogue_sub_params where param_id='$param_id' order by id asc limit 0,2;");$n=$db->num_rows($r);
			if ($n==2){
				$from_id=$db->result($r,0,"id");	$from_caption=$db->result($r,0,"caption");
				$to_id=$db->result($r,1,"id");		$to_caption=$db->result($r,1,"caption");
			}
			$list="<table width='100%' border=0><tr><td width='10%'></td><td>от <input type='hidden' name='from_id' value='$from_id'><input type='text' name='param_from' value='$from_caption' style='width:100px;'> до <input type='hidden' name='to_id' value='$to_id'><input type='text' name='param_to' value='$to_caption' style='width:100px;'></td></tr></table>";
		}
		$form=str_replace("{params}", $list, $form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		return $form;
	}
	function save_param_form(){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$param_id=$_POST["param_id"];$top_id=$_POST["top_id"]; $cat_id=$_POST["cat_id"]; $lenta=$slave->qq($_POST["lenta"]); $caption=$slave->qq($_POST["caption"]); $type_id=$_POST["type_id"];
		$db->query("update catalogue_params set `type`='$type_id',`caption`='$caption',`lenta`='$lenta' where id='$param_id';");
		if ($type_id==1){
			for ($i=1;$i<=15;$i++){ $params=$slave->qq($_POST["param$i"]);$params_id=$slave->qq($_POST["paramid$i"]);
				if ($params_id=="" and $params!=""){ $db->query("insert into catalogue_sub_params (`id`,`param_id`,`caption`,`lenta`) values('','$param_id','$params','9999');");}
				if ($params_id!="" and $params!=""){ $db->query("update catalogue_sub_params set caption='$params' where id='$params_id';");}
				if ($params_id!="" and $params==""){ $db->query("delete from catalogue_sub_params where id='$params_id';");}
			}
		}
		if ($type_id==3){
			$from_id=$_POST["from_id"];$to_id=$_POST["to_id"];
			$from_caption=$slave->qq($_POST["param_from"]);$to_caption=$slave->qq($_POST["param_to"]);

			if ($from_id!="" and $to_id!=""){ 
				$db->query("update catalogue_sub_params set caption='$from_caption' where id='$from_id';");
				$db->query("update catalogue_sub_params set caption='$to_caption' where id='$to_id';");
			}
		}
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Параметр &quot;$caption&quot; успешно изменен";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку параметров",$form);
		$form=str_replace("{back_url}","?$url&w=folder_params&top_id=$top_id&cat_id=$cat_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function show_type_form($top_id,$cat_id,$type){ $db=new db;$mdl=new module;$url=$mdl->get_file_url();
		$r=$db->query("select * from catalogue_params_type order by id asc;"); $n=$db->num_rows($r);
		$form="<select size=1 name='type_id' onchange='location.href=\"?$url&w=new_param&top_id=$top_id&cat_id=$cat_id&type_id=\"+this[this.selectedIndex].value'>";
		for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				if ($type==$id){ $form.="<option value='$id' selected>$caption</option>";}
				if ($type!=$id){ $form.="<option value='$id'>$caption</option>";}
		}
		$form.="</select>";
		return $form;
	}
	//-----  model ---------------------------------------------------------------------
	function new_model_form($cat_id,$top_id){ $db=new db; $slave=new slave;
		$form_htm=RD."/tpl/catalogue_model_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Создать", $form);
		$form=str_replace("{top_id}", $top_id, $form);
		$form=str_replace("{cat_id}", $cat_id, $form);
		$form=str_replace("{model}", "", $form);
		$form=str_replace("{code}", "", $form);
		
		$form=str_replace("{price1}", $price1, $form);
		$form=str_replace("{price2}", $price2, $form);
		$form=str_replace("{price3}", $price3, $form);
		$form=str_replace("{price4}", $price4, $form);
		$form=str_replace("{price5}", $price5, $form);

		$form=str_replace("{short_caption}", "", $form);
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{sklad_form}", $this->show_sklad_form("1"), $form);
		$form=str_replace("{params}", $this->show_model_params_form($cat_id,""), $form);
		$form=str_replace("{lenta}", "9999", $form);
		$form=str_replace("{keywords}", "", $form);
		$form=str_replace("{few_words}", "", $form);
		$form=str_replace("{short_desc}", "", $form);
		$form=str_replace("{desc}", "", $form);
		$form=str_replace("{desc_more}", "", $form);
		$form=str_replace("{navigation}",$this->show_navigation($top_id,""),$form);
		return $form;
	}
	function add_model_form(){$db=new db; $slave=new slave; $mdl=new module;$url=$mdl->get_file_url();include 'lib/catalogue_file_upload.php';$file_upload=new file_upload;
		$cat_id=$_POST["cat_id"];$lenta=$_POST["lenta"]; $top_id=$_POST["top_id"]; $sklad=$_POST["sklad"]; $red_price=$slave->qq($_POST["red_price"]); $special_offer=$slave->qq($_POST["special_offer"]);$sale=$slave->qq($_POST["sale"]);$best=$slave->qq($_POST["best"]);$code=$slave->qq($_POST["code"]);
		$short_caption=$slave->qq($_POST["short_caption"]); $caption=$slave->qq($_POST["caption"]); $short_desc=$slave->qq($_POST["short_desc"]); $desc=$slave->qq($_POST["desc"]); $desc_more=$slave->qq($_POST["desc_more"]); $few_words=$slave->qq($_POST["few_words"]); $keywords=$slave->qq($_POST["keywords"]);
		$price1=$slave->qq($_POST["price1"]);$price2=$slave->qq($_POST["price2"]);$price3=$slave->qq($_POST["price3"]);$price4=$slave->qq($_POST["price4"]);$price5=$slave->qq($_POST["price5"]);
		$mid=$this->get_max_catalogue_id();
		if ($special_offer==1){$special_offer=$this->get_model_top_id($top_id);}
		$db->query("insert into catalogue (`id`,`top_id`,`code`,`short_caption`,`caption`,`few_words`,`short_desc`,`desc`,`desc_more`,`is_folder`,`price1`,`price2`,`price3`,`price4`,`price5`,`sklad`,`best`,`special_offer`,`red_price`,`sale`,`votes`,`opinion`,`update`,`keywords`,`lenta`,`ison`) values('$mid','$cat_id','$code','$short_caption','$caption','$few_words','$short_desc','$desc','$desc_more','2','$price1','$price2','$price3','$price4','$price5','$sklad','best','$special_offer','$red_price','$sale','0','0',CURDATE(),'$keywords','$lenta','1');");
		$this->save_model_params($cat_id,$mid);
		$file_upload->convert_files($mid);
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Модель &quot;$caption&quot; успешно создано";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку моделей",$form);
		$form=str_replace("{back_url}","?$url&w=show_model_menu&top_id=$top_id&cat_id=$cat_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function find_folder_params($cur_id){ $db=new db; if ($cur_id==""){$cur_id="0";}
		$r=$db->query("select top_id,params from catalogue where id='$cur_id' and ison='1' limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){ $params=$db->result($r,0,"params");$top_id=$db->result($r,0,"top_id");
			if ($params!=""){ return $cur_id;}
			if ($params=="" and $top_id!=0){ $cur_id=$this->find_folder_params($top_id);}
		}
		if ($n==0){ return "0";}
	}
	function show_model_params_form($cat_id,$model){ $db=new db; $slave=new slave; $fparam_id=$this->find_folder_params($cat_id);
		$r=$db->query("select * from catalogue_params where cat_id='$fparam_id' order by lenta,id asc;");$n=$db->num_rows($r);$form="<table width='100%' border=0>";$k=0;
		for ($i=1;$i<=$n;$i++){$k++;
			$id=$db->result($r,$i-1,"id");
			$type_id=$db->result($r,$i-1,"type");
			$caption=$db->result($r,$i-1,"caption");
			if ($k==1){$form.="<tr valign='top'>";}
			$form.="<td width='25%'>
				<div>
					<div><strong>$caption</strong></div>
					<div class='ParamList'>{list}</div>
				</div>
			</td>";
			if ($k==4){$form.="</tr>";$k=0;}
			$form=str_replace("{list}",$this->show_param_list_form($model,$type_id,$id),$form);
		}
		if ($k<4){$form.="</tr>";}$form.="</table>";
		return $form;
	}
	function show_param_list_form($model,$type,$param_id){ $db=new db;
		$form="<table width='100%' border=0>";
		if ($type==1){
			$r=$db->query("select * from catalogue_sub_params where param_id='$param_id' order by lenta,id asc limit 0,15;");$n=$db->num_rows($r);$k=0;
			for ($i=1;$i<=$n;$i++){$k++;
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$checked=""; if ($this->check_param_value($model,$type,$param_id,$id)==1){$checked="checked=\"checked\"";}
				if ($k==1){$form.="<tr>";}
				$form.="<td width='50%'><input type='checkbox' name='param_".$param_id."_$id' $checked value='1'> - $caption</td>";
				if ($k==2){$form.="</tr>";$k=0;}
			}
			if ($k==1){$form.="</tr>";}
		}
		if ($type==2){ 
			$checked=""; if ($this->check_param_value($model,$type,$param_id,"")==1){$checked="checked=\"checked\"";}
			$form.="<tr><td><input type='checkbox' name='param_".$param_id."' $checked value='1'> - Да</td></tr>";
		}
		if ($type==3){
			$r=$db->query("select * from catalogue_sub_params where param_id='$param_id' order by id asc limit 0,2;");$n=$db->num_rows($r);$k=0;
			if ($n==2){
				$from_caption=$db->result($r,0,"caption");$to_caption=$db->result($r,1,"caption");
				$value=$this->check_param_value($model,$type,$param_id,"");
				$form.="<tr><td>от $from_caption до $to_caption<br />значение <input type='text' name='param_from_to_".$param_id."' value='$value'></td></tr>";
			}
		}
		$form.="</table>";
		return $form;
	}
	function check_param_value($model,$type,$param_id,$sub_param_id){ $db=new db;
		if ($type==1){
			$r=$db->query("select count(id) as kol from catalogue_model_params where cat_id='$model' and param_id='$param_id' and sub_param_id='$sub_param_id';");
			$result=$db->result($r,0,"kol");
		}
		if ($type==2){
			$r=$db->query("select count(id) as kol from catalogue_model_params where cat_id='$model' and param_id='$param_id' and sub_param_id='';");
			$result=$db->result($r,0,"kol");
		}
		if ($type==3){
			$r=$db->query("select sub_param_value as spv from catalogue_model_params where cat_id='$model' and param_id='$param_id' and sub_param_id='';");$n=$db->num_rows($r);
			if ($n==0){$result="";}
			if ($n==1){$result=$db->result($r,0,"spv");}
		}
		return $result;
	}
	function save_model_params($cat_id,$model){ $db=new db;
		$r=$db->query("select * from catalogue_params where cat_id='$cat_id' order by lenta,id asc;"); $n=$db->num_rows($r);
		for ($i=1;$i<=$n;$i++){
			$param_id=$db->result($r,$i-1,"id");
			$type_id=$db->result($r,$i-1,"type");
			if ($type_id==1){
				$r1=$db->query("select * from catalogue_sub_params where param_id='$param_id' order by lenta,id asc limit 0,15;");$n1=$db->num_rows($r1);
				for ($j=1;$j<=$n1;$j++){
					$id=$db->result($r1,$j-1,"id");
					$pmv=$_POST["param_".$param_id."_".$id];if ($pmv==""){$pmv=0;}
					$checked_pmv=$this->check_param_value($model,$type_id,$param_id,$id);
					if ($checked_pmv==0 and $pmv==1){ $db->query("insert into catalogue_model_params values ('','$model','$param_id','$id','');");}
					if ($checked_pmv==1 and $pmv==0){ $db->query("delete from catalogue_model_params where cat_id='$model' and param_id='$param_id' and sub_param_id='$id';");}
				}
			}
			if ($type_id==2){ 
				$pmv=$_POST["param_".$param_id];if ($pmv==""){$pmv=0;}
				$checked_pmv=$this->check_param_value($model,$type_id,$param_id,"");
				if ($checked_pmv==0 and $pmv==1){ $db->query("insert into catalogue_model_params values ('','$model','$param_id','','');");}
				if ($checked_pmv==1 and $pmv==0){ $db->query("delete from catalogue_model_params where cat_id='$model' and param_id='$param_id' and sub_param_id='';");}
			}
			if ($type_id==3){
				$pmv=$_POST["param_from_to_".$param_id];
				$checked_pmv=$this->check_param_value($model,$type_id,$param_id,"");
				if ($checked_pmv=="" and $pmv!=""){ $db->query("insert into catalogue_model_params values ('','$model','$param_id','','$pmv');");}
				if ($checked_pmv!=""){ $db->query("update catalogue_model_params set sub_param_value='$pmv' where cat_id='$model' and param_id='$param_id' and sub_param_id='';");}
			}
		}
		return;
	}
	function delete_model_params($model){ $db=new db; $db->query("delete from catalogue_model_params where cat_id='$model';");return;}
	function edit_model_form($cat_id,$top_id,$model){ $db=new db; $slave=new slave;
		$r=$db->query("select * from catalogue where id='$model';");
		$n=$db->num_rows($r);
		if ($n>0){
			$code=$slave->qqback($db->result($r,0,"code"));
			$short_caption=$slave->qqback_in($db->result($r,0,"short_caption"));
			$caption=$slave->qqback_in($db->result($r,0,"caption"));
			$short_desc=$slave->qqback($db->result($r,0,"short_desc"));
			$desc=$slave->qqback($db->result($r,0,"desc"));
			$price1=$slave->qqback($db->result($r,0,"price1"));
			$price2=$slave->qqback($db->result($r,0,"price2"));
			$price3=$slave->qqback($db->result($r,0,"price3"));
			$price4=$slave->qqback($db->result($r,0,"price4"));
			$price5=$slave->qqback($db->result($r,0,"price5"));
			$desc_more=$slave->qqback($db->result($r,0,"desc_more"));
			$few_words=$slave->qqback($db->result($r,0,"few_words"));
			$keywords=$slave->qqback_in($db->result($r,0,"keywords"));
			$sklad=$slave->qqback($db->result($r,0,"sklad"));
			$best=$slave->qqback($db->result($r,0,"best"));
			$special_offer=$slave->qqback($db->result($r,0,"special_offer"));
			$red_price=$slave->qqback($db->result($r,0,"red_price"));
			$sale=$slave->qqback($db->result($r,0,"sale"));
			$lenta=$slave->qqback_in($db->result($r,0,"lenta"));
		}
		if ($best=="1"){ $bs_price="checked";}if ($best==""){ $bs_price="";}
		if ($red_price=="1"){ $rd_price="checked";}if ($red_price==""){ $rd_price="";}
		if ($special_offer!=0){ $sp_offer="checked";}if ($special_offer==0){ $sp_offer="";}
		if ($sale=="1"){ $sl_price="checked";}if ($sale==""){ $sl_price="";}
		$form_htm=RD."/tpl/catalogue_model_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Редактировать", $form);
		$form=str_replace("{code}", $code, $form);
		$form=str_replace("{top_id}", $top_id, $form);
		$form=str_replace("{cat_id}", $cat_id, $form);
		$form=str_replace("{lenta}", $lenta, $form);
		$form=str_replace("{model}", $model, $form);
		$form=str_replace("{price1}", $price1, $form);
		$form=str_replace("{price2}", $price2, $form);
		$form=str_replace("{price3}", $price3, $form);
		$form=str_replace("{price4}", $price4, $form);
		$form=str_replace("{price5}", $price5, $form);
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{short_caption}", $short_caption, $form);
		$form=str_replace("{sklad_form}", $this->show_sklad_form($sklad), $form);
		$form=str_replace("{params}", $this->show_model_params_form($cat_id,$model), $form);
		$form=str_replace("{sp_offer}", $sp_offer, $form);
		$form=str_replace("{rd_price}", $rd_price, $form);
		$form=str_replace("{sl_price}", $sl_price, $form);
		$form=str_replace("{bs_price}", $bs_price, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{desc_more}", $desc_more, $form);
		$form=str_replace("{short_desc}", $short_desc, $form);
		$form=str_replace("{few_words}", $few_words, $form);
		$form=str_replace("{keywords}", $keywords, $form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		return $form;
	}
	function copy_model_form($cat_id,$top_id,$model){ $db=new db; $slave=new slave;
		$r=$db->query("select * from catalogue where id='$model';");$n=$db->num_rows($r);
		if ($n>0){
			$code=$slave->qqback($db->result($r,0,"code"));
			$short_caption=$slave->qqback_in($db->result($r,0,"short_caption"));
			$caption=$slave->qqback_in($db->result($r,0,"caption"));
			$short_desc=$slave->qqback($db->result($r,0,"short_desc"));
			$desc=$slave->qqback($db->result($r,0,"desc"));
			$desc_more=$slave->qqback($db->result($r,0,"desc_more"));
			$few_words=$slave->qqback($db->result($r,0,"few_words"));
			$keywords=$slave->qqback_in($db->result($r,0,"keywords"));
			$sklad=$slave->qqback($db->result($r,0,"sklad"));
			$price1=$slave->qqback($db->result($r,0,"price1"));
			$price2=$slave->qqback($db->result($r,0,"price2"));
			$price3=$slave->qqback($db->result($r,0,"price3"));
			$price4=$slave->qqback($db->result($r,0,"price4"));
			$price5=$slave->qqback($db->result($r,0,"price5"));
			$best=$slave->qqback($db->result($r,0,"best"));
			$special_offer=$slave->qqback($db->result($r,0,"special_offer"));
			$red_price=$slave->qqback($db->result($r,0,"red_price"));
			$sale=$slave->qqback($db->result($r,0,"sale"));
			$lenta=$slave->qqback_in($db->result($r,0,"lenta"));
		}
		
		if ($best=="1"){ $bs_price="checked";}if ($best==""){ $bs_price="";}
		if ($red_price=="1"){ $rd_price="checked";}if ($red_price==""){ $rd_price="";}
		if ($special_offer!=0){ $sp_offer="checked";}if ($special_offer==0){ $sp_offer="";}
		if ($sale=="1"){ $sl_price="checked";}if ($sale==""){ $sl_price="";}
		
		$form_htm=RD."/tpl/catalogue_model_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}

		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Копировать", $form);
		
		$editor_desc=new CKeditor();$editor_desc->BasePath="../ckeditor/";$editor_desc->returnOutput=true;$ckfinder_desc=new CKFinder();$ckfinder_desc->BasePath='../ckfinder/';$ckfinder_desc->SetupCKEditorObject($editor_desc);
		$editor_short_desc=new CKeditor();$editor_short_desc->BasePath="../ckeditor/";$editor_short_desc->returnOutput=true;$ckfinder_short_desc=new CKFinder();$ckfinder_short_desc->BasePath='../ckfinder/';$ckfinder_short_desc->SetupCKEditorObject($editor_short_desc);
		$editor_desc_more=new CKeditor();$editor_desc_more->BasePath="../ckeditor/";$editor_desc_more->returnOutput=true;$ckfinder_desc_more=new CKFinder();$ckfinder_desc_more->BasePath='../ckfinder/';$ckfinder_desc_more->SetupCKEditorObject($editor_desc_more);
		$form_htm=RD."/tpl/catalogue_model_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}

		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Редактировать", $form);
		$form=str_replace("{code}", $code, $form);
		$form=str_replace("{top_id}", $top_id, $form);
		$form=str_replace("{cat_id}", $cat_id, $form);
		$form=str_replace("{lenta}", $lenta, $form);
		$form=str_replace("{model}", $model, $form);
		$form=str_replace("{price1}", $price1, $form);
		$form=str_replace("{price2}", $price2, $form);
		$form=str_replace("{price3}", $price3, $form);
		$form=str_replace("{price4}", $price4, $form);
		$form=str_replace("{price5}", $price5, $form);
		$form=str_replace("{pr_special}", "", $form);
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{sizes}", $sizes, $form);
		$form=str_replace("{short_caption}", $short_caption, $form);
		$form=str_replace("{sklad_form}", $this->show_sklad_form($sklad), $form);
		$form=str_replace("{params}", $this->show_model_params_form($cat_id,$model), $form);
		$form=str_replace("{sp_offer}", $sp_offer, $form);
		$form=str_replace("{rd_price}", $rd_price, $form);
		$form=str_replace("{sl_price}", $sl_price, $form);
		$form=str_replace("{bs_price}", $bs_price, $form);
		$form=str_replace("{short_desc}", $editor_short_desc->editor("short_desc",$short_desc), $form);
		$form=str_replace("{desc}", $editor_desc->editor("desc",$desc), $form);
		$form=str_replace("{desc_more}", $editor_desc_more->editor("desc_more",$desc_more), $form);
		$form=str_replace("{few_words}", $few_words, $form);
		$form=str_replace("{keywords}", $keywords, $form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		return $form;
	}
	function save_model_form(){	$db=new db; $slave=new slave; $mdl=new module;$url=$mdl->get_file_url();
		$model=$_POST["model"];$cat_id=$_POST["cat_id"];$lenta=$_POST["lenta"]; $top_id=$_POST["top_id"]; $sklad=$_POST["sklad"]; $red_price=$slave->qq($_POST["red_price"]); $special_offer=$slave->qq($_POST["special_offer"]);$sale=$slave->qq($_POST["sale"]);$best=$slave->qq($_POST["best"]);$code=$slave->qq($_POST["code"]);
		$price1=$slave->qq($_POST["price1"]);$price2=$slave->qq($_POST["price2"]);$pr3=$slave->qq($_POST["price3"]);$price4=$slave->qq($_POST["price4"]);$price5=$slave->qq($_POST["price5"]);
		$short_caption=$slave->qq($_POST["short_caption"]); $caption=$slave->qq($_POST["caption"]); $short_desc=$slave->qq($_POST["short_desc"]); $desc=$slave->qq($_POST["desc"]); $desc_more=$slave->qq($_POST["desc_more"]); $few_words=$slave->qq($_POST["few_words"]); $keywords=$slave->qq($_POST["keywords"]);
		if ($special_offer==1){$special_offer=$this->get_model_top_id($cat_id);}
		$db->query("update catalogue set lenta='$lenta',  code='$code', `sklad`='$sklad', `price1`='$price1', `price2`='$price2', `price3`='$price3', `price4`='$price4', `price5`='$price5', sale='$sale', `best`='$best', special_offer='$special_offer', red_price='$red_price', caption='$caption', short_caption='$short_caption', few_words='$few_words', short_desc='$short_desc', `desc`='$desc', `desc_more`='$desc_more',  keywords='$keywords', `update`=CURDATE() where id='$model';");
		$this->save_model_params($cat_id,$model);
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Модель &quot;$caption&quot; успешно сохранено";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку моделей",$form);
		$form=str_replace("{back_url}","?$url&w=show_model_menu&top_id=$top_id&cat_id=$cat_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_model($model,$cat_id,$top_id){ $mdl=new module;$url=$mdl->get_file_url();
		$db=new db;include 'lib/catalogue_file_upload.php'; $file_upload=new file_upload;
		$db->query("delete from catalogue where id='$model';");
		$this->delete_model_params($model);
		$file_upload->drop_model($model);
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Модель успешно удалена";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку моделей",$form);
		$form=str_replace("{back_url}","?$url&w=show_model_menu&top_id=$top_id&cat_id=$cat_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_param($top_id,$cat_id,$param_id){ $db=new db; $mdl=new module;$url=$mdl->get_file_url();
		$db->query("delete from catalogue_params where id='$param_id';");
		$db->query("delete from catalogue_sub_params where param_id='$param_id';");
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Параметр успешно удален";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку параметров",$form);
		$form=str_replace("{back_url}","?$url&w=folder_params&top_id=$top_id&cat_id=$cat_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function arch_model($model,$cat_id,$top_id){ $db=new db; $mdl=new module;$url=$mdl->get_file_url();
		$db->query("update catalogue set ison='9' where id='$model';");
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Модель успешно заархивировано";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку моделей",$form);
		$form=str_replace("{back_url}","?$url&w=show_model_menu&top_id=$top_id&cat_id=$cat_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function dearch_model($model,$cat_id,$top_id){$db=new db; $mdl=new module;$url=$mdl->get_file_url();
		$db->query("update catalogue set ison='1' where id='$model';");
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Модель успешно розархивировано";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку моделей",$form);
		$form=str_replace("{back_url}","?$url&w=show_model_menu&top_id=$top_id&cat_id=$cat_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_folder($cat_id,$top_id){$db=new db; $mdl=new module;$url=$mdl->get_file_url();
		$db->query("update catalogue set ison='0' where id='$cat_id';");
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Раздел успешно удален";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку моделей",$form);
		$form=str_replace("{back_url}","?$url&w=show_model_menu&top_id=$top_id",$form);
		$form=str_replace("{navigation}",$this->show_navigation($cat_id,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function get_model_top_id($cat_id){$db=new db; 
		$r=$db->query("select top_id from catalogue where id='$cat_id';");$n=$db->num_rows($r);
		if ($n>0){
			$top_id=$db->result($r,0,"top_id");
			if ($top_id>0){$cat_id=$this->get_model_top_id($top_id);}
			if ($top_id==0){return $cat_id; break; }
		}
		if ($n==0){	return $cat_id;}
		return $cat_id;
	}
	function show_navigation($cat_id,$nav_menu){$db=new db; $slave=new slave; $mdl=new module;$url=$mdl->get_file_url();
		$r=$db->query("select top_id,caption from catalogue where id='$cat_id';");$n=$db->num_rows($r);
		if ($n>0){
			$top_id=$db->result($r,0,"top_id");
			$caption=$db->result($r,0,"caption");
			if ($this->check_folder_nex_level($cat_id)==2){$show_model="&w=show_model_menu"; }
			if ($this->check_folder_nex_level($cat_id)==1){$show_model=""; }
			$menu="-><a class='navigation' href='?$url$show_model&top_id=$top_id&cat_id=$cat_id'>$caption</a>";
			$nav_menu=$menu.$nav_menu;
			$nav_menu=$this->show_navigation($top_id,$nav_menu);
		}
		if ($n==0){$nav_menu="<a class='navigation' href='?$url'>Товары</a>".$nav_menu;}
		return $nav_menu;
	}
	function show_menu($w,$visible){$slave=new slave; $mdl=new module; $url=$mdl->get_file_url(); $top_id=$this->get_top_id();$cat_id=$this->get_cat_id();
		$menu_htm=RD."/tpl/catalogue_menu.htm";	if (file_exists("$menu_htm")){ $menu = file_get_contents($menu_htm);}
		$menu=str_replace("{url_folder}","?$url&w=new_folder&top_id=$top_id&cat_id=$cat_id&",$menu);
		$menu=str_replace("{alt_folder}","Новий раздел",$menu);
		$menu=str_replace("{url_model}","?$url&w=new_model&top_id=$top_id&cat_id=$cat_id&",$menu);
		$menu=str_replace("{alt_model}","Новая модель",$menu);
		return $menu;
	}
	function show_param_menu($w){$slave=new slave; $mdl=new module; $url=$mdl->get_file_url(); $top_id=$this->get_top_id();$cat_id=$this->get_cat_id();
		$menu_htm=RD."/tpl/catalogue_param_menu.htm";	if (file_exists("$menu_htm")){ $menu = file_get_contents($menu_htm);}
		$menu=str_replace("{url_model}","?$url&w=new_param&top_id=$top_id&cat_id=$cat_id",$menu);
		$menu=str_replace("{alt_model}","Новый параметр",$menu);
		return $menu;
	}
	function get_param_type_caption($id){$db=new db; 
		$r=$db->query("select caption from catalogue_params_type where id='$id';");$n=$db->num_rows($r);
		if ($n==1){return $db->result($r,0,"caption");}
		if ($n==0){	return "";}
	}
	function show_sklad_form($sklad){$db=new db;
		$r=$db->query("select * from sklad order by id asc;");$n=$db->num_rows($r);
		$form="<select size=1 name='sklad'>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($sklad==$id){ $form.="<option value='$id' selected>$caption</option>";}
			if ($sklad!=$id){ $form.="<option value='$id'>$caption</option>";}
		}
		$form.="</select>";
		return $form;
	}
	function get_sklad_code($caption){ $db=new db;
		$r=$db->query("select id from sklad where caption='$caption' limit 0,1;"); $n=$db->num_rows($r);
		if ($n>=1){ return $db->result($r,0,"id");}
		if ($n==0){	return 1;}
	}
	function str_flt($s){return str_replace(",",".",$s);}
	function get_parrent($caption){ $db=new db;
		$r=$db->query("select id from catalogue where caption='$caption' and ison='1' limit 0,1;"); $n=$db->num_rows($r);
		if ($n>=1){ return $db->result($r,0,"id");}
		if ($n==0){	return 0;}
	}
}
?>