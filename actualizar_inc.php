<?php
    include "db.php";
    session_start();
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $user = $_POST['user'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $img = $_FILES['image'];


    if(!empty($_POST['user'])  && !empty($_POST['pass']) && !empty($_POST['fullname']) ){
    echo $img['tmp_name'];
    $directorio_destino = "images";
    
    $tmp_name = $img['tmp_name'];
        

    $img_file = $img['name'];
    $img_type = $img['type'];
    echo 1;
    // Si se trata de una imagen   
    if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
    strpos($img_type, "jpg")) || strpos($img_type, "png")))
    {
        //¿Tenemos permisos para subir la imágen?
        echo 2;
        $destino = $directorio_destino . '/' .  $img_file;



 

        $sql = "CALL sp_updPerfil(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $pass);
        $stmt->bindParam(3, $user);
        $stmt->bindParam(4, $fullname);
        $stmt->bindParam(5, $phone);
        $stmt->bindParam(6, $destino);


        
        if ($stmt->execute()){
            header("location: index.php");
        } else header("location: ../BDM-PWCI-Proyecto-Final/updPerfil.php?error=Error");

        (move_uploaded_file($tmp_name, $destino));

        }

    }else header("location: ../BDM-PWCI-Proyecto-Final/updPerfil.php?error=CamposFaltantes");
?>