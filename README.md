# TabGen

<h1>Класс построения HTML таблиц</h1>

<h2>Доступные методы:</h2>

`->setTag()` - Устанавливает HTML тег <br>
`->setClass()` - Устанавливает HTML класс. Цепочка вызовов <br>
`->setStyle()` - Устанавливает HTML стиль. Цепочка вызовов <br>
`->setAttribute()` - Устанавливает HTML атрибут. Цепочка вызовов <br>
`->addDataString()` - Принимает строки. Цепочка вызовов. Собирает массив для вывода. <br>
`->addDataArray()` - Принимает одномерный или двумерный массив <br>
`->dataStringBuild()` - Используется для закрытия массива который строится через addDataString() <br>
`->render()` - Форматирует и выводит структурированную html строку <br>
`->wrapper()` - Используется для обертки класса Header Body Footer. Возвращает структурированный html <br>

<h1>Установка конструктора</h1>
!Все аргументы передаваемые в конструктор опциональны. <br>

Доступные аргументы для установки: <br>
    `string tag` <br>
    `string class` <br>
    `string style` <br>
    `string attribute` <br>

Пример:
```php
$container = new Header(tag:"div", class:"header",style:"display:flex",attribute:"MyAttr=value");
````
Будет формировать строки хидера с указанными аргументами аргументы.
```html
<div class="header" style="display: flex" MyAttr="value"></div>
```

<h1>Создание шапки</h1>
   
Пример установки хидера массивом: <br>
```php
$container = new Container(tag:"div", class:"container",style:"",attribute:"");
$header = new Header(tag:"div", class:"header",style:"",attribute:"");
$header->addDataArray(["header1","header2","header3"]);
$container->wrapper($header)
```

Пример установки хидера цепочкой вызовов: <br>
```php
$container = new Container(tag:"div", class:"container",style:"",attribute:"");
$header = new Header(tag:"div", class:"header",style:"",attribute:"");
$header->addDataString("header1")
        ->addDataString("header2")
        ->addDataString("header3")
$container->wrapper($header)
```

Пример установки двух хидеров массивом: <br>
```php
$container = new Container(tag:"div", class:"container",style:"",attribute:"");
$header = new Header(tag:"div", class:"header",style:"",attribute:"");
$header->addDataArray(["header1","header2","header3"]);
$header->addDataArray(["header2","header3","header4"]);
$container->wrapper($header)
```

Пример установки двух хидеров цепочкой вызовов: <br>
```php
$container = new Container(tag:"div", class:"container",style:"",attribute:"");
$header = new Header(tag:"div", class:"header",style:"",attribute:"");
$header->addDataString("header1")
        ->addDataString("header2")
        ->addDataString("header3")
        ->dataStringBuild()
        ->addDataString("header4")
        ->addDataString("header5")
        ->addDataString("header6");
$container->wrapper($header)
```

