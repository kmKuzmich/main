<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 27.03.2016
 * Time: 10:33
 */
/*require_once('search.php');
$form = file_get_contents('../tpl/catalogue_items1_list.htm');
if ($form) echo $form;
else echo 'file not found';*/

$set = array(
    'name' => 'febi',
    'code' => '07200'
);

echo getSetValues($set);

echo '<br/>' . implode(', ', $set);
echo '<br/>' . getSetValues1($set) . '<br/>';
$a1=''+0;
echo '$a1 + 10 =',$a1+0,' select evr';

function getSetValues($params)
{
    foreach ($params as $key => $value) {
        $set[] = $key . '="' . $value . '"';
    }
//    return implode( ' , ', (array)$set );
    return implode(' , ', $set);
}


function getSetValues1($params)
{
    foreach ($params as $key => $value) {
        $set[] = $key . '="' . $value . '"';
    }
    return implode(' , ', (array)$set);
}

?>


