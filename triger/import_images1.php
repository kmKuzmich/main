<?php
error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
define('RD', dirname(__FILE__));
require_once(RD . "/../lib/odbc_class.php");
require_once(RD . "/../lib/slave_class.php");
$odb = new odb;
$slave = new slave;
$m = 0;
$prod_id = $_POST['prod_id'];
$rewrite = $_POST['rewrite'];
echo "<h2>Log загрузки изображений </h2>";
echo "Выбран производитель код = $prod_id, переpзаписывать фотки = ";
if ($rewrite) {
    echo "Да";
} else {
    echo "Нет";
}
echo "<br /><hr>";


if (is_dir(RD . "/../uploads/images/lider/import")) {
    if ($dh = opendir(RD . "/../uploads/images/lider/import")) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." and $file != "..") {
                $m += 1;
                print "Файл " . $file;
                $code = pathinfo($file);
                $code = $code['filename'];
                print "<b>  code=$code </b>";
//				if ($rewrite=="1") { $r=$odb->query_td("select id from item where code='$code' and prod_id='$prod_id' limit 0,1;");} 
//					else {$r=$odb->query_td("select i.id from item i left outer join itemimages im on i.id=im.item_id where code='$code' and prod_id='$prod_id' and im.id is null limit 0,1;");}
                $r = $odb->query_td("select id from item where code='$code' and prod_id='$prod_id' limit 1;");
                $is = 0;
                while (odbc_fetch_row($r)) {
                    $id = odbc_result($r, "id");
                    print " id=$id ";
                    $fex = 0;
                    $is = 1;
                    $image_name = $code . "_i_pid_" . $prod_id . ".jpg";
                    $r1 = $odb->query_td("select max(id) as m_id from itemimages where item_id='$id' and istd=0;");
                    while (odbc_fetch_row($r1)) {
                        $max_id = odbc_result($r1, m_id);
                        if ($max_id) {
                            print " - Фото уже есть! id= $max_id";
                            $fex = 1;
                            if (($rewrite == "1") & ($max_id)) {
                                $odb->query_td("update itemimages set file_name='$image_name' where item_id=$id and id=$max_id");
                                print " - Обновляю последнее! ";
                                rename(RD . "/../uploads/images/lider/import/$file", RD . "/../uploads/images/lider/$image_name");
                                print "<br />Файл загружен from-> " . "../uploads/images/lider/import/$file" . " to->" . "../uploads/images/lider/$image_name<br />";

                            } else print " не обновляю! удалите файл или выберите опцию обновить";
                            print "<br>";
                        }
                    }

                    if ($fex == 0) {
                        $odb->query_td("insert into itemimages (id,item_id,file_name,istd) values( (select max(id)+1 from itemimages),$id,'$image_name',0);");
                        rename(RD . "/../uploads/images/lider/import/$file", RD . "/../uploads/images/lider/$image_name");
                        print "<br />Файл загружен from-> " . "../uploads/images/lider/import/$file" . " to->" . "../uploads/images/lider/$image_name<br />";

                    }
                }
                if ((!$id) or ($is == 0)) {
                    print " - Нет в прайсе для произв-ля <b>$prod_id</b><br />";
                }

            }
        }
        closedir($dh);
    }
}
?>