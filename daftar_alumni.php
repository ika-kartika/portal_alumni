<?php
$today = date("j, n, Y");
$thn=substr($today,-4,4);
//echo $thn;
$t=$thn-1;
//echo $t;
//echo $today;
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
$id = $_SESSION['id'];
include('oraconn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title >Homepage</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="resource/style.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <?
        include ('navbarperusahaan.php');
        ?>
    </div>
    <div class="row">
        <h3>List Of Fresh Graduations</h3><br>
        <?
        $com="select * from alumni where thn_lulus='$thn' or thn_lulus='$t' order by thn_lulus desc";
        $statement1=oci_parse($c,$com);
        oci_execute($statement1);

        ?>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>NIM</th>
                <th>Major</th>
                <th>Concentration</th>
                <th>Title Of TA</th>
                <th>IPK</th>
                <th>Graduate of Date</th>
                <th>Telp</th>
                <th>Action</th>
            </tr>
            </thead>
            <?
            while($baris1=oci_fetch_array($statement1)){
                $nama=$baris1['NAMA'];
                ?>
                <tbody>
                <tr>
                    <td><?echo $baris1['NAMA']; ?></td>
                    <td><?echo $baris1['NIM']; ?></td>
                    <td><?echo $baris1['JURUSAN']; ?></td>
                    <td><?echo $baris1['KONSENTRASI']; ?></td>
                    <td><?echo $baris1['JUDUL_TA']; ?></td>
                    <td><?echo $baris1['IPK']; ?></td>
                    <td><?echo $baris1['TGL_LULUS']; ?></td>
                    <td><?echo $baris1['NO_TELP']; ?></td>
                    <td><a href="profilpr.php?namauser=<?=$nama;?>" class="btn btn-primary">Go To Profil</a></td>
                </tr>
                </tbody>
                <?
            }
            ?>
        </table>
    </div>
    <footer>
        <p>&copy; Ika Kartika Sari 2012</p>
    </footer>
</div>

<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>


</body>
</html>