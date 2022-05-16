<?php
    include "db.php";

    $id = $_GET['id'];

    $sql ="DELETE FROM USERS WHERE EMAIL = '$id' ";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()){
        header("location: index.php");
    }else header("location: verEmpleados.php?=Error");

?>