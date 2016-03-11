<?
class price {
	
	function create_price(){
		list($data,$m)=$this->create_menu();		
		$this->create_excel_file($data,$m);
	}
	
	function create_excel_file($data,$m){
		
		set_include_path(get_include_path().PATH_SEPARATOR.'PhpExcel/Classes/');
		include_once 'PHPExcel/IOFactory.php';
		$objPHPExcel = PHPExcel_IOFactory::load("price/template.xls");
		$objPHPExcel->setActiveSheetIndex(0);
		
		$aSheet = $objPHPExcel->getActiveSheet();
		
		$baseFont = array('font'=>array('name'=>'Arial Cyr','size'=>'10','bold'=>false));
		$boldFont = array('font'=>array('name'=>'Arial Cyr','size'=>'10','bold'=>true),'fill'=> array('type'       => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'D2E4F7'),'endcolor'   => array('rgb' => 'D2E4F7')));	
		$right = array(	'alignment'=>array(	'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP));

		
		$pos=8;
		for ($i=1;$i<=$m;$i++){$pos++;
			
			if ($data[$i]["price"]==""){			
				$aSheet->getStyle('A'.$pos)->applyFromArray($boldFont);
				$aSheet->getStyle('B'.$pos)->applyFromArray($boldFont);
				$aSheet->getStyle('C'.$pos)->applyFromArray($boldFont);
			}
			if ($data[$i]["price"]!=""){			
				$aSheet->getStyle('A'.$pos)->applyFromArray($baseFont);
				$aSheet->getStyle('B'.$pos)->applyFromArray($baseFont);
				$aSheet->getStyle('C'.$pos)->applyFromArray($baseFont)->applyFromArray($right);
			}
			$aSheet->setCellValue("A$pos",mb_convert_encoding($data[$i]["code"],'utf-8', 'windows-1251'));
			$aSheet->setCellValue("B$pos",mb_convert_encoding($data[$i]["caption"],'utf-8', 'windows-1251'));
			$aSheet->setCellValue("C$pos",mb_convert_encoding($data[$i]["price"],'utf-8', 'windows-1251'));
			
		}
		
		
		//отдаем пользователю в браузер
		include("PHPExcel/Writer/Excel5.php");
		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="omega_price.xls"');
		header('Cache-Control: max-age=0');
		$objWriter->save('php://output');
	}
	
	function create_menu(){
		session_start();
		$db=new db;$slave=new slave;$catalogue=new catalogue;
		$top_id=1; $cur_id=$top_id; $top_id=$catalogue->get_top_id($cur_id); $dep="23";
				
		$r=$db->query("select id,code,caption from catalogue where top_id='0' and code<>'€€€€€€€€' and ison='1' and is_folder='1' order by code asc limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){$m=0;
			for ($i=1;$i<=$n;$i++){$m++;
				$id=$db->result($r,$i-1,"id");
				$code=$db->result($r,$i-1,"code");
				$caption=$db->result($r,$i-1,"caption");
				
				$data[$m]["id"]=$id;
				$data[$m]["code"]=$code;
				$data[$m]["caption"]=$slave->qqback($caption);

				list($data,$m)=$this->show_next_level($data,$id,$m);
				
			}
		}
		return array($data,$m);
	}
	
	function show_next_level($data,$cur_id,$m){
		$db=new db; $slave=new slave;
		$r=$db->query("select id,code,caption from catalogue where top_id='$cur_id' and is_folder='1' and ison='1' order by id asc;");
		$n=$db->num_rows($r);
		if ($n==0){
			list($data,$m)=$this->show_models($data,$cur_id,$m);
		}
		if ($n>0){
			for ($i=1;$i<=$n;$i++){$m++;
				$id=$db->result($r,$i-1,"id");
				$code=$db->result($r,$i-1,"code");
				$caption=$slave->qqback($db->result($r,$i-1,"caption"));
				
				
				$data[$m]["id"]=$id;
				$data[$m]["code"]=$code;
				$data[$m]["caption"]=$caption;

				list($data,$m)=$this->show_next_level($data,$id,$m);
			}
		}
		return array($data,$m);
	}
	function show_models($data,$cur_id,$m){
		$db=new db; $slave=new slave;$client=$_SESSION["client"];$disc=$_SESSION["discount"];if ($disc==0 or $disc==""){$disc=1;}$dep=23;
		$r=$db->query("select id,code,caption,price$disc from catalogue where top_id='$cur_id' and is_folder='2' and ison='1' order by id asc;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){$m++;
				$id=$db->result($r,$i-1,"id");
				$code=$db->result($r,$i-1,"code");
				$caption=$slave->qqback($db->result($r,$i-1,"caption"));
				$price=$slave->int_to_money($db->result($r,$i-1,"price$disc"));
				
				$data[$m]["id"]=$id;
				$data[$m]["code"]="=HYPERLINK(\"http://omega.km.ua/index.php?dep=$dep&w=show_model&top_id=$cur_id&model=$id\",\"".$code."\")";
				$data[$m]["caption"]=$caption;
				$data[$m]["price"]=$price;
			}
		}
		return array($data,$m);
	}
}
?>