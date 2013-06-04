
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
    <title>Panel Admin</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
</head>
<body>
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
        <div class="span8">
            <h3>Result</h3>

            <table class="table">
                <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Sector</th>
                    <th>Website</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php
                include ("oraconn.php");
                $isi = $_POST['autoperusahaan'];
                $perusahaan="select * from perusahaan where nama_perusahaan like '%$isi%' or bidang like '%$isi%'";
                $statement_perusahaan=oci_parse($c,$perusahaan);
                oci_execute($statement_perusahaan,OCI_DEFAULT);
                while($baris2=oci_fetch_array($statement_perusahaan,OCI_BOTH)){

                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $baris2['NAMA_PERUSAHAAN'];?></td>
                        <td><?php echo $baris2['BIDANG'];?></td>
                        <td><?php echo $baris2['WEB'];?></td>
                        <td><?php echo $baris2['ALAMAT_PERUSAHAAN'];?></td>
                        <?
                        $nama2 = $baris2['NAMA_PERUSAHAAN'];
                        $bidang = $baris2['BIDANG'];
                        ?>
                        <td><a href="seemore-perusahaan.php?nama_perusahaan=<?=$nama2?>&bidang=<?=$bidang?>" class="btn btn">See More</a>
                            <a href="proses-deleteperusahaan.php?nama=<?=$nama2?>" class="btn btn">Delete</a></form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<footer>
    <p>&copy; Ika Kartika Sari 2012</p>
</footer>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>
</html>
