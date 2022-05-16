<?php
    include "db.php";


    if(!empty($_POST['categoria'])  && !empty($_POST['color']) ){

        $categoria = $_POST['categoria'];
        $color = $_POST['color'];
        $hexa = $_POST['hexa'];
        $id = $_GET['id'];

        $sql = "CALL sp_updCat(?, ?, ?, ?, sysdate())";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $categoria);
        $stmt->bindParam(3, $color);
        $stmt->bindParam(4, $hexa);




        
        if ($stmt->execute()){
            header("location: verCategorias.php");
        } else header("location: ../BDM-PWCI-Proyecto-Final/updCategoria.php?error=Error");
        
    }else header("location: ../BDM-PWCI-Proyecto-Final/updCategoria.php?error=CamposFaltantes");
?>