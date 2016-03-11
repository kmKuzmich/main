<? 
class date_menu {
	function show_calendar($m,$y){
	    if ((!$m) || (!$y)){ 
	        $m = date("m",mktime());
    	    $y = date("Y",mktime());
	    }
		$slave=new slave;
		list($dep_up,$dep_cur)=$slave->get_file_deps("news");
    	/*== get what weekday the first is on ==*/
	    $tmpd = getdate(mktime(0,0,0,$m,1,$y));
    	$month = $tmpd["month"]; 
	    $firstwday= $tmpd["wday"];
    	$lastday = $this->mk_getLastDayofMonth($m,$y);
		switch($month){
			case 'January': $month_ua="Январь"; break;
			case 'February': $month_ua="Февраль"; break;
			case 'March': $month_ua="Март"; break;
			case 'April': $month_ua="Апрель"; break;
			case 'May': $month_ua="Май"; break;
			case 'June': $month_ua="Июнь"; break;
			case 'July': $month_ua="Июль"; break;
			case 'August': $month_ua="Август"; break;
			case 'September': $month_ua="Сентябрь"; break;
			case 'October': $month_ua="Октябрь"; break;
			case 'November': $month_ua="Ноябрь"; break;
			case 'December': $month_ua="Декабрь"; break;
		}
		if (($m-1)<1){ $m_p=12;} else {$m_p=$m-1;}
		if (($m-1)<1){ $y_p=$y-1;}else {$y_p=$y;}
		
		if(($m+1)>12){ $m_n=1;} else {$m_n=$m+1;}
		if (($m+1)>12){$y_n=$y+1;}else {$y_n=$y;}
		
		$date_form="<table cellpadding=2 cellspacing=0 border=0 width='100%'>
		<tr><td colspan=7 bgcolor='#CCCCDD'>
			<table cellpadding=0 cellspacing=0 border=0 width='100%'>
				<tr><th width='20'><a class='cap' href='?dep=news&dep_up=$dep_up&dep_cur=$dep_cur&m=$m_p&y=$y_p'>&lt;&lt;</a></th>
				<th><font size=2>$month_ua $y</font></th>
				<th width='20'><a class='cap' href='?dep=news&dep_up=$dep_up&dep_cur=$dep_cur&m=$m_n&y=$y_n'>&gt;&gt;</a></th>
		    </tr></table>
		</td></tr>
		<tr><th width=22 class='cap'>Нд</th><th width=22 class='cap'>Пн</th>
			<th width=22 class='cap'>Вт </th><th width=22 class='cap'>Ср</th>
			<th width=22 class='cap'>Чт</th><th width=22 class='cap'>Пт</th>
			<th width=22 class='cap'>Сб</th></tr>";
		$d = 1;
		$wday = $firstwday;
		$firstweek = true;
		/*== loop through all the days of the month ==*/
		while ( $d <= $lastday) {
			/*== set up blank days for first week ==*/
	        if ($firstweek) {
    	        $date_form.="<tr align='center'>";
        	    for ($i=1; $i<=$firstwday; $i++) { $date_form.="<td class='text'><font size=2>&nbsp;</font></td>"; }
	            $firstweek = false;
    	    }
			
	        /*== Sunday start week with <tr> ==*/
    	    if ($wday==0) { $date_form.="<tr align='center'>"; }

        	/*== check for event ==*/  
			if (strlen($d)==1){$dd="0".$d;}else {$dd=$d;}
			if ($d==date("d")){ $date_form.="<td class='text' bgcolor='#EDDFD6'><a href='?dep=news&dep_up=$dep_up&dep_cur=$dep_cur&date=$y-$m-$d&m=$m&y=$y'><b>$d</b></a></td>\n";}
			if ($d!=date("d")){ $date_form.= "<td class='text'><a href='?dep=news&dep_up=$dep_up&dep_cur=$dep_cur&date=$y-$m-$dd&m=$m&y=$y'>$d</a></td>\n"; }

    	    /*== Saturday end week with </tr> ==*/
        	if ($wday==6) { $date_form.="</tr>"; }

	        $wday++;
    	    $wday = $wday % 7;
        	$d++;
	    }
		$date_form.="</tr></table>";
		return $date_form;
	} 

	function mk_getLastDayofMonth($mon,$year){
	    for ($tday=28; $tday <= 31; $tday++) {
			$tdate = getdate(mktime(0,0,0,$mon,$tday,$year));
			if ($tdate["mon"] != $mon) { break; }
		}
		$tday--;
		return $tday;
	}
}

?>


