<?php

class banner
{
    function returnType($filename)
    {
        preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);
        return strtolower($fileSuffix[1]);
    }

    function show_big_banners()
    {
        $db = new db;
        $slave = new slave;
        $cur_data = date("Y-m-d");
        $r = $db->query_lider("select * from actions where visible='1' order by lenta asc;");
        $n = $db->num_rows($r);
        $list = "";
        for ($i = 1; $i <= $n; $i++) {
            $id = $db->result($r, $i - 1, "id");
            $file_name = $db->result($r, $i - 1, "file");
            $url = $db->result($r, $i - 1, "url");
            $list .= "
			<div data-delay='5' data-thumb='http://www.avtolider-ua.com/$file_name' width='80'>
				<a href='$url'><img src='http://www.avtolider-ua.com/$file_name' width='480' border=0 alt='$caption' /></a>
			</div>";
            /*
                        http://demo.takerootdesign.co.uk/cycletutorial/index.html
                        if ($file_type=="2"){
                            list($width,$height)=getimagesize("uploads/images/banners/$file_name");

                                $list.="
                                <object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0\" width=\"$width\" height=\"$height\" id=\"banner\" align=\"middle\"><param name=\"allowScriptAccess\" value=\"sameDomain\" /><param name=\"allowFullScreen\" value=\"false\" /><param name=\"movie\" value=\uploads/images/banners/$file_name\" /><param name=\"quality\" value=\"high\" /><param name=\"bgcolor\" value=\"#ffffff\" />
                                <embed src=\"uploads/images/banners/$file_name\" quality=\"high\" bgcolor=\"#ffffff\" width=\"$width\" height=\"$height%\" name=\"banner\" align=\"middle\" allowScriptAccess=\"sameDomain\" allowFullScreen=\"false\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.adobe.com/go/getflashplayer\" /></object>";

                        }
                        */
        }
        return $list;
    }


}

?>