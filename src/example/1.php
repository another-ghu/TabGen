<?php
require_once "../../vendor/autoload.php";
echo <<<HTML_START
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
.table {
    display: table;
    width: 100%;

    color: #666;
    background-color: #fff;
    padding: 15px;
    box-sizing: border-box;
    transition: box-shadow 0.1s ease-in-out;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}
.header {
    display: table-row;
    background-color: #232b66;
    color: #fff;
}

.body {
    display: table-row;
    &:nth-child(even) {
        background: #f8f8f8;
    }
    &:nth-child(1) .col {
        text-align: left;
        text-transform: uppercase;
    }
    &:nth-child(n+2) .col {
        border-bottom: 1px solid #e5e5e5;
        text-align: left;
    }
}
.footer
{
    display: table-row;
    background: #c5c5c5;

}
.col {
    display: table-cell;
    padding: 16px 12px;
    border-collapse: collapse;
    border-spacing: 0;
    vertical-align: middle;
    font-size: 0.875rem;
    font-weight: normal;
}    
    </style>
</head>
<body>
HTML_START;

//data for table
$totalCols = 10;
$totalRows = 1000;
$data = [];
$colTotal = [];
for ($rowIndex = 0; $rowIndex < $totalRows; $rowIndex++) {
    for ($colIndex = 0; $colIndex < $totalCols; $colIndex++) {
        $rand = rand(1,100);
        $data[$rowIndex][] = $rand;
        $colTotal[$colIndex] += $rand;

    }
}

use another\TabGen\Class\Container;
use another\TabGen\Class\Header;
use another\TabGen\Class\Body;
use another\TabGen\Class\Footer;

$container = new Container("div","container","","");
echo "<div class='table'>";
$header = new Header("div","header","","");
$header->addDataString('col1')
        ->addDataString('col2')
        ->addDataString('col3')
        ->addDataString('col4')
        ->addDataString('col5')
        ->addDataString('col6')
        ->addDataString('col7')
        ->addDataString('col8')
        ->addDataString('col9')
        ->addDataString('col10');

$body = new Body("div","body","","");
$body->addDataArray($data);

$footer = new Footer("div","footer","","");
$footer->addDataArray([$colTotal]);
//$container->render();

echo <<<HTML_END
</body>
</html>
HTML_END;