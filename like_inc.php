
<?php 
include "db.php";
session_start();
$idnews = $_GET['id'];
$cat = $_GET['cat'];
$key = $_GET['key'];

if(isset( $_SESSION['email'])){

if($_SESSION['status'] < 2){

$id = $_POST['id_new'];
$userid = $_SESSION['email'];

    if(isset($_GET['n'])){

        $sql = "SELECT * FROM LIKES WHERE `USER_ID` = '$userid' AND  `NEWS_ID` =  '$id' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        if($count < 1){
      

            $sql = "INSERT INTO LIKES (`NEWS_ID`, `USER_ID`) VALUES(?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $userid);
            if ($stmt->execute()){

                $si = "UPDATE NEWS SET LIKES = LIKES + 1 WHERE NEWS_ID = '$id' ";
                $cons = $conn->prepare($si);
                $cons->execute();
                    if ($cons->execute()){
                        $no = "UPDATE NEWS SET LIKES = LIKES - 1 WHERE NEWS_ID = '$id' ";
                        $cons = $conn->prepare($no);
                        $cons->execute();
                        header("location: Noticia.php?id=$idnews&cat=$cat&key=$key");
                        
                    } 
            }
        }else if($count > 0)
            header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=like");
    } else header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=error");
}else header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=Bloqueado");
}else header("location: ../BDM-PWCI-Proyecto-Final/Noticia.php?id=$idnews&cat=$cat&key=$key&error=NotienesCuenta");
?>