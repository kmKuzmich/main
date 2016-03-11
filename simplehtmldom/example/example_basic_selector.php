<?php
// example of how to use basic selector to retrieve HTML contents
include('../simple_html_dom.php');
 
// get DOM from URL or file
//$html = file_get_html('http://tecdoc.webservice.linemedia.ru/details.php?manufacture=1505&model=4403&carId=13537&assemblyGroupNodeId=100455');
$html = file_get_html('http://tecdoc.webservice.linemedia.ru/details.php?manufacture=866&model=4129&carId=11735&assemblyGroupNodeId=100260');

$elements=$html->find('td');$k=0;
foreach($elements as $element){$k+=1;
	if ($k==1){	print "caption=".iconv("UTF-8","Windows-1251",$element->children(0)->plaintext);}
	if ($k==2){	print "brand=".iconv("UTF-8","Windows-1251",$element->children(0)->plaintext);}
	if ($k==3){	print "code=".iconv("UTF-8","Windows-1251",$element->children(0)->plaintext)."<br />";}
	if ($k==5){$k=0;}
}
//print_r($elements);
// find all link

?>