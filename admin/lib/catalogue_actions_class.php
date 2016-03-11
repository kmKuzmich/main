<?php
class catalogue_actions {
	function get_top_id(){ if ($_POST["top_id"]==""){return $_GET["top_id"];} if ($_POST["top_id"]!=""){return $_POST["top_id"];} }
	function get_cat_id(){ if ($_POST["cat_id"]==""){return $_GET["cat_id"];} if ($_POST["cat_id"]!=""){return $_POST["cat_id"];} }
	
	function get_caption(){ if ($_POST["caption"]==""){return $_GET["caption"];} if ($_POST["caption"]!=""){return $_POST["caption"];} }
	function get_code(){ if ($_POST["code"]==""){return $_GET["code"];} if ($_POST["code"]!=""){return $_POST["code"];} }
	function get_sp(){ if ($_POST["sp"]==""){return $_GET["sp"];} if ($_POST["sp"]!=""){return $_POST["sp"];} }
	function get_rp(){ if ($_POST["rp"]==""){return $_GET["rp"];} if ($_POST["rp"]!=""){return $_POST["rp"];} }
	function get_sl(){ if ($_POST["sl"]==""){return $_GET["sl"];} if ($_POST["sl"]!=""){return $_POST["sl"];} }
	function get_bs(){ if ($_POST["bs"]==""){return $_GET["bs"];} if ($_POST["bs"]!=""){return $_POST["bs"];} }
	
	function show_search_form(){session_start();$db=new db;$slave=new slave;$w=$slave->get_w();$mdl=new module;		$file=$slave->get_file();
		$form_htm=RD."/tpl/catalogue_actions_search_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$pst=$_POST["pst"];
		if ($pst=="search"){
			$code=$slave->qqback($_POST["code"]);$_SESSION["code"]=$code;
			$caption=$slave->qqback($_POST["caption"]);$_SESSION["caption"]=$caption;
			$_SESSION["ses_file"]=$file;
		}
		if ($pst==""){ $ses_file=$_SESSION["ses_file"];
			if ($ses_file==$file){
				$code=$_SESSION["code"];
				$caption=$_SESSION["caption"];
			}
			if ($ses_file!=$file){
				$_SESSION["code"]="";
				$_SESSION["caption"]="";
			}
		}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form = str_replace("{w}", $w, $form);
		$form = str_replace("{code}", $code, $form);
		$form = str_replace("{caption}", $caption, $form);
		return $form;
	}
	function show_catalogue_actions_list(){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$form_htm=RD."/tpl/catalogue_actions_list.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$caption=$this->get_caption();if ($caption==""){$caption=$_SESSION["caption"];}
		$code=$this->get_code();if ($code==""){$code=$_SESSION["code"];}
		$where="";
		//-----------
		if ($code!=""){$where.=" and code = '$code'";}
		if ($caption!=""){$where.=" and caption LIKE '%$caption%' ";}
		$r=$db->query("select * from catalogue_actions where ison='1' $where order by data_from,id asc;"); $n=$db->num_rows($r);$list="";
		if ($n>0){
			for ($i=1;$i<=$n;$i++){ $k++;
				$id=$db->result($r,$i-1,"id");
				$code=$db->result($r,$i-1,"code");
				$caption=$db->result($r,$i-1,"caption");
				$model=$db->result($r,$i-1,"model");$model_caption=$this->get_table_caption("catalogue",$model);
				$data_from=$db->result($r,$i-1,"data_from");
				$data_to=$db->result($r,$i-1,"data_to");
				$status=$db->result($r,$i-1,"status"); $status_caption=$this->get_table_caption("catalogue_actions_status",$status);
				list($kol_items,$price)=$this->getaction_price_kol($id);
				
				
				$tr_color="ffffff";	if ($k==2){$tr_color="f5f5f5"; $k=0;}
				$img="-";if (file_exists("../uploads/images/catalogue_actions/$id.jpg")){$img="+";}
				$list.="
				<tr bgcolor='#$tr_color'>
					<th><a href='?$url&w=edit_action&action_id=$id'><img src='images/edit.png' border=0 title='Редактировать' alt='Редактировать'></a></th>
					<th><a href='#' onclick=\"if(confirm('Удалить акцию?')){ window.location.href='?$url&w=delete_action&conf=true&action_id=$id'}\"><img src='images/drop.png' border=0></a></th>
					<th>$i</th>
					<td>$code</td>
					<td>$caption</td>
					<td>$model_caption</td>
					<th>$kol_items</th>
					<th>$price</th>
					<th>$data_from</th>
					<th>$data_to</th>
					<th>$status_caption</th>
				</tr>";
			}
		}
		$form=str_replace("{list}", $list, $form);
		$form=str_replace("{navigation}",$this->show_navigation(""),$form);
		$form=str_replace("{menu}",$this->show_menu("","visible"),$form);
		$form=str_replace("{search_form}",$this->show_search_form(),$form);
		return $form;
	}
	
