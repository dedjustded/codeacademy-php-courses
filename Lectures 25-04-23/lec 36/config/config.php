<?php

class Config
{
    private stdClass $settings;

    public function __construct()
    {
        $this->settings = new stdClass();
    }

    public function set(string $key, $value): void
    {
        $this->settings->$key = $value;
    }

    public function get(string $key)
    {
        return isset($this->settings->$key) ? $this->settings->$key : null;
    }

    public function remove(string $key): void
    {
        if (isset($this->settings->$key)) {
            unset($this->settings->$key);
        }
    }

    public function has(string $key): bool
    {
        return isset($this->settings->$key);
    }

    public function clear(): void
    {
        $this->settings = new stdClass();
    }

    public function loadFromFile(string $filename): void
    {
        if (!file_exists($filename)) {
            throw new ConfigException('File does not exist');
        }

        $jsonData = file_get_contents($filename);
        $data = json_decode($jsonData, true);

        if (!is_array($data)) {
            throw new ConfigException('Invalid JSON data');
        }

        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function saveToFile(string $filename): void
    {
        $jsonData = json_encode($this->settings, JSON_PRETTY_PRINT);
        file_put_contents($filename, $jsonData);
    }
}
