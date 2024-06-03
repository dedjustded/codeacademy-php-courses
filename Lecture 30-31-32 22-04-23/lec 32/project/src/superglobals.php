<?php
namespace superglobals;
class SuperGlobals
{
    public static function get(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }
    public static function post(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }
    public static function session(): Session
    {
        return new Session();
    }
}

