<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 13.06.2016
 * Time: 7:58
 */


echo "<H1>����� ���� ���������, ��������, ��������������.</H1>";
echo "<p>";
<
script type = "text/javascript" >
  function test()
  {
      if (confirm("��� �������� ���� ������� 'OK'?")) {
          window . close()}
  }
</script >

<p align = justify > ��������� ������ alert, confirm, prompt ����� �������� ��������� ������������ .
���������, ��������� alert, ������������ ��� ������ �������������� ������������ .
����� confirm ������������ ��� ���������, ��������� �������� ������� ������������� .
��� ������������� prompt ���� ��������� �������� ���� ��������� � ���� ����� ������,
 ������� ��� ������� ������ "OK" ����� ������������ ������� ��� ��������������
 ��� ������ ������� ������� .
<center ><form >
<input name = kuku type = submit value = "Alert" onClick = "alert('��� ���������!')" >
<input name = tutu type = submit value = "Confirm" onClick = "test()" >
<input name = nunu type = submit value = "Prompt" onClick = "prompt('������� ���� ���','')" >
</form ></center >
<p align = justify > ��� ����� ������������ ����������� ������� onClick � ������
 alert, prompt, � ��� confirm ������������ ������� test .