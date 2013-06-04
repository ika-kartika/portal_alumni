<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
$id=$_SESSION['id'];
include('oraconn.php');
$data_admin1="select * from admin where id_user='$id'";
$statement_admin1=oci_parse($c,$data_admin1);
oci_execute($statement_admin1);
while($baris1 = oci_fetch_array ($statement_admin1, OCI_BOTH))
{
    $nama=$baris1['NAMA'];
    $namauser=$baris1['NAMA'];
    $nip=$baris1['NIP'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homepage Admin</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="perusahaan.js"></script>
</head>
<body>
<?
include('oraconn.php');
    $nama=$_GET['nama_perusahaan'];
    $bidang=$_GET['bidang'];
    $data_perusaaan="select * from perusahaan where bidang='$bidang' and nama_perusahaan='$nama'";
    $statement_perusahaan=oci_parse($c,$data_perusaaan);
    oci_execute($statement_perusahaan);
    while($baris = oci_fetch_array ($statement_perusahaan, OCI_BOTH))
            {
                $nmper=$baris['NAMA_PERUSAHAAN'];
                $bidangper=$baris['BIDANG'];
                $id_user=$baris['ID_USER'];
                $web=$baris['WEB'];
                $telp=$baris['NO_TELP'];
                $fax=$baris['NO_FAX'];
                $alamat=$baris['ALAMAT_PERUSAHAAN'];
               // echo $id_user;
            }
    $pass_perusahaan = "select * from login where id_user ='$id_user'";
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
include('navbaradmin.php');
        ?>
    </div>
    <div class="row">
        <div class="span3">
            <div class="well" style="padding: 8px 0;">
                <ul class="nav nav-list">
                    <li class="nav-header">List header</li>
                    <?
                    if($foto[0] == "belum upload")
                    {
                        echo    "<li><a href='#' class='thumbnail'><img src='resource/img/default.png' alt=''></a></li><br>";
                        //echo 	"</br>",$foto[0],"</br>";
                    }
                    else
                    {
                        echo 	"<li><a href='#' class='thumbnail'><img src='photo/",$foto[0],"' alt=''></a></li><br>";
                    }
                    ?>
                    <li  class="active"><a href="#"><i class="icon-file"></i> News Feed</a></li>
                    <li><a href="profilad.php?namauser=<?=$namauser;?>"><i class="icon-user"></i> Profile</a></li>
                    <li><a href="infouserad.php?namauser=<?=$namauser;?>"><i class="icon-list-alt"></i> Info</a></li>
                    <li><a href="paneladmin.php"><i class="icon-check"></i> Administrator</a></li>
                </ul>
            </div>
        </div>
        <div class="span8 well">
            <?
            include('formperusahaan.php');
?>
        </div>
        </div>
        <footer>
            <p>&copy;Ika Kartika Sari 2012</p>
        </footer>
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>
</html>