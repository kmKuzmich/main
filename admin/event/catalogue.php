<?php
include RD.'/lib/catalogue_class.php'; $cat= new catalogue;$access=new access;session_start();$slave=new slave;
$catalogue_htm=RD."/tpl/catalogue.htm";if (file_exists("$catalogue_htm")){ $catalogue_window = file_get_contents($catalogue_htm);}
$content=str_replace("{work_window}", $catalogue_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

	$top_id=$cat->get_top_id();$cat_id=$cat->get_cat_id();
	if ($w=="new_folder"){
		if ($conf==""){	$content=str_replace("{info}", $cat->new_folder_form($cat_id), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->add_folder_form(), $content); }
	}
	if ($w=="new_param"){
		if ($conf==""){	$content=str_replace("{info}", $cat->new_param_form($top_id,$cat_id,$type_id), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->add_param_form(), $content); }
	}
	if ($w=="new_model"){
		if ($conf==""){ $content=str_replace("{info}", $cat->new_model_form($cat_id,$top_id), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->add_model_form(), $content);}
	}

	if ($w=="edit_folder"){
		if ($conf==""){ $content=str_replace("{info}", $cat->edit_folder_form($top_id,$cat_id), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->save_folder_form(), $content);}
	}
	if ($w=="edit_param"){
		if ($conf==""){	$content=str_replace("{info}", $cat->edit_param_form($top_id,$cat_id,$param_id), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->save_param_form(), $content); }
	}
	if ($w=="edit_model"){
		if ($conf==""){ $content=str_replace("{info}", $cat->edit_model_form($cat_id,$top_id,$model), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->save_model_form(), $content); }
	}
	if ($w=="copy_model"){
		if ($conf==""){ $content=str_replace("{info}", $cat->copy_model_form($cat_id,$top_id,$model), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->add_model_form(), $content);}
	}
	if ($w=="delete_folder"){
		if ($conf=="true"){ $content=str_replace("{info}", $cat->delete_folder($cat_id,$top_id), $content); }
	}
	if ($w=="delete_param"){
		if ($conf=="true"){ $content=str_replace("{info}", $cat->delete_param($top_id,$cat_id,$param_id), $content); }
	}
	if ($w=="delete_model"){
		if ($conf=="true"){ $content=str_replace("{info}", $cat->delete_model($model,$cat_id,$top_id), $content);}
	}
	if ($w=="arch_model"){
		if ($conf=="true"){$content=str_replace("{info}", $cat->arch_model($model,$cat_id,$top_id), $content);}
	}
	if ($w=="dearch_model"){
		if ($conf=="true"){ $content=str_replace("{info}", $cat->dearch_model($model,$cat_id,$top_id), $content);}
	}
	if ($w=="import_price"){
		if ($conf==""){ $content=str_replace("{info}", $cat->import_price_form($provider), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->save_import_form(), $content);}
	}
	if ($w==""){ $content=str_replace("{info}", $cat->show_catalogue_tree($cat_id), $content); }
	if ($w=="folder_params"){ $content=str_replace("{info}", $cat->show_folder_params($top_id,$cat_id), $content); }
	if ($w=="show_model_menu"){ $content=str_replace("{info}", $cat->show_model_menu($cat_id), $content); }
	if ($w=="new_items"){ $content=str_replace("{info}", $cat->show_new_items_menu(), $content); }

}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

?>