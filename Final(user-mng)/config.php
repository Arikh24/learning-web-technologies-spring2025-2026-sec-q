<?php
session_start();
$admin_id       = "admin";
$admin_password = "1122";
define('DB_HOST', 'localhost');
define('DB_NAME', 'user-mng');
define('DB_USER', 'root');      
define('DB_PASS', '');          
define('DB_CHARSET', 'utf8mb4');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST
             . ';dbname=' . DB_NAME
             . ';charset=' . DB_CHARSET;
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            die("<p style='color:red;'>Database connection failed: "
                . htmlspecialchars($e->getMessage()) . "</p>");
        }
    }
    return $pdo;
}
?>
