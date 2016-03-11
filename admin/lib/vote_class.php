<?php
class vote {
	function show_vote_list(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url(); $dep_up=$slave->get_dep_up();

		$form_htm=RD."/tpl/vote_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($vote_up==""){$vote_up=0;}
		$r=$db->query("select * from vote order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$answer=$this->get_best_answer($id);

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			if ($i==1){$color="ffee00";}
			
			$operations="
			<a href='?$url&wn=edit&vote_id=$id'><img src='images/edit.png' border=0 alt='Редагувати' title='Редагувати '></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Видалити опитування?')){ window.location.href='?$url&wn=delete&vote_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Видалити' title='Видалити'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; <a href='?$url&wn=show&vote_id=$id'>$caption</a></td>
				<td align='left'>&nbsp; $answer</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Опитувань не знайдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{vote_menu}",$this->vote_menu(""),$form);
		return $form;
	}
	
	function show_vote_desc($vote_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/vote_desc.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from vote where id='$vote_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$r1=$db->query("select * from sub_vote where vote_id='$vote_id' order by id asc;");
			$n1=$db->num_rows($r1);
			for ($i=1;$i<=$n1;$i++){ $answ[$i]=$db->result($r1,$i-1,"caption"); $valw[$i]=$db->result($r1,$i-1,"votes"); }
			
			$r1=$db->query("select max(votes) as maxv from sub_vote where vote_id='$vote_id';");
			$maxvote=$db->result($r1,0,"maxv");
		}
				
		$list="";$m=0;
		for ($i=1;$i<=$n1;$i++){$m++;
			if ($maxvote>0){ $wdth=$valw[$i]*400/$maxvote;}
			if ($maxvote==0){ $wdth=0;}
			
			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$list.="<tr bgcolor='#$color'><td align='center' width='2%'>$i</td><td align='left'>".$answ[$i]."</td><td width='300' align='left'><img src='../uploads/images/vote/vote.gif' width='$wdth' height='7' border=0></td><td align='center'>".$valw[$i]."</td></tr>";

		}
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{vote_list}", $list, $form);
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{vote_menu}","",$form);
		return $form;
	}
	
	function show_vote_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/vote_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{vote_id}", "", $form);
		
		$form=str_replace("{caption}", "", $form);
		for ($i=1;$i<=10;$i++){
			$form=str_replace("{ans$i}", "", $form);
			$form=str_replace("{val$i}", "0", $form);
		}
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{vote_menu}","",$form);
		return $form;
	}
	
	function add_vote_form(){
		$db=new db; $slave=new slave;
		$caption=$slave->qq($_POST["caption"]);$k=0;
		for ($i=1;$i<=10;$i++){
			$ans=$slave->qq($_POST["ans$i"]);
			$val=$slave->qq($_POST["val$i"]);
			if ($ans!=""){$k++;$answ[$k]=$ans;$valw[$k]=$val;}
		}
		
		$r=$db->query("select max(id) as mid from vote;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("update vote set ison='0';");
		$db->query("insert into vote values ('$mid','$caption','1');");
		for ($i=1;$i<=$k;$i++){
			$db->query("insert into sub_vote values ('','$mid','".$answ[$i]."','".$valw[$i]."');");
		}
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Опитування &quot;$caption&quot; успішно створено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function edit_vote_form($vote_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/vote_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from vote where id='$vote_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$r1=$db->query("select * from sub_vote where vote_id='$vote_id' order by id asc;");
			$n1=$db->num_rows($r1);
			for ($i=1;$i<=$n1;$i++){ $answ[$i]=$db->result($r1,$i-1,"caption"); $valw[$i]=$db->result($r1,$i-1,"votes"); }
		}
				
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{vote_id}", $vote_id, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		for ($i=1;$i<=10;$i++){
			$form=str_replace("{ans$i}", $answ[$i], $form);
			$form=str_replace("{val$i}", $valw[$i], $form);
		}
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{vote_menu}","",$form);
		return $form;
	}
	
	function save_vote_form(){
		$db=new db; $slave=new slave;
		$vote_id=$slave->qq($_POST["vote_id"]);
		$caption=$slave->qq($_POST["caption"]);$k=0;
		for ($i=1;$i<=10;$i++){
			$ans=$slave->qq($_POST["ans$i"]);
			$val=$slave->qq($_POST["val$i"]);
			if ($ans!=""){$k++;$answ[$k]=$ans;$valw[$k]=$val;}
		}
		
		$db->query("update vote set caption='$caption' where id='$vote_id';");
		$db->query("delete from sub_vote where vote_id='$vote_id';");
		
		for ($i=1;$i<=$k;$i++){
			$db->query("insert into sub_vote values ('','$vote_id','".$answ[$i]."','".$valw[$i]."');");
		}
		
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Опитування &quot;$caption&quot; успішно збережено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($vote_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_vote_form($vote_id){
		$db=new db;
		$db->query("delete from vote where id='$vote_id';");
		$db->query("delete from sub_vote where vote_id='$vote_id';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Опитування успішно видалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($vote_up,""),$form);
		$form=str_replace("{vote_menu}","",$form);
		return $form;
	}
	
	
	function get_best_answer($vote_id){
		$db=new db;
		$r=$db->query("select votes,caption from sub_vote where vote_id='$vote_id' order by votes desc limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){
			$answer=$db->result($r,0,"caption")." (".$db->result($r,0,"votes")." голосів)";
		}
		return $answer;
	}
	
	
	function show_navigation(){
		$mdl=new module; $url=$mdl->get_file_url();
		$nav_menu="<a class='navigation' href='?$url'>До списку опитувань</a>".$nav_menu;
		return $nav_menu;
	}
	
	function vote_menu(){
		$mdl=new module; $url=$mdl->get_file_url();
		$vote_menu_htm=RD."/tpl/vote_menu.htm";
		if (!file_exists("$vote_menu_htm")){ $vote_menu="Не знайдено файл шаблону"; }
		if (file_exists("$vote_menu_htm")){ $vote_menu = file_get_contents($vote_menu_htm);}
		
		$vote_menu=str_replace("{url}","?".$url."&wn=new",$vote_menu);
		return $vote_menu;
	}
	
}
?>
