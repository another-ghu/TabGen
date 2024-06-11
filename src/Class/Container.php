<?php declare(strict_types=1);
namespace another\TabGen\Class;
use another\TabGen\Trait\ColAttributes;
use Exception;

/**
 * Используется для построения таблиц.
 * @author Starostin Anton <another.mfj@yandex.ru>
 */
class Container{
    use ColAttributes;

    /* @var string Хранит значение HTML-тега */
    protected string $tag;
    /* @var string Хранит значение HTML-аттрибута `class` */
    protected string $class;
    /* @var string Хранит значение HTML-аттрибута `style` */
    protected string $style;
    /* @var string Хранит значение произвольного HTML-аттрибута */
    protected string $attribute;
    /* @var array Хранит массив с обрабатываемыми данными */
    protected array $data;
    /* @var int Вспомогательная переменная для индекса размера массива */
    private int $arrayIndex = 0;

    /**
     * <h3>Конструктор класса</h3>
     * <code>
     *     $myContainer = new Container("div", "my-container", "display: grid; background-color: red;", "CustomAttribute=value");
     * </code>
     * @param string $tag
     * @param string $class
     * @param string $style
     * @param string $attribute
     */

    public function __construct(string $tag = "",
                                string $class = "",
                                string $style = "",
                                string $attribute = "",
                                )
    {

        $this->tag = trim($tag, " ");
        $this->class = (strlen($class) > 0) ? trim($class, " ") : "";
        $this->style = (strlen($style) > 0) ? trim($style, " ") . ";" : "";
        $this->attribute = $attribute;
    }

    /**
     * Устанавливает HTML-tag
     *  <code>
     *      $myContainer->setTag("div");
     *  </code>
     * @param string $tag
     * @return void
     */
    public function setTag(string $tag) : void
    {
        $this->tag = trim($tag, " ");
    }

    /**
     * Устанавливает HTML класс
     * <code>
     *     $myContainer->setClass("class1 class2")
     *                  ->setClass("class3");
     * </code>
     * @param string $class
     * @return $this
     */
    public function setClass(string $class) : self
    {
        $class = trim($class, " ");
        $this->class .= " $class";
        $this->class = ltrim($this->class, " ");

        return $this;
    }

    /**
     * Устанавливает HTML стили
     * <code>
     *     $myContainer->setStyle("display:flex; background-color:red;")
     *                  ->setStyle("color:black;");
     * </code>
     * @param string $style Строка, содержащая один или несколько CSS-стилей
     * @return $this
     */
    public function setStyle(string $style) : self
    {
        $style = trim($style, " ");
        $this->style .= " $style;";
        $this->style = ltrim($this->style, " ");

        return $this;

    }

    /**
     * Устанавливает произвольный HTML аттрибут
     * <code>
     *     $myContainer->setAttribute("attribute=value")
     *                  ->setAttribute("attribute2:value");
     * </code>
     * @param string $name
     * @param $value
     * @return $this
     */
    public function setAttribute(string $name, $value):self
    {
        $name = trim($name, " ");
        $value = trim($value, " ");
        $this->attribute .= " $name='$value'";
        $this->attribute = ltrim($this->attribute, " ");

        return $this;
    }

    /**
     * Каждый вызов метода `addDataString()` добавляет строку в массив `$data`.
     * После вызова метода `dataStringBuild()` можно начать новую цепочку добавления строк,
     * которые будут записаны в следующий и индекс массива `data`.
     * <code>
     *     $myContainer->addDataString("string")
     *                  ->addDataString("string");
     * </code>
     * @param string $string
     * @return $this
     * @see dataStringBuild()
     */
    public function addDataString(string $string) : self
    {
        $this->data[$this->arrayIndex][] = $string;
        return $this;

    }

    /**
     * Увеличивает индекс массива `data`,
     * <code>
     *     $muContainer->dataStringBuild();
     * </code>
     * @see addDataString()
     * @return void
     */
    public function dataStringBuild() : self
    {
        $this->arrayIndex++;
        return $this;
    }

    /**
     * Добавляет данные в массив `data`
     * @param array $array
     * @return void
     */
    public function addDataArray(array $array) : void
    {
        try {
            if (!is_array($array[0])) {
                //массив одномерный
                $this->data[] = $array;
            } elseif (is_array($array[0][0])) {
                //массив трехмерный
                throw new Exception("addDataArray() Получил трехмерный массив. <br> Допускаются только одномерные и двумерные массивы!");
            }else{
                //массив двумерный
                $this->data = $array;
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Формирует html строку.
     * @return string
     */
    public function render(): string
    {
        $html = "";
        foreach ($this->data as $headerRow) {

            $html .= "<" . $this->tag;
            $html .= (strlen($this->class) > 0) ? " class=\"$this->class\"": "";
            $html .= (strlen($this->style) > 0) ? " style=\"$this->style\"": "";
            $html .= (strlen($this->attribute) > 0) ? "$this->attribute" : "";
            $html .= ">";

            foreach ($headerRow as $data){
                $html .= "<" . $this->colTag;
                $html .= (strlen($this->colClass) > 0) ? " class=\"$this->colClass\"" : "";
                $html .= (strlen($this->colStyle) > 0) ? " style=\"$this->colStyle\"" : "";
                $html .= (strlen($this->colAttribute) > 0) ? "$this->colAttribute" : "";

                $html .= ">";
                $html .= $data;
                $html .= "</$this->colTag>";
            }
            $html .= "</$this->tag>";
        }
        return $html;
    }

    public function wrapper(object ...$instanceOf): string
    {
        $header = "";
        $body = "";
        $footer = "";

        foreach ($instanceOf as $instance) {
            if (is_a($instance, Header::class)) {
                $header = $instance->render();
            }
            if (is_a($instance, Body::class)) {
                $body = $instance->render();
            }
            if (is_a($instance, Footer::class)) {
                $footer = $instance->render();
            }
        }

        $html = "";
        $html .= "<" . $this->tag;
        $html .= (strlen($this->class) > 0) ? " class=\"$this->class\"": "";
        $html .= (strlen($this->style) > 0) ? " style=\"$this->style\"": "";
        $html .= (strlen($this->attribute) > 0) ? "$this->attribute" : "";
        $html .= ">";
        $html .= $header;
        $html .= $body;
        $html .= $footer;
        $html .= "</$this->tag>";

        return $html;
    }
}