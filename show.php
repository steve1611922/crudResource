<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Show Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<?php

    include_once("oopCrud.php");
    $obj=new oopCrud;

    if(isset($_REQUEST['status'])){
        echo"Your Data Successfully Updated";
    }

    if(isset($_REQUEST['status_insert'])){
        echo"Your Data Successfully Inserted";
    }

    if(isset($_REQUEST['del_id'])){
        if($obj->deleteData($_REQUEST['del_id'],"students")){

            echo"Your Data Successfully Deleted";
        }
    }
?>

<div class="container">
    <div class="btn-group">
        <button class="btn"><a href="show.php">Home</a></button>
        <button class="btn"><a href="insert.php">Insert</a></button>
    </div>
    <h3 >All The Data</h3>
    <table width="750" border="1" class="table-striped">
        <tr class="success">
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col">Address</th>
            <th scope="col">Action</th>
        </tr>
        <?php
            foreach($obj->showData("students") as $value){
                extract($value);
                echo <<<show
                <tr class="success">
                <td>$name</td>
                <td>$email</td>
                <td>$mobile</td>
                <td>$address</td>
                <td><button class="btn"><a href="update.php?id=$id">Edit</a>
                </button>&nbsp;&nbsp;<button class="btn"><a href="show.php?del_id=$id">Delete</a></button></td>
                </tr>
show;
                }
        ?>
        <tr class="success">
            <th scope="col" colspan="5" align="right">
                <div class="btn-group">
                    <button class="btn"><a href="insert.php">Insert New Data</a></button>
                </div>
            </th>

        </tr>
    </table>
</div>

<body>
</body>
</html>
