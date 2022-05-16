<?php
    include "db.php";
session_start();
$idnews = $_GET['id'];
$cat = $_GET['key'];
$key = $_GET['cat'];


if(isset($_POST["submit"])){
    if(empty($_POST['comentario']) ){
        header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=CamposVacios");
    } 
        if($_SESSION['status'] < 2){
  

            $user_check = $_SESSION['email'];

            $comment = $_POST['comentario'];
        
            $sql_coment = "CALL sp_newsComment(?, ?, ?, sysdate())";
            $consulta = $conn->prepare($sql_coment);
            $consulta->bindParam(1, $comment);
            $consulta->bindParam(2, $idnews);
            $consulta->bindParam(3, $user_check);

            if ($consulta->execute()){
                header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&Exito");
            } else header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=Error");
        }else header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=Bloqueado");

}else if(isset($_POST["submit2"])){
    if(empty($_POST['comentario']) ){
        header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=CamposVacios");
    } 
    if($_SESSION['status'] < 2){
  
            $user_check = $_SESSION['email'];
            $master = $_GET['comm'];
            $comment = $_POST['comentario'];
        
            $sql_coment = "CALL sp_newsReply(?, ?, ?, sysdate())";
            $consulta = $conn->prepare($sql_coment);
            $consulta->bindParam(1, $comment);
            $consulta->bindParam(2, $master);
            $consulta->bindParam(3, $user_check);

            if ($consulta->execute()){
                header("location: ../BDM-PWCI-Proyecto-Final/Respuesta.php?id=$idnews&com=$master");
            } else header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=Error");
        }else header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=Bloqueado");
}else header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=Error2");


?>