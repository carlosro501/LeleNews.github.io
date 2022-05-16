<?php
    include "db.php";

if(isset($_POST["submit"])){
    $revisar = getimagesize($_FILES["image"]["tmp_name"]);
    if($revisar !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContenido = addslashes(file_get_contents($image));
        
        
        //Insertar imagen en la base de datos


        $sql = ("INSERT INTO IMG_PERFIL (IMG, CREATION_DATE) VALUES ('$imgContenido', sysdate()); ");

        $insertar = $conn->prepare($sql);

        $insertar->execute();



        // Condicional para verificar la subida del fichero
        if($insertar){
            session_start();
            $_SESSION['IMAGE_BLOB'] = $image;
    
            header("location: Signinup.php");
        }else{
            header("location: ../BDM-PWCI-Proyecto-Final/updPerfil.php?error=Error");
        } 
        // Sie el usuario no selecciona ninguna imagen
    }else header("location: ../BDM-PWCI-Proyecto-Final/updPerfil.php?error=Error");
} 
?>