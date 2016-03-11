<?
class vote{
function add_answer($vote_answer){
	$db=new db; $config=new config;session_start();
	$r=$db->query("select votes from sub_vote where id='$vote_answer';");
	$n=$db->num_rows($r);
	if ($n>0){
		$votes=$db->result($r,0,"votes")+1;
	}
	if ($_SESSION["mvote"]!="1"){ $db->query("update sub_vote set votes='$votes' where id='$vote_answer';");}
	$_SESSION["mvote"]="1";
	return $this->show_vote_form();
}



function show_vote_form(){
	$db=new db; $slave=new slave;
	session_start();
	$r=$db->query("select * from vote where ison='1' order by id desc limit 0,1;");
	$n=$db->num_rows($r);
	if ($n>0){
		$vote_form_htm=RD."/tpl/vote_form.htm";
		if (!file_exists("$vote_form_htm")){ $vote_form="Не знайдено файл шаблону"; }
		if (file_exists("$vote_form_htm")){ $vote_form = file_get_contents($vote_form_htm);}

		$vote_id=$db->result($r,0,"id");
		if ($vote_id!=$_SESSION["vote_id"]){$_SESSION["vote_id"]="";$_SESSION["mvote"]="0";}
		$_SESSION["vote_id"]=$vote_id;
		$vote_caption=$db->result($r,0,"caption");
		
		$r1=$db->query("select max(votes) as maxv from sub_vote where vote_id='$vote_id';");
		$maxvote=$db->result($r1,0,"maxv");
		
		if ($_SESSION["mvote"]=="1"){$order="votes desc";}
		if ($_SESSION["mvote"]!="1"){$order="id asc";}
		
		$r1=$db->query("select * from sub_vote where vote_id='$vote_id' order by $order;");
		$n1=$db->num_rows($r1);$answer_list="";
		for ($i=1;$i<=$n1;$i++){
			$vid=$db->result($r1,$i-1,"id");
			$vcap=$db->result($r1,$i-1,"caption");
			$vvotes=$db->result($r1,$i-1,"votes");
			if ($maxvote>0){ $wdth=$vvotes*70/$maxvote;}
			if ($maxvote==0){ $wdth=0;}
			$answer_list.="<tr>";
			if ($_SESSION["mvote"]!="1"){ $answer_list.="<td align='center'><input type='radio' name='vote' value='$vid' onclick='javascript:load_content(\"content.php?dep=$dep&w=save_vote_answer&vote_answer=$vid\",\"vote\",\"\");'></td><td colspan='3' align='left'>$vcap</td>"; }
			if ($_SESSION["mvote"]=="1"){ $answer_list.="<td align='center'>$i</td><td width='250' align='left'>$vcap</td><td width='300' align='left'><img src='uploads/images/vote/vote.gif' width='$wdth' height='7' border=0></td><td align='center'>$vvotes</td>"; }
			$answer_list.="</tr>";
		}
		$vote_form=str_replace("{vote_caption}",$vote_caption,$vote_form);
		$vote_form=str_replace("{answer_list}",$answer_list,$vote_form);
	}
	return $vote_form;
}	

}
?>