<?php
class SuperGlobals
{
    private static $instances = [];

    public static function getInstance(string $type): ?ArrayAccess
    {
        if (!isset(self::$instances[$type])) {
            switch ($type) {
                case 'POST':
                    self::$instances[$type] = new Post($_POST);
                    break;
                case 'GET':
                    self::$instances[$type] = new Get($_GET);
                    break;
                case 'SESSION':
                    self::$instances[$type] = new Session($_SESSION);
                    break;
                default:
                    throw new InvalidArgumentException("Invalid superglobal type: $type");
            }
        }

        return self::$instances[$type];
    }
}
?>

