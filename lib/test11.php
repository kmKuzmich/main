<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 27.03.2016
 * Time: 10:33
 */
require_once('search.php');
$form = file_get_contents('../tpl/catalogue_items1_list.htm');
if ($form) echo $form;
else echo 'file not found';


