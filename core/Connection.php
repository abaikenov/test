<?php
namespace core;

final class Connection
{
    public static $db;

    public function __construct() {
        if(null === self::$db) {
            self::$db = new \mysqli('127.0.0.1', 'root', '', 'test');
            self::$db->set_charset("utf8");
        }

        if(self::$db->connect_errno) {
            exit("Ошибка соединения с базой данных");
        }
    }
}