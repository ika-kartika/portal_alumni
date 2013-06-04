<?
$id_user=$barisalumni['ID_USER'];
$nim = $barisalumni['NIM'];
$nama = $barisalumni['NAMA'];
$tmp = $barisalumni['TEMPAT_LAHIR'];
$tgll = $barisalumni['TGL_LAHIR'];
$agama = $barisalumni['AGAMA'];
$lulus = $barisalumni['TGL_LULUS'];
$ipk = $barisalumni['IPK'];
$jurusan = $barisalumni['JURUSAN'];
$konsentrasi = $barisalumni['KONSENTRASI'];
$ta = $barisalumni['JUDUL_TA'];
$angkatan = $barisalumni['ANGKATAN'];
$tlp = $barisalumni['NO_TELP'];
$alamat = $barisalumni['ALAMAT'];
$motto = $barisalumni['MOTTO_HIDUP'];
$alumni = $barisalumni['ID_ALUMNI'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title >Alumni Info</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="resource/style.css">
    <script type="text/javascript" src="resource/jquery.1.4.2.min.js"></script>
    <script type="text/javascript" src="updatead.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
</head>
<body>
<div class="container">
<div class="row">
    <?
    include('navbaradmin.php');
    ?>
</div>
<!--        </div>-->

<div class="row">
<div class="span3">
    <div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list">
            <li class="nav-header">List header</li>
            <!-- ambil foto -->
            <?
            $username = $_SESSION['username'];
            $query_foto = "select foto from alumni where id_user = '$id_user'";
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
            <!--            <li><a href="#" class="thumbnail"><img src="resource/img/default.png" alt=""></a></li><br>		-->
            <li><a href="homeadmin.php"><i class="icon-file"></i> News Feed</a></li>
            <?
            if($id_user==$id){?>
                <li><a href="profilad.php?namauser=<?=$namauser;?>"><i class="icon-user"></i> Profile</a></li>
                <li class="active"><a href="infouserad.php?namauser=<?=$nama;?>"><i class="icon-list-alt"></i> Info</a></li>
                <?
            }
            else {
                ?>
                <li><a href="profilad.php?namauser=<?=$namauser;?>"><i class="icon-user"></i> Profile</a></li>
                <li><a href="infouserad.php?namauser=<?=$namauser;?>"><i class="icon-list-alt"></i> Info</a></li>
                <?
            }?>
            <li><a href="paneladmin.php"><i class="icon-check"></i> Administrator</a></li>
        </ul>
    </div>
</div>

<?
$dataemail="select * from login where id_user ='$id_user'";
$statementmail=oci_parse($c,$dataemail);
oci_execute($statementmail);
while($baris2=oci_fetch_array($statementmail)){
    $email = $baris2['EMAIL'];
}

$datapendidikan="select * from pendidikan where id_alumni = '$alumni'";
$statementedu=oci_parse($c,$datapendidikan);
oci_execute($statementedu);


$datapekerjaan="select * from pekerjaan where id_alumni = '$alumni'";
$statementjob=oci_parse($c,$datapekerjaan);
oci_execute($statementjob);

?>
<div class="span8 well">
    <div class="accordion" id="accordion2">
        <div class="accordion-group">
            <div class="accordion-heading">
                <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    <i class="icon-user"></i>Basic Info <i class="icon-minus pull-right"></i>
                </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner" style="background-color: #ffffff;">

                    <?
                    $query_foto1 = "select foto from alumni where id_user = '$id_user'";
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
                        <tr><td>NIM</td><td>:</td><td><?echo $nim; ?></td></tr>
                        <tr><td>Place Of Birth</td><td>:</td><td><?echo $tmp; ?></td></tr>
                        <tr><td>Date Of Birth</td><td>:</td><td><?echo $tgll; ?></td></tr>
                        <tr><td>Religion</td><td>:</td><td><?echo $agama; ?></td></tr>
                        <tr><td>Genaration</td><td>:</td><td><?echo $angkatan; ?></td></tr>
                        <tr><td>IPK</td><td>:</td><td><?echo $ipk; ?></td></tr>
                        <tr><td>Majors</td><td>:</td><td><?echo $jurusan; ?></td></tr>
                        <tr><td>Concentration</td><td>:</td><td><?echo $konsentrasi; ?></td></tr>
                        <tr><td>Title Of TA</td><td>:</td><td><?echo $ta; ?></td></tr>
                        <tr><td>Date Of Graduate</td><td>:</td><td><?echo $lulus; ?></td></tr>
                        <tr><td>Email</td><td>:</td><td><? echo $email; ?></td></tr>
                        <tr><td>Phone Number</td><td>:</td><td><?echo $tlp; ?></td></tr>
                        <tr><td>Address</td><td>:</td><td><?echo $alamat; ?></td></tr>
                        <tr><td>Motto Of Live</td><td>:</td><td><?echo $motto; ?></td></tr>
                    </table>

                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                    <i class="icon-file"></i> Educations <i class="icon-minus pull-right"></i>
                </a>
            </div>
            <div id="collapseTwo" class="accordion-body collapse">
                <div class="accordion-inner" style="background-color: #ffffff;">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Level</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        while($baris3=oci_fetch_array($statementedu)){
                            $nmsklh = $baris3['NAMA_SEKOLAH'];
                            $almtsklh = $baris3['ALAMAT_SEKOLAH'];
                            $masuksklh = $baris3['TAHUN_MASUK'];
                            $keluarsklh = $baris3['TAHUN_KELUAR'];
                            $jenjang = $baris3['JENJANG'];
                            ?>
                        <tr>
                            <td><?php echo $nmsklh;?></td>
                            <td><?php echo $almtsklh;?></td>
                            <td><?php echo $masuksklh;?></td>
                            <td><?php echo $keluarsklh;?></td>
                            <td><?php echo $jenjang;?></td>
                        </tr>
                            <?
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                    <i class="icon-briefcase"></i> Jobs <i class="icon-minus pull-right"></i>
                </a>
            </div>
            <div id="collapseThree" class="accordion-body collapse">
                <div class="accordion-inner" style="background-color: #ffffff;">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Departement</th>
                            <th>Position</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Address</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        while($baris4=oci_fetch_array($statementjob)){
                            $nmpkrjaan = $baris4['NAMA_PERUSAHAAN'];
                            $almtpkrjaan = $baris4['ALAMAT_PERUSAHAAN'];
                            $bagian = $baris4['BAGIAN'];
                            $mskpkrjaan = $baris4['TAHUN_MASUK'];
                            $keluarpkrjaan = $baris4['TAHUN_KELUAR'];
                            $jabatan = $baris4['JABATAN'];

                            ?>
                                <tr>
                                    <td><?php echo $nmpkrjaan;?></td>
                            <td><?php echo $bagian;?></td>
                            <td><?php echo $jabatan;?></td>
                            <td><?php echo $mskpkrjaan;?></td>
                            <td><?php echo $keluarpkrjaan;?></td>
                            <td><?php echo $almtpkrjaan;?></td>
                            <?
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<footer>
    <p>&copy; Ika Kartika Sari 2012</p>
</footer>
</div>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>

</html>