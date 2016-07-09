<?php
$_1_2[1] = "���� ";
$_1_2[2] = "�� ";

$_1_19[1] = "���� ";
$_1_19[2] = "��� ";
$_1_19[3] = "��� ";
$_1_19[4] = "������ ";
$_1_19[5] = "�'��� ";
$_1_19[6] = "����� ";
$_1_19[7] = "�� ";
$_1_19[8] = "��� ";
$_1_19[9] = "���'��� ";
$_1_19[10] = "������ ";
$_1_19[11] = "���������� ";
$_1_19[12] = "���������� ";
$_1_19[13] = "���������� ";
$_1_19[14] = "������������ ";
$_1_19[15] = "�'��������� ";
$_1_19[16] = "����������� ";
$_1_19[17] = "��������� ";
$_1_19[18] = "���������� ";
$_1_19[19] = "���'��������� ";

$des[2] = "�������� ";
$des[3] = "�������� ";
$des[4] = "����� ";
$des[5] = "�'������� ";
$des[6] = "��������� ";
$des[7] = "������� ";
$des[8] = "�������� ";
$des[9] = "���'������ ";

$hang[1] = "��� ";
$hang[2] = "���� ";
$hang[3] = "������ ";
$hang[4] = "��������� ";
$hang[5] = "�'����� ";
$hang[6] = "������� ";
$hang[7] = "����� ";
$hang[8] = "������ ";
$hang[9] = "���'����� ";

$namerub[1] = "������ ";
$namerub[2] = "������ ";
$namerub[3] = "������� ";

$nametho[1] = "������ ";
$nametho[2] = "������ ";
$nametho[3] = "����� ";

$namemil[1] = "���� ";
$namemil[2] = "����� ";
$namemil[3] = "������ ";

$namemrd[1] = "����� ";
$namemrd[2] = "������ ";
$namemrd[3] = "������ ";

$kopeek[1] = "������ ";
$kopeek[2] = "������ ";
$kopeek[3] = "������ ";

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
            $s .= "������� ";
        }
    }

    if ($L >= 1000000) {
        $many = 0;
        semantic(intval($L / 1000000), $s1, $many, 2);
        $s .= $s1 . $namemil[$many];
        $L %= 1000000;
        if ($L == 0) {
            $s .= "������� ";
        }
    }
    if ($L >= 1000) {
        $many = 0;
        semantic(intval($L / 1000), $s1, $many, 1);
        $s .= $s1 . $nametho[$many];
        $L %= 1000;
        if ($L == 0) {
            $s .= "������� ";
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
        $s .= " 00 ������";
    }
    $s = strtoupper(substr($s, 1, 1)) . substr($s, 2);
    return $s;
}

?>