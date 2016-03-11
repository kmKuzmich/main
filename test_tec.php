<?php

$PROVIDER_ID=20122;
$TecdocToCat="http://webservice-cs.tecdoc.net/pegasus-2-0/wsdl/TecdocToCat";
$soap = new SoapClient($TecdocToCat, array('trace' => true,));
/*			$result = $soap->getAssignedArticlesByIds2Single(array(
       	        'provider' => $PROVIDER_ID,'lang' => 'ru','country' => 'ru',
				'modId'=>'-1', 'manuId'=>'-1',
				'linkingTargetType'=>'C', 'linkingTargetId'=>'-1','attributs'=>true,
				'priceDate'=>Null,'info'=>true,'prices'=>false,
				'eanNumbers'=>false,'usageNumbers'=>false,'replacedByNumbers'=>true,'replacedNumbers'=>true,'mainArticles'=>true,'documents'=>true,
				'oeNumbers'=>'','normalAustauschPrice'=>true,'immediateAttributs'=>true,
				'immediateInfo'=>'','documentsData'=>true,'articleId'=>'2209623','articleLinkId'=>'',
    	    ));
*/	       $result = $soap->getArticleDirectSearchAllNumbers2(array(
                'provider' => $PROVIDER_ID,'lang' => 'ru','country' => 'ru',
				'sortType'=>'0',
				'searchExact'=>'true',
				'numberType'=>'0',
				'genericArticleId'=>'',
				'brandno'=>'16',
				'articleNumber'=>'44-042301',
    	    ));
			print_r($result);
			$result = $soap->getArticleDocuments(array(
        	        'provider' => $PROVIDER_ID,'lang' => 'ru','country' => 'ru',
					'articleId'=>'4649977',
	    	    ));
			print_r($result);
/*			$result=$result->data->array;
			foreach ($result as $item){
				$articleName=iconv("utf-8","windows-1251",$item->articleName);
				$articleSearchNo=iconv("utf-8","windows-1251",$item->articleSearchNo);
				$articleNo=iconv("utf-8","windows-1251",$item->articleNo);
				print "$articleName=$articleSearchNo=$articleNo<br />";
			}
			
*/
?>