<?php 
include "db.php";

$email = $_POST['email'];
$pass = $_POST['pass'];
$user = $_POST['user'];
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$puesto = $_POST['puesto'];
$img = $_FILES['image'];

    if(!empty($_POST['user']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['fullname']) ){


        $sql = "SELECT * FROM USERS WHERE `EMAIL` = '$email' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
    
        if($count < 1){

        $tmp_name = $img['tmp_name'];
        $directorio_destino = "images";
    
        $img_file = $img['name'];
        $img_type = $img['type'];
        // Si se trata de una imagen   

        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
            strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            //¿Tenemos permisos para subir la imágen?
            $destino = $directorio_destino . '/' .  $img_file;

            $sql = "CALL sp_SingUpEmpleado(?, ?, ?, ?, ?, ?, ?, sysdate() )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $pass);
            $stmt->bindParam(3, $user);
            $stmt->bindParam(4, $fullname);
            $stmt->bindParam(5, $phone);
            $stmt->bindParam(6, $puesto);
            $stmt->bindParam(7, $destino);



            if ($stmt->execute()){
                header("location: Signup.php");
            } else header("location: ../BDM-PWCI-Proyecto-Final/Signup.php?error=Error"); 

            if (move_uploaded_file($tmp_name, $destino))
            {
                return true;

            }
        } return false;//Si llegamos hasta aquí es que algo ha fallado
    }else if($count > 0){
        header("location: ../BDM-PWCI-Proyecto-Final/Signup.php?error=UsuarioExistente"); 
    }

    } else header("location: ../BDM-PWCI-Proyecto-Final/Signup.php?error=CamposFaltantes"); 
?>
