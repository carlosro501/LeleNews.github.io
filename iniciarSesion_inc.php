<?php
    include "db.php";

    if(!empty($_POST['correo']) && !empty($_POST['contra']) ){

        $email = $_POST['correo'];
        $pass = $_POST['contra'];

        $searchUser = "SELECT * FROM USERS WHERE EMAIL = ? AND PASS = ?";
        $stmt = $conn->prepare($searchUser);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $pass);

        $stmt->execute();

        $ussers = $stmt->fetch(PDO::FETCH_ASSOC);

        if($ussers){
            session_start();  
            $_SESSION['email'] = $ussers["EMAIL"];
            $_SESSION['rol'] = $ussers["ROL"];
            $_SESSION['status'] = $ussers["STATUS"];
            header("location: index.php");
            exit;
        }else header("location: ../BDM-PWCI-Proyecto-Final/Signinup.php?error=UsuarioNoEncontrado"); 
        
    }else header("location: ../BDM-PWCI-Proyecto-Final/Signinup.php?error=CamposFaltantes"); 
?>