	function getaction_price_kol($id){$db=new db; $slave=new slave;
		$r=$db->query("select count(id) as kol, sum(price) as aprice from catalogue_actions_models where action_id='$id';");$n=$db->num_rows($r);$kol=0;$price=0;
		if ($n==1){
			$kol=$db->result($r,0,"kol");
			$price=$db->result($r,0,"aprice");
		}
		return array($kol,$price);
	}
	function get_max_catalogue_actions_id(){ $db=new db; $r=$db->query("select max(id) as mid from catalogue_actions;"); return $db->result($r,0,"mid")+1; }

	function new_action_form(){ $db=new db; $slave=new slave;
		$form_htm=RD."/tpl/catalogue_actions_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Создать", $form);

		$form=str_replace("{top_menu}", "", $form);
		$form=str_replace("{action_id}", "", $form);
		$form=str_replace("{code}", "", $form);
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{kol_items}", "-", $form);
		$form=str_replace("{action_price}", "-", $form);
		$form=str_replace("{action_model}", " &nbsp; &mdash; &nbsp; ", $form);
		$form=str_replace("{model}", 0, $form);
		$form=str_replace("{data_from}", date("Y-m-d"), $form);
		$form=str_replace("{data_to}", date("Y-m-d"), $form);		
		$form=str_replace("{calendar_from}", $slave->get_calendar("data_from"), $form);
		$form=str_replace("{calendar_to}", $slave->get_calendar("data_to"), $form);
		$form=str_replace("{status_form}", $this->show_table_form("catalogue_actions_status",1), $form);
		
		for ($i=1;$i<=5;$i++){
			$form=str_replace("{item$i}", "", $form);
			$form=str_replace("{item".$i."_model}", " &nbsp; &mdash;", $form);
			$form=str_replace("{price$i}", "", $form);
		}
		
