<?php

namespace another\TabGen\Trait;

trait ColAttributes
{

    protected $colTag = "div";
    protected $colClass = "col";
    protected $colStyle = "";
    protected $colAttribute = "";

    public function setColTag($colTag){
        $this->colTag = trim($colTag, " ");
    }
    public function setColClass($colClass) : self{
        $colClass = trim($colClass, " ");
        $this->colClass .= " $colClass";
        $this->colClass = ltrim($this->colClass, " ");

        return $this;
    }
    public function setColStyle($colStyle) : self{

        $colStyle = trim($colStyle, " ");
        $this->colStyle .= " $colStyle;";
        $this->colStyle = ltrim($this->colStyle, " ");

        return $this;
    }
    public function setColAttribute($name, $value) : self{
        $name = trim($name, " ");
        $value = trim($value, " ");
        $this->colAttribute .= " $name='$value'";
        $this->colAttribute = ltrim($this->colAttribute, " ");

        return $this;
    }
}