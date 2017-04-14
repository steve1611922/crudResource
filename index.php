<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Data</title>
</head>

<body>

<p>Some text</p>

<?php
    // Include database class
    include "tmClass.php";

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

    echo DB_HOST;
    echo DB_USER;
    echo DB_PASS;
    echo DB_NAME."<br>";

        // Instantiate database
        $database = new Database();
        echo $database;

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

</body>
<footer>Time:17:19</footer>
</html>