		$form=str_replace("{navigation}",$this->show_navigation(1),$form);
		return $form;
	}
	function add_action_form(){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$caption=$slave->qq($_POST["caption"]); $code=$slave->qq($_POST["code"]); $data_from=$slave->qq($_POST["data_from"]); $data_to=$slave->qq($_POST["data_to"]); $status=$slave->qq($_POST["catalogue_actions_status"]);
		$model=$slave->qq($_POST["model"]);
		$mid=$this->get_max_catalogue_actions_id();
		
		if ($model!="" and $model!="0"){
			$db->query("insert into catalogue_actions (`id`,`code`,`caption`,`model`,`data_from`,`data_to`,`status`,`ison`) values('$mid','$code','$caption','$model','$data_from','$data_to','$status','1');");
			for ($i=1;$i<=5;$i++){
				$item=$slave->qq($_POST["item$i"]);$price=$slave->qq($_POST["price$i"]);
				if ($item!="" and $item!="0" and $price!="0" and $price!=""){ $db->query("insert into catalogue_actions_models (`action_id`,`model`,`price`) values('$mid','$item','$price');");}
			}
		}
		
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Акционное предложение &quot;$caption&quot; успешно создано";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку акций",$form);
		$form=str_replace("{back_url}","?$url",$form);
		$form=str_replace("{navigation}",$this->show_navigation(1),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function edit_action_form($action_id){ $db=new db; $slave=new slave;
		$r=$db->query("select * from catalogue_actions where id='$action_id';");$n=$db->num_rows($r);
		if ($n>0){
			$status=$slave->qqback_in($db->result($r,0,"status"));
			$code=$slave->qqback_in($db->result($r,0,"code"));
			$caption=$slave->qqback_in($db->result($r,0,"caption"));
			$model=$slave->qqback_in($db->result($r,0,"model"));
			$data_from=$slave->qqback_in($db->result($r,0,"data_from"));
			$data_to=$slave->qqback_in($db->result($r,0,"data_to"));
			list($kol_items,$price)=$this->getaction_price_kol($action_id);
		}
		$form_htm=RD."/tpl/catalogue_actions_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{action}", "Редактировать", $form);

		$form=str_replace("{top_menu}", "", $form);
		$form=str_replace("{action_id}", $action_id, $form);
		$form=str_replace("{code}", $code, $form);
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{kol_items}", $kol_items, $form);
		$form=str_replace("{action_price}", $price, $form);
		$form=str_replace("{model}", $model, $form);
		$form=str_replace("{action_model}", $this->get_table_caption("catalogue",$model), $form);
		
		$form=str_replace("{data_from}", $data_from, $form);
		$form=str_replace("{data_to}", $data_to, $form);		
		$form=str_replace("{calendar_from}", $slave->get_calendar("data_from"), $form);
		$form=str_replace("{calendar_to}", $slave->get_calendar("data_to"), $form);
		$form=str_replace("{status_form}", $this->show_table_form("catalogue_actions_status",$status), $form);
		
		$r=$db->query("select * from catalogue_actions_models where action_id='$action_id';");$n=$db->num_rows($r);
		for ($i=1;$i<=$n;$i++){
			$item=$slave->qqback_in($db->result($r,$i-1,"model"));
			$price=$slave->qqback_in($db->result($r,$i-1,"price"));
			
			$form=str_replace("{item$i}", $item, $form);
			$form=str_replace("{item".$i."_model}", $this->get_table_caption("catalogue",$item), $form);
			$form=str_replace("{price$i}", $price, $form);
		}
		for ($i=$n+1;$i<=5;$i++){
			$form=str_replace("{item$i}", "", $form);
			$form=str_replace("{item".$i."_model}", " &nbsp; &mdash;", $form);
			$form=str_replace("{price$i}", "", $form);
		}
		
		$form=str_replace("{navigation}",$this->show_navigation(1),$form);
		return $form;
	}
	function save_action_form(){ $db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$action_id=$_POST["action_id"];$caption=$slave->qq($_POST["caption"]); $code=$slave->qq($_POST["code"]); $data_from=$slave->qq($_POST["data_from"]); $data_to=$slave->qq($_POST["data_to"]); $status=$slave->qq($_POST["catalogue_actions_status"]);$model=$slave->qq($_POST["model"]);
		
		if ($model!="" and $model!="0"){
			$db->query("update `catalogue_actions` set code='$code', caption='$caption', status='$status', data_from='$data_from', data_to='$data_to', model='$model' where id='$action_id';");
			$db->query("delete from `catalogue_actions_models` where action_id='$action_id';");
			for ($i=1;$i<=5;$i++){
				$item=$slave->qq($_POST["item$i"]);$price=$slave->qq($_POST["price$i"]);
				if ($item!="" and $item!="0" and $price!="0" and $price!=""){ $db->query("insert into catalogue_actions_models (`action_id`,`model`,`price`) values('$action_id','$item','$price');");}
			}
		}
		
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Акционное предложение &quot;$caption&quot; успешно сохранено";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку акций",$form);
		$form=str_replace("{back_url}","?$url",$form);
		$form=str_replace("{navigation}",$this->show_navigation(1),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_action($action_id){$db=new db; $mdl=new module;$url=$mdl->get_file_url();
		$db->query("update catalogue_actions set ison='0' where id='$action_id';");
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Акционное предложение успешно удалено";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","К списку акций",$form);
		$form=str_replace("{back_url}","?$url",$form);
		$form=str_replace("{navigation}",$this->show_navigation(1),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function get_model_top_id($cat_id){$db=new db; 
		$r=$db->query("select top_id from catalogue_actions where id='$cat_id';");$n=$db->num_rows($r);
		if ($n>0){
			$top_id=$db->result($r,0,"top_id");
			if ($top_id>0){$cat_id=$this->get_model_top_id($top_id);}
			if ($top_id==0){return $cat_id; break; }
		}
		if ($n==0){	return $cat_id;}
		return $cat_id;
	}
	function show_navigation($nav_menu){$db=new db; $slave=new slave; $mdl=new module;$url=$mdl->get_file_url();if($nav_menu!=""){$nav_menu="<a class='navigation' href='?$url'>Все акции</a>";}return $nav_menu;}
	function show_catalogue_navigation($cat_id,$nav_menu){$db=new db; $slave=new slave;
		$r=$db->query("select top_id,caption from catalogue where id='$cat_id';");$n=$db->num_rows($r);
		if ($n>0){
			$top_id=$db->result($r,0,"top_id");
			$caption=$db->result($r,0,"caption");
			$menu="-><a class='navigation' href='javascript:show_catalogue_form(\"$cat_id\");'>$caption</a>";
			$nav_menu=$menu.$nav_menu;
			$nav_menu=$this->show_catalogue_navigation($top_id,$nav_menu);
		}
		if ($n==0){$nav_menu="<a class='navigation' href='javascript:show_catalogue_form(\"0\");'>Товары</a>".$nav_menu;}
		return $nav_menu;
	}
	function show_items_navigation($place,$cat_id,$nav_menu){$db=new db; $slave=new slave;
		$r=$db->query("select top_id,caption from catalogue where id='$cat_id';");$n=$db->num_rows($r);
		if ($n>0){
			$top_id=$db->result($r,0,"top_id");
			$caption=$db->result($r,0,"caption");
			$menu="-><a class='navigation' href='javascript:show_items_form(\"$place\",\"$cat_id\");'>$caption</a>";
			$nav_menu=$menu.$nav_menu;
			$nav_menu=$this->show_items_navigation($place,$top_id,$nav_menu);
		}
		if ($n==0){$nav_menu="<a class='navigation' href='javascript:show_items_form(\"$place\",\"0\");'>Товары</a>".$nav_menu;}
		return $nav_menu;
	}
	function show_menu($w,$visible){$slave=new slave; $mdl=new module; $url=$mdl->get_file_url();
		$menu_htm=RD."/tpl/catalogue_actions_menu.htm";	if (file_exists("$menu_htm")){ $menu = file_get_contents($menu_htm);}
		$menu=str_replace("{url_action}","?$url&w=new_action",$menu);
		$menu=str_replace("{alt_action}","Новое акционное предложение",$menu);
		return $menu;
	}
	function str_flt($s){return str_replace(",",".",$s);}
	function get_parrent($caption){ $db=new db;
		$r=$db->query("select id from catalogue_actions where caption='$caption' and ison='1' limit 0,1;"); $n=$db->num_rows($r);
		if ($n>=1){ return $db->result($r,0,"id");}
		if ($n==0){	return 0;}
	}
	function get_table_caption($tname,$id){ $db=new db; if ($file==0){$file=1;}
		$r=$db->query("select caption from $tname where id='$id' limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
	function show_table_form($tname,$sid){ $db=new db;
		$r=$db->query("select * from $tname order by id asc;");$n=$db->num_rows($r);
		$form="<select name='$tname' id='$tname' size=1 style='width:100%;'><option value='0'>----</option>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$sid){ $form.="<option value='$id' selected>$caption</option>";}
			if ($id!=$sid){ $form.="<option value='$id'>$caption</option>";}
		}
		$form.="</form>";
		return $form;
	}
	function show_catalogue_list($cat_id){$db=new db; $slave=new slave;		if ($cat_id==""){$cat_id="0";}$k=0;
		$form_htm=RD."/tpl/catalogue_actions_folder_tree.htm"; if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from catalogue where top_id='$cat_id' and ison='1' order by is_folder,id asc;"); $n=$db->num_rows($r);$list="";
		if ($n>0){
			for ($i=1;$i<=$n;$i++){ $k++;
				$id=$db->result($r,$i-1,"id");
				$top_id=$db->result($r,$i-1,"top_id");
				$code=$db->result($r,$i-1,"code");
				$caption=$db->result($r,$i-1,"caption");
				$short_caption=$db->result($r,$i-1,"short_caption");
				$price=$db->result($r,$i-1,"price1");
				$is_folder=$db->result($r,$i-1,"is_folder"); $url_action="select_model(\"$id\");";if ($is_folder==1){$url_action="show_catalogue_form(\"$id\");";}
				
				$tr_color="ffffff";	if ($k==2){$tr_color="f5f5f5"; $k=0;}
				$list.="
				<tr bgcolor='#$tr_color'>
					<th>$i</th>
					<th>$code</th>
					<td><a href='javascript:$url_action'>$short_caption</a></td>
					<td><a href='javascript:$url_action'>$caption</a></td>
					<th>$price</th>
				</tr>";
			}
		}
		$form=str_replace("{list}", $list, $form);
		$form=str_replace("{navigation}",$this->show_catalogue_navigation($cat_id,""),$form);
		return $form;
	}
	function show_items_list($place,$cat_id){$db=new db; $slave=new slave;		if ($cat_id==""){$cat_id="0";}$k=0;
		$form_htm=RD."/tpl/catalogue_actions_folder_tree.htm"; if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from catalogue where top_id='$cat_id' and ison='1' order by is_folder,id asc;"); $n=$db->num_rows($r);$list="";
		if ($n>0){
			for ($i=1;$i<=$n;$i++){ $k++;
				$id=$db->result($r,$i-1,"id");
				$top_id=$db->result($r,$i-1,"top_id");
				$code=$db->result($r,$i-1,"code");
				$caption=$db->result($r,$i-1,"caption");
				$short_caption=$db->result($r,$i-1,"short_caption");
				$price=$db->result($r,$i-1,"price1");
				$is_folder=$db->result($r,$i-1,"is_folder"); $url_action="select_item(\"$place\",\"$id\");";if ($is_folder==1){$url_action="show_items_form(\"$place\",\"$id\");";}
				
				$tr_color="ffffff";	if ($k==2){$tr_color="f5f5f5"; $k=0;}
				$list.="
				<tr bgcolor='#$tr_color'>
					<th>$i</th>
					<th>$code</th>
					<td><a href='javascript:$url_action'>$short_caption</a></td>
					<td><a href='javascript:$url_action'>$caption</a></td>
					<th>$price</th>
				</tr>";
			}
		}
		$form=str_replace("{list}", $list, $form);
		$form=str_replace("{navigation}",$this->show_items_navigation($place,$cat_id,""),$form);
		return $form;
	}
	function get_catalogue_caption_price($id){$db=new db; 
		$r=$db->query("select caption,price1 from catalogue where id='$id' limit 0,1;"); $n=$db->num_rows($r);
		if ($n==1){
			$caption=$db->result($r,0,"caption");
			$price=$db->result($r,0,"price1");
		}
		return array($caption,$price);
	}
}
?>