
<?php
    include "db.php";


$id = $_GET['id'];

$sql ="UPDATE USERS SET `STATUS` = 1 WHERE EMAIL = '$id' ";
$stmt = $conn->prepare($sql);

if ($stmt->execute()){
    header("location: index.php?Exito");
}else header("location: index.php?Error");

?>