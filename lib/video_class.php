<?php
class video {
	function show_main_page_video(){$db=new db; $slave=new slave; $lan=$slave->get_lan();
		$video_htm=RD."/tpl/video_main_page.htm"; if (file_exists("$video_htm")){ $form = file_get_contents($video_htm);}
		$r=$db->query("select * from video where ison='1' order by RAND() limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1){
			$id=$db->result($r,0,"id");
			$theme=$db->result($r,0,"theme");
			$caption=$db->result($r,0,"caption_$lan");
			$src=$db->result($r,0,"src"); $data=$src; preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $data, $media);unset($data); $data=preg_replace('/(iframe|src)("|\'|="|=\')(.*)/i',"$3",$media[0]);
			$icon="<a href='javascript:showVideoMain(\"$id\");'><img src=\"http://i1.ytimg.com/vi/".str_replace("http://www.youtube.com/embed/","",$data[0])."/hqdefault.jpg\" border=0 alt='$caption' title='$caption' width='215' height='168'></a>";
		}
		$form=str_replace("{id}", $id, $form);
		$form=str_replace("{video}", $icon, $form);
				//      -----------------   list of videos     ------------------------
		$r=$db->query("select * from video where id!='$main_id' order by RAND() limit 0,2;");
		$n=$db->num_rows($r);
		if ($n>0){
			$list="<table align='center' width='100%' border='0' cellpadding=0 cellspacing=0>";
			for ($i=1;$i<=$n;$i++){$k++;
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption_$lan");
				$src=$db->result($r,$i-1,"src"); $data=$src; preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $data, $media);unset($data); $data=preg_replace('/(iframe|src)("|\'|="|=\')(.*)/i',"$3",$media[0]);
				$icon="<a href='javascript:showVideoMain(\"$id\");'><img src=\"http://i1.ytimg.com/vi/".str_replace("http://www.youtube.com/embed/","",$data[0])."/default.jpg\" width='115' border=0 alt='$caption' title='$caption'></a>";
				$list.="<tr valign='top'><td width='115' align='left'>$icon</td></tr>";
			}
			$list.="</table>";
		}
		$form=str_replace("{video_list}",$list,$form);
		return $form;
	}

	function show_video($id){$db=new db; $slave=new slave; $lan=$slave->get_lan();$cat=new catalogue;
		$form_htm=RD."/tpl/video_file.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		//      -----------------   first foto     ------------------------
		$r=$db->query("select * from video where id='$id' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){
			$main_id=$db->result($r,0,"id");
			$main_src=$db->result($r,0,"src");
			$main_caption=$db->result($r,0,"caption_$lan");
		}
		//      -----------------   list of videos     ------------------------
		$r=$db->query("select * from video where id!='$main_id' order by RAND() limit 0,4;");
		$n=$db->num_rows($r);
		if ($n>0){
			$list="<table align='center' width='100%' border='0' cellpadding=3 cellspacing=0>";
			for ($i=1;$i<=$n;$i++){$k++;
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption_$lan");
				$src=$db->result($r,$i-1,"src"); $data=$src; preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $data, $media);unset($data); $data=preg_replace('/(iframe|src)("|\'|="|=\')(.*)/i',"$3",$media[0]);
				$icon="<a href='javascript:showVideoMain(\"$id\");'><img src=\"http://i1.ytimg.com/vi/".str_replace("http://www.youtube.com/embed/","",$data[0])."/default.jpg\" border=0 alt='$caption' title='$caption'></a>";
				$list.="<tr valign='top'><td width='125' align='left'>$icon</td><td><a href='javascript:showVideoMain(\"$id\");'>$caption</a></td></tr>";
			}
			$list.="</table>";
		}
		$form=str_replace("{video_list}",$list,$form);
		$form=str_replace("{video}",$main_src,$form);
		$form=str_replace("{video_caption}",$main_caption,$form);
		$form=str_replace("{video_catalog}",$cat->show_video_catalog($main_id),$form);
		return $form;
	}

	function get_video($video){
		$db=new db; $slave=new slave;$dep=$slave->get_dep(); list($dep_up,$dep_cur)=$slave->get_file_deps("video");
		$form_htm=RD."/tpl/video_file_short.htm"; if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from video where id='$video' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){
			$video_id=$db->result($r,0,"id");
			$first_video=$db->result($r,0,"src");
			$first_caption=$db->result($r,0,"caption");
		}
		$form=str_replace("{video}",$first_video,$form);
		$form=str_replace("{caption}",$first_caption,$form);
		$form=str_replace("{data}",$first_data,$form);
		return $form;
	}
	//-----------------
}
?>