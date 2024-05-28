<?php declare(strict_types=1);
namespace another\TabGen;
/**
 * <h3>Класс ColSetting</h3>
 *
 * Используется как настройка к классу `Container`
 * Необходим для выставления параметров HTML-элементов.
 * Этот класс позволяет получать и переопределять следующие свойства строки:
 *
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
class ColSettings
{
    /**
     * @var bool Флаг счетчика строк
     *
     * @see ColSettings::setCounterStatus() метод управления флагом
     */
    private bool $counterStatus;
    /**
     * @var string Хранит имя счетчика строки
     *
     * @see ColSettings::setCounterName() метод установки значения
     * @see ColSettings::getCounterName() метод получения значения.
     */
    private string $counterName;
    /**
     * <h3>Конструктор класса</h3>
     *
     * Конструктор позволяет переопределить стандартные значения для основных свойств объекта,
     * определяющих поведение и внешний вид HTML-элемента при генерации HTML-кода
     *
     * - Флаг, определяющий, будет ли использован счетчик
     *
     * Все параметры имеют значения по умолчанию, которые можно переопределить
     * при создании экземпляра класса. Если параметры не указаны, то будут использованы
     * стандартные значения, заданные в конструкторе
     *
     * <code>
     *     $myCol = new ColSettings(true)
     * </code>
     * @param bool $enableColCounter Флаг, определяющий, будет ли использоваться счетчик строк (по умолчанию false)
     */
    public function __construct(bool $enableColCounter = false)
    {
        $this->counterStatus = $enableColCounter;
        $this->counterName = "col";
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
     *     $myCol->setCounterStatus(true)
     * </code>
     * @param bool $counterStatus true - счетчик включен, false - счетчик выключен
     * @return void
     */
    public function setCounterStatus(bool $counterStatus) : void
    {
        $this->counterStatus = $counterStatus;
    }

    /**
     * <h3>setCounterName()</h3>
     *
     * Переопределяет стандартное значение. Позволяет установить имя HTML-аттрибута счетчика
     * который будет добавлен в случае если флаг статуса счетчика стоит в `true`
     *
     * Пример использования:
     * <code>
     *     $myCol->setCounterName("myCounter");
     * </code>
     *
     * @param string $counterName Строка, содержащая имя названия счетчика
     * @see ColSettings::setCounterStatus() Метод, изменяющий флаг счетчика
     * @return void
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
}