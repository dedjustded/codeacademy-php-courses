<?php
namespace App;
class Session implements \ArrayAccess
{
    private $data;

    public function __construct(&$data)
    {
        if (!is_array($data)) {
            $data = [];
        }
        $this->data = &$data;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }
}
?>
