<?php
    include "db.php";


    $id = $_GET['id'];

    $sql "UPDATE USERS SET ACTIVE = FALSE WHERE EMAIL = '$id' ";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()){
        header("location: verUsuarios.php?Exito");
    }else header("location: verUsuarios.php?Error");



?>