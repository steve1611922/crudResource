<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

</body>
<?php
include_once("oopCrud.php");

$obj=new oopCrud;

if(isset($_REQUEST['update'])){
    extract($_REQUEST);
    if($obj->update($id,$name,$email,$mobile,$address,"students")){
        header("location:show.php?status=success");
    }
}

extract($obj->getById($_REQUEST['id'],"students"));
echo <<<show
<div class="container">
 <div class="btn-group">
 <button class="btn"><a href="show.php">Home</a></button>
 </div>
 <h3>Edit Your Data</h3>
 <form action="update.php" method="post">
 <table width="500" border="1">
 <tr>
 <th scope="row">Id</th>
 <td><input type="text" name="id" value="$id" readonly="readonly"></td>
 </tr>
 <tr>
 <th scope="row">Name</th>
 <td><input type="text" name="name" value="$name"></td>
 </tr>
 <tr>
 <th scope="row">Email</th>
 <td><input type="text" name="email" value="$email"></td>
 </tr>
 <tr>
 <th scope="row">Mobile</th>
 <td><input type="text" name="mobile" value="$mobile"></td>
 </tr>
 <tr>
 <th scope="row">Address</th>
 <td><textarea rows="5" cols="20" name="address">$address</textarea></td>
 </tr>
 <tr>
 <th scope="row">&nbsp;</th>
 <td><input type="submit" name="update" value="Update" class="btn"></td>
 </tr>
 </table>
 </form>
</div>
show;
?>
</html>
