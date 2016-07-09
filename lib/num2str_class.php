<?php
$_1_2[1] = "одна ";
$_1_2[2] = "дв≥ ";

$_1_19[1] = "один ";
$_1_19[2] = "два ";
$_1_19[3] = "три ";
$_1_19[4] = "чотири ";
$_1_19[5] = "п'€ть ";
$_1_19[6] = "ш≥сть ";
$_1_19[7] = "с≥м ";
$_1_19[8] = "в≥с≥м ";
$_1_19[9] = "дев'€ть ";
$_1_19[10] = "дес€ть ";
$_1_19[11] = "одинадц€ть ";
$_1_19[12] = "дванадц€ть ";
$_1_19[13] = "тринадц€ть ";
$_1_19[14] = "чотирнадц€ть ";
$_1_19[15] = "п'€тнадц€ть ";
$_1_19[16] = "ш≥стнадц€ть ";
$_1_19[17] = "с≥мнадц€ть ";
$_1_19[18] = "в≥с≥мнадц€ть ";
$_1_19[19] = "дев'€тнадц€ть ";

$des[2] = "двадц€ть ";
$des[3] = "тридц€ть ";
$des[4] = "сорок ";
$des[5] = "п'€тдес€т ";
$des[6] = "ш≥стдес€т ";
$des[7] = "с≥мдес€т ";
$des[8] = "в≥с≥мдес€т ";
$des[9] = "дев'€носто ";

$hang[1] = "сто ";
$hang[2] = "дв≥ст≥ ";
$hang[3] = "триста ";
$hang[4] = "чотириста ";
$hang[5] = "п'€тсот ";
$hang[6] = "ш≥стсот ";
$hang[7] = "с≥мсот ";
$hang[8] = "в≥с≥мсот ";
$hang[9] = "дев'€тсот ";

$namerub[1] = "гривн€ ";
$namerub[2] = "гривн≥ ";
$namerub[3] = "гривень ";

$nametho[1] = "тис€ча ";
$nametho[2] = "тис€ч≥ ";
$nametho[3] = "тис€ч ";

$namemil[1] = "м≥л≥он ";
$namemil[2] = "м≥л≥она ";
$namemil[3] = "м≥л≥он≥в ";

$namemrd[1] = "м≥л≥ард ";
$namemrd[2] = "м≥л≥арда ";
$namemrd[3] = "м≥л≥ард≥в ";

$kopeek[1] = "коп≥йка ";
$kopeek[2] = "коп≥йки ";
$kopeek[3] = "коп≥йок ";

function semantic($i, &$words, &$many, $f)
{
    global $_1_2, $_1_19, $des, $hang, $namerub, $nametho, $namemil, $namemrd;
    $words = "";
    $fl = 0;
    if ($i >= 100) {
        $jkl = intval($i / 100);
        $words .= $hang[$jkl];
        $i %= 100;
    }
    if ($i >= 20) {
        $jkl = intval($i / 10);
        $words .= $des[$jkl];
        $i %= 10;
        $fl = 1;
    }
    switch ($i) {
        case 1:
            $many = 1;
            break;
        case 2:
        case 3:
        case 4:
            $many = 2;
            break;
        default:
            $many = 3;
            break;
    }
    if ($i) {
        if ($i < 3 && $f == 1)
            $words .= $_1_2[$i];
        else
            $words .= $_1_19[$i];
    }
}

function num2str($L)
{
    global $_1_2, $_1_19, $des, $hang, $namerub, $nametho, $namemil, $namemrd, $kopeek;
    $s = " ";
    $s1 = " ";
    $kop = intval(($L * 100 - intval($L) * 100));
    $L = intval($L);
    if ($L >= 1000000000) {
        $many = 0;
        semantic(intval($L / 1000000000), $s1, $many, 3);
        $s .= $s1 . $namemrd[$many];
        $L %= 1000000000;
        if ($L == 0) {
            $s .= "гривень ";
        }
    }

    if ($L >= 1000000) {
        $many = 0;
        semantic(intval($L / 1000000), $s1, $many, 2);
        $s .= $s1 . $namemil[$many];
        $L %= 1000000;
        if ($L == 0) {
            $s .= "гривень ";
        }
    }
    if ($L >= 1000) {
        $many = 0;
        semantic(intval($L / 1000), $s1, $many, 1);
        $s .= $s1 . $nametho[$many];
        $L %= 1000;
        if ($L == 0) {
            $s .= "гривень ";
        }
    }
    if ($L != 0) {
        $many = 0;
        semantic($L, $s1, $many, 0);
        $s .= $s1 . $namerub[$many];
    }
    if ($kop > 0) {
        $many = 0;
        semantic($kop, $s1, $many, 1);
        $s .= $s1 . $kopeek[$many];
    } else {
        $s .= " 00 коп≥йок";
    }
    $s = strtoupper(substr($s, 1, 1)) . substr($s, 2);
    return $s;
}

?>