TecDoc v1.1 (Каталог Автозапчастей)
Реализовано по документации TecDoc Informations System GmbH.
----------------------------------------------------------------
Системные требования:
	- Веб сервер Apache 2.x.x
	- PHP 5.3 >
	- SOAP Apache Library
	- Mod Rewrite
----------------------------------------------------------------
Приложение в виде каталога авто запчастей, с выходом на поиск по сайту (артикул, наименование продукции).
Каталог интегрирован в Битрикс самым простым способом - путем подключения прологов и наследования глобального объекта $APPLICATION в классах.
Объект используется только для установки метатегов на страницу. В целом, каталог легко интегрировать под любую CMS.
----------------------------------------------------------------
- В приложении можно увидеть как реализуется базовое кэширование SOAP и кэширование страниц: : class Cache();
- Увидеть в целом пример работы с WEB сервисами.
- Посмотреть как реализуется ЧПУ на простом примере PHP класса: class Router();
- Правильную обработку языковых пакетов: class Language();
- Посмотреть как использовать свой шаблонизатор для включения шаблонов нативным способом: class Template();
И много другое :))

К приложению приложена PDF документации по API Веб Сервиса а также моя документация по реализованному функционалу.









