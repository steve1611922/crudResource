<?php
// Initialise variables
$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';
$connectstr_charset = 'utf8';

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
class oopCrud{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db = DB_NAME;
    
/*  private $host="localhost";
    private $user="root";
    private $db="primax";
    private $pass="";          */
    private $conn;

    public function __construct(){

        $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);
    }

    public function showData($table){

        $sql="SELECT * FROM $table";
        $q = $this->conn->query($sql) or die("failed!");

        while($r = $q->fetch(PDO::FETCH_ASSOC)){
            $data[]=$r;
        }
        return $data;
    }

    public function getById($id,$table){

        $sql="SELECT * FROM $table WHERE id = :id";
        $q = $this->conn->prepare($sql);
        $q->execute(array(':id'=>$id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function update($id,$name,$email,$mobile,$address,$table){

        $sql = "UPDATE $table
 SET name=:name,email=:email,mobile=:mobile,address=:address
 WHERE id=:id";
        $q = $this->conn->prepare($sql);
        $q->execute(array(':id'=>$id,':name'=>$name,
            ':email'=>$email,':mobile'=>$mobile,':address'=>$address));
        return true;

    }

    public function insertData($name,$email,$mobile,$address,$table){

        $sql = "INSERT INTO $table SET name=:name,email=:email,mobile=:mobile,address=:address";
        $q = $this->conn->prepare($sql);
        $q->execute(array(':name'=>$name,':email'=>$email,
            ':mobile'=>$mobile,':address'=>$address));
        return true;
    }

    public function deleteData($id,$table){

        $sql="DELETE FROM $table WHERE id=:id";
        $q = $this->conn->prepare($sql);
        $q->execute(array(':id'=>$id));
        return true;
    }
}

?>
