<?php 
    include "db.php";

    if(!empty($_POST['user']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['fullname']) ){

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $user = $_POST['user'];
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        

        $sql = "CALL sp_SingUp(?, ?, ?, ?, ?, sysdate())";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $pass);
        $stmt->bindParam(3, $user);
        $stmt->bindParam(4, $fullname);
        $stmt->bindParam(5, $phone);


        if ($stmt->execute()){
            header("location: Signinup.php");
        } else header("location: ../BDM-PWCI-Proyecto-Final/Signinup.php?error=Error"); 
        
    } else header("location: ../BDM-PWCI-Proyecto-Final/Signinup.php?error=CamposFaltantes"); 
?>