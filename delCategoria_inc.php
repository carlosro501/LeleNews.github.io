<?php
    include "db.php";

    $id = $_GET['id'];

    $sql ="DELETE FROM CATEGORIES WHERE CATEGORIES_ID = '$id' ";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()){
        header("location: verCategorias.php");
    }else header("location: verCategorias.php?=Error");

?>