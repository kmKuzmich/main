<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define("RD", dirname (__FILE__));
/*
define("PROVIDER_ID", "20122");
define("TecdocToCat", "http://webservice-cs.tecdoc.net/pegasus-2-0/wsdl/TecdocToCat");

function getArticleId($code){
		$soap = new SoapClient(TecdocToCat, array('trace' => true,));
		try {
			$result = $soap->getArticleDirectSearchAllNumbers2(array(
				'provider' => PROVIDER_ID,'lang' => 'ru','country' => 'ru',
				'sortType'=>'0',
				'searchExact'=>'true',
				'numberType'=>'10',
				'genericArticleId'=>'',
				'articleNumber'=>$code,
    	    ));
			$empty=$result->data->empty;
			if (!$empty){
				$result=$result->data->array;$k=0;
				foreach ($result as $item){ 
					$articleId=$item->articleId;
					if ($articleId!=""){
						showAplicability($code,$articleId);
					}
				}
			}
		} catch(SoapFault $e) { }
		return;
	}
function showAplicability($code,$articleId){
			$soap = new SoapClient(TecdocToCat, array('trace' => true,));
			try {
	    	    $result = $soap->getArticleLinkedAllLinkingTarget2(array(
            	    'provider' => PROVIDER_ID,'country' => 'ru','lang' => 'ru',
					'linkingTargetType'=>'C','linkingTargetId'=>'-1','linkingTargetManuId'=>'','articleId'=>$articleId
	    	    ));
				$result=$result->data->array; $LinkId=array();$TargetId=array();$i=0;$prevManuDesc="";
				$fp = fopen('data_taras1.txt', 'a+');
				foreach ($result as $item){$i+=1;
					$LinkId=$item->articleLinkId;
					$TargetId=$item->linkingTargetId;
					$result = $soap->getArticleLinkedAllLinkingTargetsByIds2Single(array(
							'provider' => PROVIDER_ID,'country' => 'ru','lang' => 'ru',
							'linkingTargetType'=>'C','linkingTargetId'=>$TargetId,'articleLinkId'=>$LinkId,
							'immediateAttributs'=>true,'articleId'=>$articleId
	    	    	));
					$result=$result->data->array[0]->linkedVehicles->array;
					foreach ($result as $item){
						$manuDesc=iconv("utf-8","windows-1251",$item->manuDesc);
						if ($prevManuDesc!=$manuDesc){$prevManuDesc=$manuDesc;
							fwrite($fp, "$code;$manuDesc\n");
//							print "$code;$manuDesc<br />";
						}
					}
					break;
				}
				fclose($fp);
			} catch(SoapFault $e) {}
			return;
	}*/

$handle = @fopen("data_taras1.txt", "r");$codeAr=array();$carAr=array();$k=0;
if ($handle) {
	$fp = fopen('data_taras2.txt', 'a+');
	while (($str = fgets($handle, 4096)) !== false) {$str=trim($str);
		$ar=explode(";",$str);
		if (!in_array($ar[0], $codeAr)){$k+=1;
			$codeAr[$k]=$ar[0];$carAr[$k]=$ar[1];
			fwrite($fp, $ar[0].";".$ar[1]."\n");
		}
	}
	fclose($fp);
}
print_r($codeAr);

?>