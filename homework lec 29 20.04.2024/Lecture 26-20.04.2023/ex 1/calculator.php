<?php
class Calculator
{
    private $currentValue;

    public function add($value)
    {
        $this->currentValue += $value;
    }

    public function subtract($value)
    {
        $this->currentValue -= $value;
    }

    public function multiply($value)
    {
        $this->currentValue *= $value;
    }

    public function divide($value)
    {
        $this->currentValue /= $value;
    }

    public function getCurrentValue()
    {
        return $this->currentValue;
    }
}
?>
