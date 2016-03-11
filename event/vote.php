<?php
include RD.'/lib/vote_class.php';
$vote= new vote;
if ($w=="set_answer"){
	$vote->add_answer();
	$w="";
}
if ($w==""){
	$content=str_replace("{vote}", $vote->show_vote(), $content);
}
?>