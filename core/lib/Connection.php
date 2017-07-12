<?php
namespace core;

final class Connection
{
    public static $db;

    public function __construct() {
        if(null === self::$db) {
            self::$db = new \mysqli(HOST, USERNAME, PASSWORD, DATABASE);
            self::$db->set_charset("utf8");
        }

        if(self::$db->connect_errno) {
            exit("Ошибка соединения с базой данных");
        }
    }
}