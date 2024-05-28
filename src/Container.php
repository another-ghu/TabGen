<?php declare(strict_types=1);
namespace another\TabGen;
/**
 * <h3>Класс Container</h3>
 *
 * Используется для построения таблицы, забирает стандартные или переопределенные
 * настройки строк из классов RowSettings, CellSettings, ColSettings
 *
 * Этот класс позволяет получать и переопределять следующие свойства строки:
 *
 * - Название HTML-тега, которым будет обернута строка
 * - Строка классов CSS, применяемая к HTML-элементу строки
 * - Строка стилей CSS, применяемая к HTML-элементу строки
 *
 * Переопределить стандартные объекты классов с настройками добавляемые конструктором класса
 * - Объект класса RowSettings
 * - Объект класса CellSettings
 * - Объект класса ColSettings
 *
 *
 * При создании объекта класса, конструктор установит следующие стандартные значения
 * HTML тега и атрибутов
 *
 * HTML-тег: div
 * HTML-атрибут class: container
 * HTML-атрибут style: ""
 *
 * Создаст объекты классов с настройками.
 * Создает объект класса RowSettings.
 * Создает объект класса CellSettings.
 * Создает объект класса ColSettings.
 *
 * @author Starostin Anton <another.mfj@yandex.ru>
 */
class Container{
    /**
     * @var string Хранит значение HTML-тега
     *
     * @see RowSettings::setTagName() метод установки значения
     * @see RowSettings::getTagName() метод получения значения
     */
    private string $tagName;
    /**
     * @var string Хранит значение HTML-аттрибута `class`
     *
     * @see RowSettings::setClassRow() метод установки значения.
     * @see RowSettings::getClassRow() метод получения значения.
     */
    private string $classRow;
    /**
     * @var string Хранит значение HTML-аттрибута `style`
     *
     * @see RowSettings::setStyleRow() метод установки значения.
     * @see RowSettings::getStyleRow() метод получения значения.
     */
    private string $styleRow;
    /**
     * @var object|RowSettings Хранит объект класса RowSettings
     * @see RowSettings
     */
    private object $RowSettingsObject;
    /**
     * @var object|CellSettings Хранит объект класса CellSettings
     * @see CellSettings
     */
    private object $CellSettingsObject;
    /**
     * @var object|ColSettings Хранит объект класса ColSettings
     * @see ColSettings
     */
    private object $ColSettingsObject;
    /**
     * @var array Хранит массивы поступающих данных
     * @see add_data()
     */
    private array $dataArray;
    /**
     * <h3>Конструктор класса</h3>
     *
     * Конструктор позволяет переопределить стандартные значения для основных свойств объекта,
     * определяющих поведение и внешний вид HTML-элемента при генерации HTML-кода
     *
     * - Название HTML-тега
     * - Строка классов CSS
     * - Строка стилей CSS
     * - Объект класса RowSettings
     * - Объект класса CellSettings
     * - Объект класса ColSettings
     *
     * Все параметры имеют значения по умолчанию, которые можно переопределить
     * при создании экземпляра класса. Если параметры не указаны, то будут использованы
     * стандартные значения, заданные в конструкторе
     *
     * <code>
     *     $row = new RowSettings();
     *     $cell = new CellSettings();
     *     $col = new ColSettings;
     *     $myContainer = new Container("div", "my-container", "display: grid; background-color: red;", $row, $cell, $coll);
     * </code>
     * @param string $tagName
     * @param string $classRow
     * @param string $styleRow
     * @param object $RowSettingsObject
     * @param object $CellSettingsObject
     * @param object $ColSettingsObject
     */
    public function __construct(string $tagName = "div",
                                string $classRow = "container",
                                string $styleRow = "",
                                object $RowSettingsObject = new RowSettings(),
                                object $CellSettingsObject = new CellSettings(),
                                object $ColSettingsObject = new ColSettings())
    {
        $this->tagName = $tagName;
        $this->classRow = $classRow;
        $this->styleRow = $styleRow;
        $this->RowSettingsObject = $RowSettingsObject;
        $this->CellSettingsObject = $CellSettingsObject;
        $this->ColSettingsObject = $ColSettingsObject;
        $this->dataArray = [];
    }

    /**
     * <h3>Метод setTagName()</h3>
     *
     * Переопределяет стандартное значение. Позволяет установить HTML-тег который будет использован
     * при генерации HTML-кода.
     *
     * <code>
     *     $myContainer->setTagName("div");
     * </code>
     * @param string $tagName Строка, содержащая название HTML-тега (например "div", "span", "p")
     * @return void
     */
    public function setTagName(string $tagName) : void
    {
        $this->tagName = $tagName;
    }

