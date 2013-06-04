<?php
session_start();
$id = $_SESSION['id'];
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Info</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css"/>
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="perusahaan.js"></script>
</head>
<body>
<?
include('oraconn.php');
$data_perusaaan="select * from perusahaan where id_user='$id'";
$statement_perusahaan=oci_parse($c,$data_perusaaan);
oci_execute($statement_perusahaan);
while($baris = oci_fetch_array ($statement_perusahaan, OCI_BOTH))
{
    $nmper=$baris['NAMA_PERUSAHAAN'];
    $bidangper=$baris['BIDANG'];
//    $id_user=$baris['ID_USER'];
    $web=$baris['WEB'];
    $telp=$baris['NO_TELP'];
    $fax=$baris['NO_FAX'];
    $alamat=$baris['ALAMAT_PERUSAHAAN'];
}
$pass_perusahaan = "select * from login where id_user ='$id'";
$statement_pass = oci_parse($c,$pass_perusahaan);
oci_execute($statement_pass);
while($baris1 = oci_fetch_array ($statement_pass, OCI_BOTH))
{
    $password=$baris1['PASSWORD'];
    $email=$baris1['EMAIL'];
}
?>
<div class="container">
    <div class="row">

        <?
include('navbarperusahaan.php');
        ?>
    </div>
    <div class="row">
        <div class="span3">
            <div class="well" style="padding: 8px 0;">
                <ul class="nav nav-list">
                    <li class="nav-header">List header</li>
                    <?
                    $username = $_SESSION['username'];
                    $query_foto = "select foto from perusahaan where id_user = '$id'";
                    //echo "</br>",$query_foto,"</br>";
                    $stat_foto = oci_parse($c, $query_foto);
                    oci_execute($stat_foto);
                    $foto = oci_fetch_array ($stat_foto, OCI_BOTH);
                    if($foto[0] == "belum upload")
                    {
                        echo    "<li><a href='#' class='thumbnail'><img src='resource/img/default.png' alt=''></a></li><br>";
                        //echo 	"</br>",$foto[0],"</br>";
                    }
                    else
                    {
                        echo 	"<li><a href='#' class='thumbnail'><img src='photo/",$foto[0],"' alt=''></a></li><br>";
                        //echo 	"</br>sudah upload</br>";
                    }
                    ?>
<!--                    <li><a href="#" class="thumbnail"><img src="resource/img/default.png" alt=""></a></li><br>-->
                    <li><a href="homeperusahaan.php"><i class="icon-file"></i> News Feed</a></li>
                    <li><a href="infouserpr.php?namauser=<?=$nmper;?>"><i class="icon-list-alt"></i> Info</a></li>
<!--                    <li><a href="infoperusahaan.php"><i class="icon-list-alt"></i> Info</a></li>-->
                    <li><a href="pencarian.php"><i class="icon-search"></i>Search </a> </li>
<!--                    <li><a href="#"><i class="icon-eye-open"></i> Notification</a></li>-->
                </ul>
            </div>
        </div>
        <div class="span9">
            <?
include('formperusahaan.php');
            ?>
        </div>
        </div>
    <footer>
        <p>&copy; Ika Kartika Sari 2012</p>
    </footer>
    </div>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>
</html>