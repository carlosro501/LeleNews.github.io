
<?php
    include "db.php";


$id = $_GET['id'];

$sql ="UPDATE USERS SET `STATUS` = 2 WHERE EMAIL = '$id' ";
$stmt = $conn->prepare($sql);

if ($stmt->execute()){
    header("location: index.php?Exito");
}else header("location: index.php?Error");

?>