    /**
     * <h3>Метод setClassRow()</h3>
     *
     * Переопределяет стандартное значение. Позволяет установить HTML-аттрибут `class` строки
     * который будет использован при генерации HTML-кода
     *
     * <code>
     *     $myRow->setClassRow("row-item header");
     * </code>
     * @param string $classRow Строка, содержащая один или несколько CSS-классов
     * @return void
     */
    public function setClassRow(string $classRow) : void
    {
        $this->classRow = $classRow;
    }

    /**
     * <h3>setStyleRow()</h3>
     *
     * Переопределяет стандартное значение. Позволяет установить HTML-аттрибут `style` строки
     * который будет использован при генерации HTML-кода
     *
     * Пример использования:
     * <code>
     *     $myRow->setStyleRow("display:flex; background-color:red;");
     * </code>
     * @param string $styleRow Строка, содержащая один или несколько CSS-стилей
     * @return void
     */
    public function setStyleRow(string $styleRow) : void
    {
        $this->styleRow = $styleRow;
    }

    /**
     * <h3>Метод addData()</h3>
     *
     * Принимает массив с данными которые используются для вставки в таблицу.
     * Размер массива определяется количеством колонок таблицы
     *
     * Пример использования:
     * <code>
     *     $myContainer->addData([1,2,3,4,5,6,7,8, ....]);
     * @param array $dataArray Массив данными.
     * @return void
     */
    public function addData(array $dataArray) : void
    {
        $this->dataArray[] = $dataArray;
    }

    /**
     * <h3>Метод setSettingsObject()</h3>
     *
     * Перезаписывает стандартные объекты настроек. Проверяет что объект является классом настроек
     *
     * Пример использования:
     * <code>
     *     $myRow = new RowSettings;
     *     $myContainer->setSettingsObject($myRow);
     * </code>
     * @param object $ClassSettings
     * @return void
     */
    public function setSettingsObject(object $ClassSettings) : void
    {
        if ($ClassSettings instanceof RowSettings){
            $this->RowSettingsObject = $ClassSettings;
        }
        if ($ClassSettings instanceof CellSettings){
            $this->CellSettingsObject = $ClassSettings;
        }
        if ($ClassSettings instanceof ColSettings){
            $this->ColSettingsObject = $ClassSettings;
        }
    }

    /**
     * <h3>Метод getHTML()</h3>
     *
     * Метод генерирует HTML разметку собирая стандартные или переопределенные настройки классов Container,
     * RowSettings, CelSettings, ColSettings
     *
     * Пример использования:
     * <code>
     *     $myContainer->getHTML();
     *     echo $myContainer;
     * </code>
     * @return string Возвращает HTML разметку в зависимости от настройки класса и классов настроек.
     */
    public function getHTML () : string
    {
        $html = "<" . $this->tagName;
        if (strlen($this->classRow) > 0){
            $html .= " class=" . "\"$this->classRow\"";
        }
        if (strlen($this->styleRow) > 0){
            $html .= " style=" . "\"$this->styleRow\"";
        }
        $html .= ">";

        $row_iteration = 0;
        $cell_iteration = 0;
        foreach ($this->dataArray as $rows){
            $html .= "<" . $this->RowSettingsObject->getTagName();
            if (strlen($this->RowSettingsObject->getClassRow()) > 0){
                $html .= " class=" . "\"{$this->RowSettingsObject->getClassRow()}\"";
            }
            if (strlen($this->RowSettingsObject->getStyleRow()) > 0){
                $html .= " style=" . "\"{$this->RowSettingsObject->getStyleRow()}\"";
            }
            if ($this->RowSettingsObject->getCounterStatus()){
                $html .= " {$this->RowSettingsObject->getCounterName()}=\"$row_iteration\"";
            }
            $html .= ">";

            $col_iteration = 0;
            foreach ($rows as $cell_data){
                $html .= "<" . $this->CellSettingsObject->getTagName();
                if (strlen($this->CellSettingsObject->getClassRow()) > 0){
                    $html .= " class=" . "\"{$this->CellSettingsObject->getClassRow()}\"";
                }
                if (strlen($this->CellSettingsObject->getStyleRow()) > 0){
                    $html .= " style=" . "\"{$this->CellSettingsObject->getStyleRow()}\"";
                }
                if ($this->CellSettingsObject->getCounterStatus()){
                    $html .= " {$this->CellSettingsObject->getCounterName()}=\"$cell_iteration\"";
                }
                if ($this->ColSettingsObject->getCounterStatus()){
                    $html .= " {$this->ColSettingsObject->getCounterName()}=\"$col_iteration\"";
                }
                $html .= ">";
                $html .= $cell_data;
                $html .= "</{$this->CellSettingsObject->getTagName()}>";
                $cell_iteration ++;
                $col_iteration ++;
            }
            $html .= "</{$this->RowSettingsObject->getTagName()}>";
            $row_iteration++;
        }
        $html .= "</$this->tagName>";

        return $html;
    }
}