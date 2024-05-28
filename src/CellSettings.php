<?php declare(strict_types=1);
namespace another\TabGen;
/**
 * <h3>Класс CellSetting</h3>
 *
 * Используется как настройка к классу `Container`
 * Необходим для выставления параметров HTML-элементов.
 * Этот класс позволяет получать и переопределять следующие свойства строки:
 *
 * - Название HTML-тега, которым будет обернута строка
 * - Строка классов CSS, применяемая к HTML-элементу строки
 * - Строка стилей CSS, применяемая к HTML-элементу строки
 * - Флаг, определяющий, будет ли использован атрибут счетчика строк в HTML-элементе строки
 * - Имя атрибута счетчика в HTML-элементе строки
 *
 * При создании объекта класса, конструктор установит следующие стандартные значения
 * HTML тега и атрибутов
 *
 * HTML-тег: div
 * HTML-атрибут class: row
 * HTML-атрибут style: ""
 * Флаг счетчика: false
 * Имя счетчика: row
 *
 * @author Starostin Anton <another.mfj@yandex.ru>
 */
class CellSettings
{
    /**
     * @var string Хранит значение HTML-тега
     *
     * @see CellSettings::setTagName() метод установки значения
     * @see CellSettings::getTagName() метод получения значения
     */
    private string $tagName;
    /**
     * @var string Хранит значение HTML-аттрибута `class`
     *
     * @see CellSettings::setClassRow() метод установки значения.
     * @see CellSettings::getClassRow() метод получения значения.
     */
    private string $classRow;
    /**
     * @var string Хранит значение HTML-аттрибута `style`
     *
     * @see CellSettings::setStyleRow() метод установки значения.
     * @see CellSettings::getStyleRow() метод получения значения.
     */
    private string $styleRow;
    /**
     * @var bool Флаг счетчика строк
     *
     * @see CellSettings::setCounterStatus() метод управления флагом
     */
    private bool $counterStatus;
    /**
     * @var string Хранит имя счетчика строки
     *
     * @see CellSettings::setCounterName() метод установки значения
     * @see CellSettings::getCounterName() метод получения значения.
     */
    private string $counterName;
    /**
     * <h3>Конструктор класса</h3>
     *
     * Конструктор позволяет переопределить стандартные значения для основных свойств объекта,
     * определяющих поведение и внешний вид HTML-элемента при генерации HTML-кода
     *
     * - Название HTML-тега
     * - Строка классов CSS
     * - Строка стилей CSS
     * - Флаг, определяющий, будет ли использован счетчик
     *
     * Все параметры имеют значения по умолчанию, которые можно переопределить
     * при создании экземпляра класса. Если параметры не указаны, то будут использованы
     * стандартные значения, заданные в конструкторе
     *
     * <code>
     *     $myCell = new CellSettings("div", "my-row highlight", "display: flex; background-color: red;", true)
     * </code>
     * @param string $tagName Название HTML-тега, который будет использован при генерации HTML (по умолчанию "div")
     * @param string $classRow Строка классов CSS, которая будет использована при генерации HTML (по умолчанию "row")
     * @param string $styleRow Строка стилей CSS, которая будет использована при генерации HTML (по умолчанию пустая строка)
     * @param bool $enableCellCounter Флаг, определяющий, будет ли использоваться счетчик строк (по умолчанию false)
     */
    public function __construct(string $tagName = "div",
                                string $classRow = "cell",
                                string $styleRow = "",
                                bool   $enableCellCounter = false)
    {
        $this->tagName = $tagName;
        $this->classRow = $classRow;
        $this->styleRow = $styleRow;
        $this->counterStatus = $enableCellCounter;
        $this->counterName = "cell";
    }

    /**
     * <h3>Метод setCounterStatus()</h3>
     *
     * Переопределяет стандартное значение. Включает или выключает добавление счетчика при генерации HTML.
     * Если счетчик включен (значение `true`), то при генерации HTML-кода будет добавлен специальный HTML-атрибут
     * содержащий порядковый номер строки.
     * Если счетчик выключен (значение `false`), то такой атрибут добавляться не будет.
     *
     * <code>
     *     $myCell->setCounterStatus(true)
     * </code>
     * @param bool $counterStatus true - счетчик включен, false - счетчик выключен
     * @return void
     */
    public function setCounterStatus(bool $counterStatus) : void
    {
        $this->counterStatus = $counterStatus;
    }

    /**
     * <h3>Метод setTagName()</h3>
     *
     * Переопределяет стандартное значение. Позволяет установить HTML-тег который будет использован
     * при генерации HTML-кода.
     *
     * <code>
     *     $myCell->setTagName("div");
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
     *     $myCell->setClassRow("cell-item header");
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
     *     $myCell->setStyleRow("display:flex; background-color:red;");
     * </code>
     * @param string $styleRow Строка, содержащая один или несколько CSS-стилей
     * @return void
     */
    public function setStyleRow(string $styleRow) : void
    {
        $this->styleRow = $styleRow;
    }

    /**
     * <h3>setCounterName()</h3>
     *
     * Переопределяет стандартное значение. Позволяет установить имя HTML-аттрибута счетчика
     * который будет добавлен в случае если флаг статуса счетчика стоит в `true`
     *
     * Пример использования:
     * <code>
     *     $myCell->setCounterName("myCounter");
     * </code>
     *
     * @param string $counterName Строка, содержащая имя названия счетчика
     * @return void
     * @see CellSettings::setCounterStatus() Метод, изменяющий флаг счетчика
     */
    public function setCounterName(string $counterName) : void
    {
        $this->counterName = $counterName;
    }

    /**
     * <h3>getCounterName()</h3>
     *
     * Возвращает стандартное или переопределенное имя HTML-атрибута счетчика
     *
     * @return string Имя счетчика
     */
    public function getCounterName() : string
    {
        return $this->counterName;
    }

    /**
     * <h3>getCounterStatus()</h3>
     *
     * Возвращает флаг счетчика
     *
     * @return bool true (активен) false (не активен)
     */
    public function getCounterStatus() : bool
    {
        return $this->counterStatus;
    }

    /**
     * <h3>getTagName()</h3>
     *
     * Возвращает стандартный или переопределенный HTML-тег контейнера строки.
     *
     * @return string
     */
    public function getTagName() : string
    {
        return $this->tagName;
    }

    /**
     * <h3>getClassRow()</h3>
     *
     * Возвращает стандартную или переопределенную строку с CSS классами
     *
     * @return string
     */
    public function getClassRow() : string
    {
        return $this->classRow;
    }

    /**
     * <h3>getStyleRow()</h3>
     *
     * Возвращает стандартную или переопределенную строку с CSS стилями
     *
     * @return string
     */
    public function getStyleRow() : string
    {
        return $this->styleRow;
    }
}