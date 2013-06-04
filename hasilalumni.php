<?php
session_start();
$id = $_SESSION['id'];
include('oraconn.php');
$name = "select * from alumni where id_user='$id'";
    $statement=oci_parse($c,$name);
    oci_execute($statement);
while($barisnama = oci_fetch_array ($statement, OCI_BOTH))
{
    $namauser=$barisnama['NAMA'];
    $id_user=$id;
}

$nama=$_POST['nama'];
$nim=$_POST['nim'];
$jurusan=$_POST['jurusan'];
$konsentrasi=$_POST['konsentrasi'];
$lulus=$_POST['thn_lulus'];
$angkatan=$_POST['angkatan'];
$jk=$_POST['jk'];
$operasi=$_POST['operasi'];
$ipk=$_POST['ipk'];

$where_nama = " nama like '%$nama%' ";
$where_nim = " nim like '%$nim%' ";
$where_ipk_besar = " ipk >= '$ipk' ";
$where_ipk_kecil = " ipk <= '$ipk' ";
$where_jurusan = " jurusan like '%$jurusan%' ";
$where_konsentrasi = " konsentrasi = '$konsentrasi' ";
$where_lulus = " thn_lulus like '%$lulus%' ";
$where_angkatan = " angkatan like '%$angkatan%'";
$where_jk = " jenis_kelamin like'%$jk%'";

//cek isi variabel
if($nama!='')
{
    $where[]=$where_nama;
}
if($nim!='')
{
    $where[]=$where_nim;
}

if($jurusan!='')
{
    $where[]=$where_jurusan;
}

if($konsentrasi!='')
{
    $where[]=$where_konsentrasi;
}

if($lulus!='')
{
    $where[]=$where_lulus;
}
if($angkatan!='')
{
    $where[]=$where_angkatan;
}
if($jk!='')
{
    $where[]=$where_jk;
}

if($ipk!='')
{
    if ($operasi=='>'){
    $where[]=$where_ipk_besar;}
    elseif($operasi=='<'){
    $where[]=$where_ipk_kecil;}
}

$jumlah_variable = count($where);
//echo "<font color='white'><br/>jumlah variable = ",$jumlah_variable,"</font><br/>";
//echo "<font color='white'><br/>tesssssssssssssssssssstttttttttttt</font><br/>";

