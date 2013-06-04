<?
$id_user=$barisadmin['ID_USER'];
$nip = $barisadmin['NIP'];
$nama = $barisadmin['NAMA'];
$tmp = $barisadmin['TEMPAT_LAHIR'];
$tgll = $barisadmin['TGL_LAHIR'];
$agama = $barisadmin['AGAMA'];
$tlp = $barisadmin['NO_TELP'];
$alamat = $barisadmin['ALAMAT'];
$jk = $barisadmin['JENIS_KELAMIN'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Info User</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="resource/style.css">
    <script type="text/javascript" src="resource/jquery.1.4.2.min.js"></script>
    <script type="text/javascript" src="updatepr.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>

</head>
<body>
<?
$datae="select * from login where id_user ='$id_user'";
$statementdatae=oci_parse($c,$datae);
oci_execute($statementdatae);
while($barise=oci_fetch_array($statementdatae)){
    $email = $barise['EMAIL'];
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
                    $query_foto = "select foto from admin where id_user = '$id_user'";
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
                    <?
                    if($id_user==$id){?>
                        <li class="active"><a href="infouserpr.php?namauser=<?=$nama;?>""><i class="icon-list-alt"></i> Info</a></li>
                        <?
                    }
                    else {
//                        $query_profila="select * from alumni where id_user='$id'";
//                        $statement_profila=oci_parse($c,$query_profila);
//                        oci_execute($statement_profila);
//                        $aalumni=oci_fetch_array($statement_profila,OCI_BOTH);
//                        if($aalumni!=0){
//                            $namauser=$aalumni['NAMA'];
//                        }
//                        else{
//                            $query_profilad="select * from admin where id_user='$id'";
//                            $statement_profilad=oci_parse($c,$query_profilad);
//                            oci_execute($statement_profilad);
//                            $aadmin=oci_fetch_array($statement_profilad,OCI_BOTH);
//                            if($aadmin!=0){
//                                $namauser=$aadmin['NAMA'];
//                            }
//                            else{
//                                $query_profilp="select * from perusahaan where id_user='$id'";
//                                $statement_profilp=oci_parse($c,$query_profilp);
//                                oci_execute($statement_profilp);
//                                $aperusahaan=oci_fetch_array($statement_profilp,OCI_BOTH);
//                                if($aperusahaan!=0){
//                                    $namauser=$aperusahaan['NAMA_PERUSAHAAN'];
//                                }
//                            }
//                        }
                        ?>
                        <li><a href="infouserpr.php?namauser=<?=$nama;?>"><i class="icon-list-alt"></i> Info</a></li>
<?
                    }?>
                    <li><a href="pencarian.php"><i class="icon-search"></i>Search </a> </li>
<!--                    <li><a href="#"><i class="icon-eye-open"></i> Notification</a></li>-->
                </ul>
            </div>

        </div>
        <div class="span9">
            <div class="well">
                <div class="accordion" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                <i class="icon-user"></i>Info User <i class="icon-minus pull-right"></i>
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner" style="background-color: #ffffff;">
                                <?
                                $query_foto1 = "select foto from admin where id_user = '$id_user'";
                                //echo "</br>",$query_foto,"</br>";
                                $stat_foto1 = oci_parse($c, $query_foto1);
                                oci_execute($stat_foto1);
                                $foto1 = oci_fetch_array ($stat_foto1, OCI_BOTH);
                                if($foto1[0] == "belum upload")
                                {
                                    echo    "<li><a href='#' class='thumbnail'><img src='resource/img/default.png' alt=''></a></li><br>";
                                    //echo 	"</br>",$foto[0],"</br>";
                                }
                                else
                                {
                                    echo 	"<center><a href='#' class='thumbnail'><img src='photo/",$foto1[0],"' width='200' height='250' alt=''></a></center><br>";
                                    //echo 	"</br>sudah upload</br>";
                                }
                                ?>
                                <table border="0">
                                    <tr><td>Name</td><td>:</td><td><?echo $nama; ?></td></tr>
                                    <tr><td>NIP</td><td>:</td><td><?echo $nip; ?></td></tr>
                                    <tr><td>Place Of Birth</td><td>:</td><td><?echo $tmp; ?></td></tr>
                                    <tr><td>Date Of Birth</td><td>:</td><td><?echo $tgll; ?></td></tr>
                                    <tr><td>Religion</td><td>:</td><td><?echo $agama; ?></td></tr>
                                    <tr><td>sex</td><td>:</td><td><?echo $jk; ?></td></tr>
                                    <tr><td>Phone Number</td><td>:</td><td><?echo $tlp; ?></td></tr>
                                    <tr><td>Email</td><td>:</td><td><? echo $email; ?></td></tr>
                                    <tr><td>Address</td><td>:</td><td><?echo $alamat; ?></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <footer>
        <p>&copy; Ika Kartika Sari 2012</p>
    </footer>
</div>
</body>
</html>