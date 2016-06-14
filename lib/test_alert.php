<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 13.06.2016
 * Time: 7:58
 */


echo "<H1>Вывод окон сообщений, запросов, предупреждений.</H1>";
echo "<p>";
<
script type = "text/javascript" >
  function test()
  {
      if (confirm("Для закрытия окна нажмите 'OK'?")) {
          window . close()}
  }
</script >

<p align = justify > Используя методы alert, confirm, prompt можно выводить сообщения пользователю .
Сообщение, выводимое alert, используется для вывода предупреждений пользователю .
Метод confirm используется для сообщений, требующих принятия решения пользователем .
При использовании prompt окно сообщений содержит само сообщение и поле ввода текста,
 который при нажатии кнопки "OK" может передаваться серверу или использоваться
 при вызове другого скрипта .
<center ><form >
<input name = kuku type = submit value = "Alert" onClick = "alert('Это сообщение!')" >
<input name = tutu type = submit value = "Confirm" onClick = "test()" >
<input name = nunu type = submit value = "Prompt" onClick = "prompt('Укажите ваше имя','')" >
</form ></center >
<p align = justify > Для этого используются обработчики событий onClick и методы
 alert, prompt, а для confirm используется функция test .