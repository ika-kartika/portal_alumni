<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
$id=$_SESSION['id'];
$id_alumni = $_SESSION['id_alumni'];
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
                        <th>NIM</th>
                        <th>Name</th>
                        <th>Titlt Of TA</th>
                        <th>IPK</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <?php
                    include ("oraconn.php");
                    $autoalumni = $_POST['autoalumni'];
                    $cari = "select * from alumni where nama like '%$autoalumni%' or nim like '%$autoalumni%' or konsentrasi like '%$autoalumni%' or thn_lulus like '%$autoalumni%'";
                    $statement_cari=oci_parse($c,$cari);
                    oci_execute($statement_cari);
                    while($baris1 = oci_fetch_array ($statement_cari, OCI_BOTH))
                    {
                        ?>
                    <tbody>
                    <tr>
                        <td><?php echo $baris1['NIM'];?></td>
                        <td><?php echo $baris1['NAMA'];?></td>
                        <td><?php echo $baris1['JUDUL_TA'];?></td>
                        <td><?php echo $baris1['IPK'];?></td>
                        <?
                        $nama = $baris1['NAMA'];
                        $nim = $baris1['NIM'];
                        echo    "<form method='post' action='seemore-alumni.php' name='alumni'>";
                        echo    "<input type='hidden' name='nama' value='",$nama,"' />";
                        echo    "<input type='hidden' name='nim' value='",$nim,"' />";
                        echo    "<td><input type='submit' value='see more' class='btn btn'>";
                        ?>
                        <input type='submit' value='delete' class='btn btn' formaction='proses-deletealumni.php'></td>
                        </form>

                    </tr>
                    </tbody>
                <?
            }


            ?>

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