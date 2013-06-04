
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
$id = $_SESSION['id'];
include('oraconn.php');
    $data_admin="select * from admin where id_user='$id'";
    $statement_admin=oci_parse($c,$data_admin);
    oci_execute($statement_admin);
        while($baris = oci_fetch_array ($statement_admin, OCI_BOTH))
        {
            $_SESSION['id_admin'] = $baris['ID_ADMIN'];
            $namauser=$baris['NAMA'];
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
                        <th>NIP</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>
            <?php
            include ("oraconn.php");
            $isi = $_POST['autoadmin'];
            $cari = "select * from admin where nama like '%$isi%' or nip like '%$isi%'";
            $statement_cari=oci_parse($c,$cari);
            oci_execute($statement_cari);
            while($baris = oci_fetch_array ($statement_cari, OCI_BOTH))
            {
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $baris['NIP'];?></td>
                            <td><?php echo $baris['NAMA'];?></td>
                            <td><?php echo $baris['ALAMAT'];?></td>
                            <td><?php echo $baris['NO_TELP'];?></td>
                            <?
                            $nama1 = $baris['NAMA'];
                            $nip1 = $baris['NIP'];
                            ?>
                            <td>
                                <a href="seemore-admin.php?nama=<?=$nama1?>&nip=<?=$nip1?>" class="btn btn"><i class="icon-share-alt"></i>See More</a>
                                <a href="proses-deleteadmin.php?nip=<?=$nip1?>" class="btn btn"><i class="icon-remove"></i>Delete</a></form>
                            </td>
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