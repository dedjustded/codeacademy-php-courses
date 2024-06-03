<?php
class Get implements ArrayAccess
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
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
        throw new RuntimeException('Cannot modify $_GET superglobal');
    }

    public function offsetUnset($offset): void
    {
        throw new RuntimeException('Cannot modify $_GET superglobal');
    }
}
?>

