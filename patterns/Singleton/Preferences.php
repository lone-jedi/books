<?php

class Preferences
{
    private $properties = [];
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance() : Preferences
    {
        // Главное
        if(empty(self::$instance)) {
            self::$instance = new Preferences();
        }
        return self::$instance;
    }

    public function setProperty(string $key, string $val)
    {
        $this->properties[$key] = $val;
    }

    public function getProperty(string $key) : string
    {
        return $this->properties[$key] ?? '';
    }
}

$p1 = Preferences::getInstance();
$p2 = Preferences::getInstance();

var_dump($p1);
var_dump($p2);

class A
{
    public function B()
    {
        Preferences::getInstance()->getProperty('qwerty');
    }
}