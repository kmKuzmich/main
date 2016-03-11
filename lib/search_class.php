<?php
class search {
	function show_search_result($sch){$db=new db; $slave=new slave; $cat=new catalogue;
		$empty1=false;$empty2=false;
		$sch=preg_replace("/[^\w\x7F-\xFF\s]/", " ", $sch);
		$sch = trim(preg_replace("/\s(\S{1,1})\s/", " ", ereg_replace(" +", "  "," $sch ")));
		$sch = ereg_replace(" +", " ", $sch); $sch_main=$sch;
		$r_list="<table width='100%' cellpadding=1 cellspacing=1 border=0 id='catalogue'><tr><td colspan=20 style='font:italic 14px Tahome;color : #5c5d72;'>{summary}</td></tr>";
		//------------------------------------------------------------------
			$sch=$sch_main;
			if ($sch!=""){
				$where="";
				$fl = array('1' => 'caption','2' => 'short_desc','3' => '`desc`', '4' => '`price1`'); $kolfl=4;
				$vl = array('1'=>'у','2'=>'е','3'=>'а','4'=>'о','5'=>'є','6'=>'я','7'=>'и','8'=>'і','9'=>'ю','10'=>'','11'=>'ь');$kolvl=11;
				$sch1=$sch;$sch="";
				$sch1 = explode(" ", $sch1);
				foreach($sch1 as $tes1){
					$er=0;
						$end_l=substr($tes1,strlen($tes1)-1,1);
						for ($i=1;$i<=$kolvl;$i++){ if ($end_l==$vl[$i]){ $er=1; } }
						if ($er==1){
							for ($i=1;$i<=$kolvl;$i++){ $sch.=substr($tes1,0,strlen($tes1)-1).$vl[$i]." "; }
						}
						if ($er==0){
							for ($i=1;$i<=$kolvl;$i++){ $sch.=substr($tes1,0,strlen($tes1)).$vl[$i]." "; }
						}
				}
				$sch=substr($sch,0,strlen($sch)-1);
				for ($i=1;$i<=$kolfl;$i++){ 
					if ($i<$kolfl){$where.=" $fl[$i] LIKE '%". str_replace(" ", "%' OR $fl[$i] LIKE '%", $sch). "%' OR "; }
					if ($i==$kolfl){$where.=" $fl[$i] LIKE '%". str_replace(" ", "%' OR $fl[$i] LIKE '%", $sch). "%'"; }
				}	
				if ($where!=""){$where="WHERE (".$where.") and ison='1' and is_folder='2'";}
			}

			$r=$db->query("SELECT * FROM catalogue $where;");
			$n=$db->num_rows($r);
			if ($n==0){ $empty1=true;}$nn=$n;if ($n>100){$nn=100;}
			for ($i=1; $i<=$nn; $i++){
				$id=$db->result($r,$i-1,"id");
				$is_folder=$db->result($r,$i-1,"is_folder");
				$caption=$db->result($r,$i-1,"caption");
				$desc=$db->result($r,$i-1,"desc");
				$short_desc=$db->result($r,$i-1,"short_desc");
				$price=$db->result($r,$i-1,"price1");
				$top_id=$db->result($r,$i-1,"top_id");
	
				$a[$i][0]=0;
				$a[$i][1]=$id;
				$a[$i][2]=$is_folder;
				$a[$i][3]=$caption;
				$a[$i][4]=$short_desc;
				$a[$i][5]=$desc;
				$a[$i][6]=$price;
				$a[$i][7]=$top_id;
				if ($sch!=""){
					$sch1 = explode(" ", $sch);
					foreach($sch1 as $tes1){ 
						if (stristr($caption,$tes1)!=""){$a[$i][0]+=30;} 
						if (stristr($short_desc,$tes1)!=""){$a[$i][0]+=10;} 
						if (stristr($desc,$tes1)!=""){$a[$i][0]+=10;} 
						if (stristr($price,$tes1)!=""){$a[$i][0]+=20;} 
					}
				}
			}
			if ($sch1!=""){
				for ($i=1;$i<=$n;$i++){ $b[$i]=$a[$i][0]; }
				if ($b!=""){arsort($b); reset($b);}
			}
			if ($sch1==""){$b=$a;}$k=0;$nn=$n;
			if ($n>100){$nn=100;}
			for ($i=1;$i<=$nn;$i++){$k++;
				list($key, $val) = each($b);
				if ($k==1){$r_list.="<tr valign='top' align='center'>";}
				if ($a[$key][2]=="2"){ $r_list.="<td width='25%'>".$cat->show_model_search($a[$key][1])."</td>";}
				if ($k==4){$r_list.="</tr>";$k=0;}
				if ($k == 0 ){$r_list.="<tr><td colspan=4 height='40'>&nbsp;</td></tr>";}
			}
			$summary="Товаров: $n<br />";
			
		//------------------------------------------------------------------
		
			$sch=$sch_main;
			if ($sch!=""){
				$where="";$a=null;$b=null;
				$fl = array('1' => 'deps.caption','2' => 'deps.`desc`');	$kolfl=2;
				$vl = array('1'=>'у','2'=>'е','3'=>'а','4'=>'о','5'=>'є','6'=>'я','7'=>'и','8'=>'і','9'=>'ю','10'=>'','11'=>'ь');$kolvl=11;
				$sch1=$sch;$sch="";
				$sch1 = explode(" ", $sch1);
				foreach($sch1 as $tes1){
					$er=0;
						$end_l=substr($tes1,strlen($tes1)-1,1);
						for ($i=1;$i<=$kolvl;$i++){ if ($end_l==$vl[$i]){ $er=1; } }
						if ($er==1){
							for ($i=1;$i<=$kolvl;$i++){ $sch.=substr($tes1,0,strlen($tes1)-1).$vl[$i]." "; }
						}
						if ($er==0){
							for ($i=1;$i<=$kolvl;$i++){ $sch.=substr($tes1,0,strlen($tes1)).$vl[$i]." "; }
						}
				}
				$sch=substr($sch,0,strlen($sch)-1);
				for ($i=1;$i<=$kolfl;$i++){ 
					if ($i<$kolfl){$where.=" $fl[$i] LIKE '%". str_replace(" ", "%' OR $fl[$i] LIKE '%", $sch). "%' OR "; }
					if ($i==$kolfl){$where.=" $fl[$i] LIKE '%". str_replace(" ", "%' OR $fl[$i] LIKE '%", $sch). "%'"; }
				}	
				if ($where!=""){$where="WHERE".$where." and ison='1'";}
			}
		
			$r=$db->query("SELECT * FROM deps $where ORDER BY id asc;");
			$n=$db->num_rows($r);
			if ($n==0){ $empty2=true;}
			for ($i=1; $i<=$n; $i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$desc=$db->result($r,$i-1,"desc");
				$dep_up=$db->result($r,$i-1,"dep_up");
	
				$a[$i][0]=0;
				$a[$i][1]=$id;
				$a[$i][2]=$caption;
				$a[$i][3]=$desc;
				$a[$i][4]=$dep_up;
				if ($sch!=""){
					$sch1 = explode(" ", $sch);
					foreach($sch1 as $tes1){ 
						if (strstr($caption,$tes1)!=""){$a[$i][0]+=30;} 
						if (strstr($desc,$tes1)!=""){$a[$i][0]+=10;} 
					}
				}
			}
			if ($sch1!=""){
				for ($i=1;$i<=$n;$i++){ $b[$i]=$a[$i][0]; }
				if ($b!=""){arsort($b); reset($b);}
			}
			if ($sch1==""){$b=$a;}
			for ($i=1;$i<=$n;$i++){
				list($key, $val) = each($b);
				$r_list.="<tr><td colspan=2>$i. <a href='?dep=1&dep_up={$a[$key][4]}&dep_cur={$a[$key][1]}'><b>{$a[$key][2]}</b></a></td></tr>";
			}
			$summary.="Разделов на сайте: $n<br />";

		//----------------------------------------------------------			
		if ($empty1==true and $empty2==true){$r_list.="<tr><td align='center' class='alert'><br><br><br>По Вашему запросу ничего не найдено!<br><br><br></td></tr>";}
		$r_list.="</table><br><br>";
		$r_list=str_replace("{summary}",$summary,$r_list);
		return $r_list;
	}
}
?>