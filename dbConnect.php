<?php

ini_set('display_errors', 1); // turn display errors on for development

// Initialise variables
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';
$connectstr_charset = 'utf8';
global $link_pdo;               // used in functions


//mysql connection voodoo
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

//Using PDO to connect
$dsn = "mysql:host=$connectstr_dbhost;dbname=$connectstr_dbname;charset=$connectstr_charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try 
    {
        $link_pdo = new PDO($dsn, $connectstr_dbusername, $connectstr_dbpassword, $opt);
        //echo "Connected to database";   // check for connection
    }
        catch(PDOException $e)
    {
        echo $e->getMessage();
    }

include "show.php";
?>