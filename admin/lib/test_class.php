<?php
class test {
	var $test_id;
	var $db = false;
	
	function show_test_list(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();

		$form_htm=RD."/tpl/test_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($test_up==""){$test_up=0;}
		$r=$db->query("select * from test where ison='1' order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$rate=$db->result($r,$i-1,"rate");
			$tv=$db->result($r,$i-1,"tv");if ($tv==1){$tv_caption="Час на питання";}if ($tv==2){$tv_caption="Час на віктрину";}
			$time=$db->result($r,$i-1,"time");
			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			
			$operations="
			<a href='?$url&wn=edit_test&test_id=$id'><img src='images/edit.png' border=0 alt='Редагувати' title='Редагувати '></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Видалити вікторину?')){ window.location.href='?$url&wn=delete_test&test_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Видалити' title='Видалити'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; <a href='?$url&wn=question_list&test_id=$id'>$caption</a></td>
				<td>$rate</td>
				<td>$tv_caption</td>
				<td>$time</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Вікторин не знайдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation(""),$form);
		$form=str_replace("{test_menu}",$this->test_menu(""),$form);
		return $form;
	}
	
	function show_question_list($test_id){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();

		$form_htm=RD."/tpl/test_question_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($test_up==""){$test_up=0;}
		$r=$db->query("select * from test_question where ison='1' and test='$test_id' order by id asc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$var=$db->result($r,$i-1,"var");$var_caption=$this->get_var_caption($var);
			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			
			$operations="
			<a href='?$url&wn=edit_question&test_id=$test_id&question_id=$id'><img src='images/edit.png' border=0 alt='Редагувати' title='Редагувати '></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Видалити питання?')){ window.location.href='?$url&wn=delete_question&test_id=$test_id&question_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Видалити' title='Видалити'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; <a href='?$url&wn=question_list&test_id=$id'>$caption</a></td>
				<td>$var_caption</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Питань не знайдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{test_caption}",$this->get_test_caption($test_id),$form);
		$form=str_replace("{navigation}",$this->show_navigation($test_id),$form);
		$form=str_replace("{test_menu}",$this->test_menu("new_question"),$form);
		return $form;
	}
	
	function new_test(){
		$db=new db; $slave=new slave;$mdl=new module; list($dep_up,$cur_id)=$slave->get_file_deps("test");
		$form_htm=RD."/tpl/test_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $dep_up, $form);
		$form=str_replace("{cur_id}", $cur_id, $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{test_id}", "", $form);
		
		$form=str_replace("{test_caption}", "Нова вікторина", $form);
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{time}", "", $form);
		$form=str_replace("{rate}", "", $form);
		$form=str_replace("{tv_form}", $this->show_tv_form(""), $form);
		$form=str_replace("{navigation}",$this->show_navigation(""),$form);
		return $form;
	}
	
	function add_test(){
		$db=new db; $slave=new slave;
		$caption=$slave->qq($_POST["caption"]);
		$time=$slave->qq($_POST["time"]);
		$rate=$slave->qq($_POST["rate"]);
		$tv=$slave->qq($_POST["tv"]);
		
		$r=$db->query("select max(id) as mid from test;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into test values ('$mid','$caption','$rate','$tv','$time','1');");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Вікторину &quot;$caption&quot; успішно створено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function edit_test($test_id){
		$db=new db; $slave=new slave;$mdl=new module; list($dep_up,$cur_id)=$slave->get_file_deps("test");
		$form_htm=RD."/tpl/test_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from test where id='$test_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$rate=$slave->qqback($db->result($r,0,"rate"));
			$time=$slave->qqback($db->result($r,0,"time"));
			$tv=$db->result($r,0,"tv");
		}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $dep_up, $form);
		$form=str_replace("{cur_id}", $cur_id, $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{test_id}", $test_id, $form);
		
		$form=str_replace("{test_caption}", "Редагувати вікторину", $form);
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{time}", $time, $form);
		$form=str_replace("{rate}", $rate, $form);
		$form=str_replace("{tv_form}", $this->show_tv_form($tv), $form);	
		
		$form=str_replace("{navigation}",$this->show_navigation(""),$form);
		return $form;
	}
	
	function save_test(){
		$db=new db; $slave=new slave;
		$test_id=$slave->qq($_POST["test_id"]);
		$caption=$slave->qq($_POST["caption"]);
		$time=$slave->qq($_POST["time"]);
		$rate=$slave->qq($_POST["rate"]);
		$tv=$slave->qq($_POST["tv"]);
		
		$db->query("update test set caption='$caption', rate='$rate', `time`='$time', tv='$tv' where id='$test_id';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Вікторину &quot;$caption&quot; успішно збережено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($test_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_test($test_id){
		$db=new db;
		$db->query("update test set ison='0' where id='$test_id';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Вікторину успішно видалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($test_up,""),$form);
		$form=str_replace("{test_menu}","",$form);
		return $form;
	}
	//---------------------------
	function new_question($test_id,$var){
		$db=new db; $slave=new slave;$mdl=new module; list($dep_up,$cur_id)=$slave->get_file_deps("test");
		$form_htm=RD."/tpl/test_question_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("question") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ua";
		$editor->Value	= "" ;
		
		if ($var!=""){
			$answer_form="";
			if ($var=="3"){
				$answer_form="
				<table align='center' border=0>
				<tr><th>Правильна відповідь:</th></tr>
				<tr><td><input type='text' name='inptext' style='width: 500px;'></td></tr></table>";
			}
			if ($var!=3){
				$answer_form="<table border='0' width='100%'>
				<tr bgcolor='#ebebeb'>
					<th width='1%' align=center>№</th>
					<th>&nbsp;&nbsp;Вiдповiдь</th>
					<th width='5%'>Правильна відповідь</th>
				</tr>";
				for ($i=1; $i<=10; $i++) {
					$answer_form.="<tr align='center'><td>$i.</td><td><textarea style='width: 100%; height: 40px;' name='answer$i'></textarea></td>";
					if ($var=="1"){	$answer_form.= "<td><input type='radio' name='radio' value='$i'></td>"; }
					if ($var=="2"){ $answer_form.= "<td><input type='checkbox' name='check$i' value='$i'></td>"; }
					if ($var=="4"){ $answer_form.= "<td><input type='text' name='upo$i' style='width: 200px;'></td>"; }
					if ($var=="5"){ $answer_form.= "<td><input type='text' name='edit$i' size='2' maxlength='2'></td>"; }
					$answer_form.= "</tr>";
				}
				$answer_form.="</table>";
			}
			$disabled="";
		}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $dep_up, $form);
		$form=str_replace("{cur_id}", $cur_id, $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{test_id}", $test_id, $form);
		$form=str_replace("{question_id}", "", $form);
		$form=str_replace("{var_form}", $this->show_var_form($var,$disabled), $form);
		
		$form=str_replace("{test_caption}", "Нове питання вікторини &quot;".$this->get_test_caption($test_id)."&quot;", $form);
		$form=str_replace("{question_form}", $editor->Create(), $form);
		$form=str_replace("{answer_form}", $answer_form, $form);
		
		$form=str_replace("{navigation}",$this->show_navigation($test_id),$form);
		return $form;
	}
	
	function add_question(){
		$db=new db; $slave=new slave;
		$test_id=$slave->qq($_POST["test_id"]);
		$question=$slave->qq($_POST["question"]);
		$var=$slave->qq($_POST["var"]);
		
		$r=$db->query("select max(id) as mid from test_question;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into test_question values ('$mid','$test_id','$question','$var','1');");
		
		if ($var=="3"){
			$ans=$slave->qq($_POST["inptext"]);
			$db->query("insert into test_answer values ('','$test_id','$mid','','','','$ans','','');");
		}
		if ($var!=3){
			for ($i=1; $i<=10; $i++) {
				$answer=$slave->qq($_POST["answer$i"]);
				$check=$_POST["check$i"];
				$radio=$_POST["radio"];
				$upo=$slave->qq($_POST["upo$i"]);
				$edit=$_POST["edit$i"];
				
				if ($answer!=""){
					if ($var=="1" and $i==$radio){ $db->query("INSERT INTO test_answer VALUES ('','$test_id','$mid', '$answer', '1', '', '', '', '');"); }
					if ($var=="1" and $i!=$radio){ $db->query("INSERT INTO test_answer VALUES ('','$test_id','$mid', '$answer', '0', '', '', '', '');"); }
					if ($var=="2" and $i==$check){ $db->query("INSERT INTO test_answer VALUES ('','$test_id','$mid', '$answer', '', '1', '', '', '');"); }
					if ($var=="2" and $i!=$check){ $db->query("INSERT INTO test_answer VALUES ('','$test_id','$mid', '$answer', '', '0', '', '', '');"); }
					if ($var=="4"){ $db->query("INSERT INTO test_answer VALUES ('','$test_id','$mid', '$answer', '', '', '', '$upo', '');"); }
					if ($var=="5"){	$db->query("INSERT INTO test_answer VALUES ('','$test_id','$mid', '$answer', '', '', '', '', '$edit');"); }
				}
			}
		}
		
		
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Питання вікторини успішно створено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function edit_question($test_id){
		$db=new db; $slave=new slave;$mdl=new module; list($dep_up,$cur_id)=$slave->get_file_deps("test");
		$form_htm=RD."/tpl/test_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from test where id='$test_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$rate=$slave->qqback($db->result($r,0,"rate"));
			$time=$slave->qqback($db->result($r,0,"time"));
			$tv=$db->result($r,0,"tv");
		}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $dep_up, $form);
		$form=str_replace("{cur_id}", $cur_id, $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{test_id}", $test_id, $form);
		
		$form=str_replace("{test_caption}", "Редагувати вікторину", $form);
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{time}", $time, $form);
		$form=str_replace("{rate}", $rate, $form);
		$form=str_replace("{tv_form}", $this->show_tv_form($tv), $form);	
		
		$form=str_replace("{navigation}",$this->show_navigation(""),$form);
		return $form;
	}
	
	function save_question(){
		$db=new db; $slave=new slave;
		$test_id=$slave->qq($_POST["test_id"]);
		$caption=$slave->qq($_POST["caption"]);
		$time=$slave->qq($_POST["time"]);
		$rate=$slave->qq($_POST["rate"]);
		$tv=$slave->qq($_POST["tv"]);
		
		$db->query("update test set caption='$caption', rate='$rate', `time`='$time', tv='$tv' where id='$test_id';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Вікторину &quot;$caption&quot; успішно збережено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($test_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_question($test_id){
		$db=new db;
		$db->query("update test set ison='0' where id='$test_id';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Вікторину успішно видалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($test_up,""),$form);
		$form=str_replace("{test_menu}","",$form);
		return $form;
	}
	
	function show_navigation($id){
		$db=new db; $mdl=new module; $url=$mdl->get_file_url();
		if ($id!=""){$nav_menu="<a class='navigation' href='?$url'>До списку вікторин</a>".$nav_menu;}
		if ($id==""){$nav_menu="<a class='navigation' href='?$url'>До списку вікторин</a>".$nav_menu;}
		return $nav_menu;
	}
	
	function test_menu($wn){
		$mdl=new module; $url=$mdl->get_file_url();$test_id=$this->get_test_id();
		$test_menu_htm=RD."/tpl/test_menu.htm";
		if (!file_exists("$test_menu_htm")){ $menu="Не знайдено файл шаблону"; }
		if (file_exists("$test_menu_htm")){ $menu = file_get_contents($test_menu_htm);}
		if ($wn==""){ 
			$menu=str_replace("{url}","?".$url."&wn=new_test",$menu);
			$menu=str_replace("{alt}","Нова віторина",$menu);
		}
		if ($wn=="new_question"){ 
			$menu=str_replace("{url}","?".$url."&wn=new_question&test_id=$test_id",$menu);
			$menu=str_replace("{alt}","Нове питання віторини",$menu);
		}
		
		return $menu;
	}
	
	function get_test_caption($test){
		$db=new db;$slave=new slave;
		$r=$db->query("select caption from test where id='$test' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){ return $caption=$db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
	function get_var_caption($var){
		$db=new db;$slave=new slave;
		$r=$db->query("select caption from test_var where id='$var' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){ return $caption=$db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
	
	function show_tv_form($tv){
		$form="<select name='tv' id='tv' size=1>";
		if ($tv=="1"){$sel1=" selected"; $sel2=""; }	
		if ($tv=="2"){$sel2=" selected"; $sel1=""; }	
		$form.="<option value='1 $sel1'>Час на питання</opinion><option value='2' $sel2>Час на вікторину</opinion>";
		$form.="</select>";
		return $form;
	}
	function show_var_form($var,$disabled){
		$db=new db;$slave=new slave; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();$wn=$slave->get_wn(); $test_id=$this->get_test_id();
		$r=$db->query("select * from test_var order by id asc;");
		$n=$db->num_rows($r);
		$form="<select name='var' $disabled size='1' style='width: 300px;' onchange='location.href=\"?$url&wn=$wn&test_id=$test_id&var=\"+this[this.selectedIndex].value'><option value='0'>----</option>";
		for ($i=1; $i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$selected="";if ($id==$var){$selected=" selected";}
			$form.="<option value='$id'$selected>$caption</option>";
		}
		$form.="</select>";
		return $form;
	}

	function get_test_id(){ if ($_POST["test_id"]==""){return $_GET["test_id"];} if ($_POST["test_id"]!=""){return $_POST["test_id"];} }
}
?>