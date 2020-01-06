<?php
class Database {
    private static $dsn = 'mysql:host=localhost;dbname=filesearch';
    private static $username = 'mgs_user';
    private static $password = 'pa55word';
    private static $db;
    private static $options;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password,
                                     self::$options);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}
?>