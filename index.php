<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Data</title>
</head>
<body>

<p>Some text</p>

</body>

<?php
// Include database class
include "tmClass.php";

// Initialise variables
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';
$connectstr_charset = 'utf8';
global $link_pdo;               // used in functions

//mysql connection voodoo
foreach ($_SERVER as $key => $value){
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0){
        continue;
    }
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

// Define configuration
define("DB_HOST", $connectstr_dbhost);
define("DB_USER", $connectstr_dbusername);
define("DB_PASS", $connectstr_dbpassword);
define("DB_NAME", $connectstr_dbname);

echo "host:".DB_HOST."<br>";
echo "user:".DB_USER."<br>";
echo "pass:".DB_PASS."<br>";
echo "db:".DB_NAME."<br>";

// Instantiate database
$database = new Database();

//insert query
$database->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');
// bind the data
$database->bind(':fname', 'John');
$database->bind(':lname', 'Smith');
$database->bind(':age', '24');
$database->bind(':gender', 'male');
//
$database->execute();
echo $database->lastInsertId();             // the id just inserted

// get a single row
$database->query('SELECT FName, LName, Age, Gender FROM mytable WHERE FName = :fname');
$database->bind(':fname', 'Jenny');
$row = $database->single();
// print the row
echo "<pre>";
echo "A single row";
print_r($row);
echo "</pre>";

// Select multiple rows
$database->query('SELECT FName, LName, Age, Gender FROM mytable WHERE LName = :lname');
$database->bind(':lname', 'Smith');
$rows = $database->resultset();
//print the rows
echo "<pre>";
echo "a set of rows";
print_r($rows);
echo "</pre>";
?>
<footer>Time:17:19</footer>
</html>