switch ($jumlah_variable)
{
    case 0:
        echo "Tidak ada keyword & kriteria yang dipilih";
        break;
    case 1:
        //echo "Ada 1 keyword & kriteria yang dipilih</br>";
        $where_final = $where[0];
        //echo "where_final = ",$where_final;
        break;
    case 2:
//        echo "Ada 2 keyword & kriteria yang dipilih</br>";
        $where_final = $where[0]."and".$where[1];
        //echo "where_final = ",$where_final;
        break;
    case 3:
//        echo "Ada 3 keyword & kriteria yang dipilih</br>";
        $where_final = $where[0]."and".$where[1]."and".$where[2];
        //echo "where_final = ",$where_final;
        break;
    case 4:
//        echo "Ada 4 keyword & kriteria yang dipilih</br>";
        $where_final = $where[0]."and".$where[1]."and".$where[2]."and".$where[3];
        //echo "where_final = ",$where_final;
        break;
    case 5:
//        echo "Ada 5 keyword & kriteria yang dipilih</br>";
        $where_final = $where[0]."and".$where[1]."and".$where[2]."and".$where[3]."and".$where[4];
        //echo "where_final = ",$where_final;
        break;
    case 6:
//        echo "Ada 6 keyword & kriteria yang dipilih</br>";
        $where_final = $where[0]."and".$where[1]."and".$where[2]."and".$where[3]."and".$where[4]."and".$where[5];
        //echo "where_final = ",$where_final;
        break;
	case 7:
//        echo "Ada 6 keyword & kriteria yang dipilih</br>";
        $where_final = $where[0]."and".$where[1]."and".$where[2]."and".$where[3]."and".$where[4]."and".$where[5]."and".$where[6];
        //echo "where_final = ",$where_final;
        break;
	case 8:
//        echo "Ada 6 keyword & kriteria yang dipilih</br>";
        $where_final = $where[0]."and".$where[1]."and".$where[2]."and".$where[3]."and".$where[4]."and".$where[5]."and".$where[6]."and".$where[7];
        //echo "where_final = ",$where_final;
        break;	
    default:
        echo "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Result</title>
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
        include('navbaralumni.php');
        ?>
    </div>
    <div class="row">
       <div class="span3">
            <div class="well" style="padding: 8px 0;">
                <ul class="nav nav-list">
                    <li class="nav-header">List header</li>
<!-- ambil foto -->
<?
		$username = $_SESSION['username'];
		$query_foto = "select foto from alumni where id_user = '$id'";
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
        <!--            <li><a href="#" class="thumbnail"><img src="resource/img/default.png" alt=""></a></li><br> -->
                    <li><a href="homealumni.php"><i class="icon-file"></i> News Feed</a></li>
                    <li><a href="profiluser.php?namauser=<?=$namauser;?>"><i class="icon-user"></i> Profile</a></li>
                    <li><a href="infouser.php?namauser=<?=$namauser;?>"><i class="icon-list-alt"></i> Info</a></li>
                    <li class="active"><a href="#"><i class="icon-search"></i> Search</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <h3>Search Result</h3>
            <div class="accordion" id="accordionperusahaan">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordionperusahaan" href="#collapseperusahaan">
                            <i class="icon-search"></i> Search <i class="icon-minus pull-right"></i>
                        </a>
                    </div>
                    <div id="collapseperusahaan" class="accordion-body collapse in">
                        <div class="accordion-inner" style="background-color: #ffffff;">
            <table class="table">
                <thead>
                <tr>
                    <th>NIM</th>
                    <th>Name</th>
                    <th>Title Of TA</th>
                    <th>IPK</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query_cari="select * from alumni where".$where_final;
                $statement_pencarian=oci_parse($c,$query_cari);
                oci_execute($statement_pencarian,OCI_DEFAULT);
                //echo $query_cari;
                while($baris1=oci_fetch_array($statement_pencarian,OCI_BOTH)){
                $id_user=$baris1['ID_USER'];
                    $query_email="select * from login where id_user='$id_user'";
                    $statement_email=oci_parse($c,$query_email);
                    oci_execute($statement_email,OCI_DEFAULT);
                    $id_alumni=$baris1['ID_ALUMNI'];
                    while($baris2=oci_fetch_array($statement_email,OCI_BOTH)){
//                        $email=$baris2['EMAIL'];
                        ?>
                <tr>
                    <td><?php echo $baris1['NIM'];?></td>
                    <td><?php echo $baris1['NAMA'];?></td>
                    <td><?php echo $baris1['JUDUL_TA'];?></td>
                    <td><?php echo $baris1['IPK'];?></td>
                    <div id="myModal<?php echo $baris1['ID_ALUMNI'];?>" class="modal hide fade" style="display: none;">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal">x</button>
                            <h3>nama : <?php echo $baris1['NAMA'];?></h3>
                        </div>
                        <div class="modal-body">
                        
                            <div class="accordion" id="accordion2<?php echo $baris1['ID_ALUMNI'];?>">
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2<?php echo $baris1['ID_ALUMNI'];?>" href="#collapseOne<?php echo $baris1['ID_ALUMNI'];?>">
                                            <i class="icon-user"></i>Basic Info <i class="icon-minus pull-right"></i>
                                        </a>
                                    </div>
                                    <div id="collapseOne<?php echo $baris1['ID_ALUMNI'];?>" class="accordion-body collapse" style="height: 0px;">
                                        <div class="accordion-inner" style="background-color: #ffffff;">
							
                               <!-- <center><div class="thumbnail"><img src="resource/img/default.png"></div></center>	-->
								<div class="row-fluid">
                                                <div class="span4">
                                                    <br>Name <br>
                                                    <br>NIM<br>
                                                    <br>Place Of Birth<br>
                                                    <br>Date Of Birth<br>
                                                    <br>Sex<br>
                                                    <br>Religion<br>
                                                    <br>Majors<br>
                                                    <br>Consentration<br>
                                                    <br>Generation<br>
                                                    <br>Title Of TA<br>
                                                    <br>Date Of Graduate<br>
                                                    <br>IPK<br>
                                                    <br>Phone Number<br>
                                                    <br>Email<br>
                                                    <br>Address<br>
                                                    <br>Motto Of Live <br> <hr>

                                                </div>
                                                <div class="span8">
                                                    <br>: <? echo $baris1['NAMA']; ?><br>
                                                    <br>: <? echo $baris1['NIM']; ?><br>
                                                    <br>: <? echo $baris1['TEMPAT_LAHIR']; ?><br>
                                                    <br>: <? echo $baris1['TGL_LAHIR']; ?><br>
                                                    <br>: <? echo $baris1['JENIS_KELAMIN']; ?><br>
                                                    <br>: <? echo $baris1['AGAMA']; ?><br>
                                                    <br>: <? echo $baris1['JURUSAN']; ?><br>
                                                    <br>: <? echo $baris1['KONSENTRASI']; ?><br>
                                                    <br>: <? echo $baris1['ANGKATAN']; ?><br>
                                                    <br>: <? echo $baris1['JUDUL_TA'];?><br>
                                                    <br>: <? echo $baris1['TGL_LULUS']; ?><br>
                                                    <br>: <? echo $baris1['IPK']; ?><br>
                                                    <br>: <? echo $baris1['NO_TELP']; ?><br>
                                                    <br>: <? echo $baris2['EMAIL']; ?><br>
                                                    <br>: <? echo $baris1['ALAMAT']; ?><br>
                                                    <br>: <? echo $baris1['MOTTO_HIDUP']; ?><br> <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2<?php echo $baris1['ID_ALUMNI'];?>" href="#collapseTwo<?php echo $baris1['ID_ALUMNI'];?>">
                                            <i class="icon-file"></i> Educations <i class="icon-minus pull-right"></i>
                                        </a>
                                    </div>
                                    <div id="collapseTwo<?php echo $baris1['ID_ALUMNI'];?>" class="accordion-body collapse">
                                        <div class="accordion-inner" style="background-color: #ffffff;">
                                            <?
                        $query_pen="select * from pendidikan where id_alumni='$id_alumni'";
                        $statement_pen=oci_parse($c,$query_pen);
                        oci_execute($statement_pen,OCI_DEFAULT);
                        while($baris3=oci_fetch_array($statement_pen,OCI_BOTH)){
?>
                                            <br>
                                            <br>Name Of School : <?echo $baris3['NAMA_SEKOLAH']; ?><br>
                                            <br>Level : <?echo $baris3['JENJANG']; ?><br>
                                            <br>Start : <?echo $baris3['TAHUN_MASUK']; ?><br>
                                            <br>End : <?echo $baris3['TAHUN_KELUAR']; ?><br>
                                            <br>Address : <?echo $baris3['ALAMAT_SEKOLAH']; ?> <br> <hr>
                            <?
                        }
?>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2<?php echo $baris1['ID_ALUMNI'];?>" href="#collapseThree<?php echo $baris1['ID_ALUMNI'];?>">
                                            <i class="icon-briefcase"></i> Jobs <i class="icon-minus pull-right"></i>
                                        </a>
                                    </div>
                                    <div id="collapseThree<?php echo $baris1['ID_ALUMNI'];?>" class="accordion-body collapse">
                                        <div class="accordion-inner" style="background-color: #ffffff;">
                                             <?
                        $query_pek="select * from pekerjaan where id_alumni='$id_alumni'";
                        $statement_pek=oci_parse($c,$query_pek);
                        oci_execute($statement_pek,OCI_DEFAULT);
                        while($baris4=oci_fetch_array($statement_pek,OCI_BOTH)){
                            ?>
                            <br>
                                <br>Name Of Company : <?echo $baris4['NAMA_PERUSAHAAN']; ?><br>
                                <br>Departement : <?echo $baris4['BAGIAN']; ?><br>
                                <br>Position : <?echo $baris4['JABATAN']; ?><br>
                                <br>Start : <?echo $baris4['TAHUN_MASUK']; ?><br>
                                <br>End : <?echo $baris4['TAHUN_KELUAR']; ?><br>
                                <br>Address : <?echo $baris4['ALAMAT_PERUSAHAAN']; ?><br> <hr>
                             <?
                        }
?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
						<?
						$nm = $baris1['NAMA'];
						?>
						<a href="profiluser.php?namauser=<?=$nm;?>" class="btn btn primary"><i class="icon-share-alt"></i>See Profil User</a>
                            <a href="#" class="btn" data-dismiss="modal">Close</a>
<!--                            <a href="#" class="btn btn-primary">Save changes</a>-->
                        </div>
                    </div>
                 <td> <a data-toggle="modal" href="#myModal<?php echo $baris1['ID_ALUMNI'];?>" class="btn btn-primary">See More Info..</a> </td>

                </tr>
                    <?php
                }}
                ?>
                </tbody>
            </table>



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer> <p>&copy; Ika Kartika Sari 2012</p> </footer>
</div>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>
</html>