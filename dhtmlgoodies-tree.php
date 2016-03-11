<?php

include("dhtmlgoodies_tree.class.php");

?>
<a href="#" onclick="initTree();return false">initTree</a><br>
<a href="#" onclick="expandAll();return false">Expand all nodes</a><br>
<a href="#" onclick="collapseAll();return false">Collapse all nodes</a><br>
<?

$PROVIDER_ID=20122;
$TecdocToCat="http://webservicepilot.tecdoc.net/pegasus-2-0/wsdl/TecdocToCat";
$soap = new SoapClient($TecdocToCat, array('trace' => true,));
try {
        $result = $soap->getLinkedChildNodesAllLinkingTarget(array(
                'provider' => $PROVIDER_ID,
				'parentNodeId' => '',
				'linkingTargetType'=>'C',
				'linkingTargetId'=>22627,
				'lang' => 'ru',
				'country' => 'ru',
				'childNodes'=>true,
	
    	    ));
//			print_r($result);
			$result=$result->data->array;
			$tree = new dhtmlgoodies_tree();
			foreach ($result as $item){
				$id=$item->assemblyGroupNodeId;
				$caption=iconv("utf-8","windows-1251",$item->assemblyGroupName);
				$child=$item->hasChilds;
				$parrent=$item->parentNodeId; if ($parrent==""){$parrent=0;}
				$tree->addToArray($id,$caption,$parrent,"","",$child,"showItem('$id')");
			}
			$tree->writeCSS();
			$tree->writeJavascript();
			$menu=$tree->drawTree();

			print $menu;
/*		$result=$result->data->array;
		foreach ($result as $item){
			print $item->manuId."->".$item->manuName."<br>";
		}
*/
		
		
} catch(SoapFault $e) {
       
}

	// Creating new tree object

// Adding example nodes

?>
</body>
</html>
	
	