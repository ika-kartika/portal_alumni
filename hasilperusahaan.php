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

$nama=$_POST['nama_perusahaan'];
$bidang=$_POST['bidang'];
$alamat=$_POST['alamat'];

$where_nama = " nama_perusahaan like '%$nama%' ";
$where_bidang = " bidang like '%$bidang%' ";
$where_alamat = " alamat_perusahaan like '%$alamat%' ";


//cek isi variabel
if($nama!='')
{
    $where[]=$where_nama;
}
if($bidang!='')
{
    $where[]=$where_bidang;
}

if($jurusan!='')
{
    $where[]=$where_jurusan;
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
                    <th>Company Of Name</th>
                    <th>Sector</th>
                    <th>Web</th>
                    <th>Address</th>
					<th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query_cari="select * from perusahaan where".$where_final;
                $statement_pencarian=oci_parse($c,$query_cari);
                oci_execute($statement_pencarian,OCI_DEFAULT);
//                echo $query_cari;
                while($baris1=oci_fetch_array($statement_pencarian,OCI_BOTH)){
                $id_user=$baris1['ID_USER'];
                    $query_email="select * from login where id_user='$id_user'";
                    $statement_email=oci_parse($c,$query_email);
                    oci_execute($statement_email,OCI_DEFAULT);
                    $id_perusahaan=$baris1['ID_PERUSAHAAN'];
                    while($baris2=oci_fetch_array($statement_email,OCI_BOTH)){
//                        $email=$baris2['EMAIL'];
                        ?>
                <tr>
                    <td><?php echo $baris1['NAMA_PERUSAHAAN'];?></td>
                    <td><?php echo $baris1['BIDANG'];?></td>
                    <td><?php echo $baris1['WEB'];?></td>
					<td><?php echo $baris1['ALAMAT_PERUSAHAAN'];?></td>
                    <div id="myModal<?php echo $baris1['ID_PERUSAHAAN'];?>" class="modal hide fade" style="display: none;">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal">x</button>
                            <h3>Company Of Name : <?php echo $baris1['NAMA_PERUSAHAAN'];?></h3>
                        </div>
                        <div class="modal-body">
                        
                            <div class="accordion" id="accordion2<?php echo $baris1['ID_PERUSAHAAN'];?>">
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2<?php echo $baris1['ID_PERUSAHAAN'];?>" href="#collapseOne<?php echo $baris1['ID_PERUSAHAAN'];?>">
                                            <i class="icon-user"></i>Basic Info <i class="icon-minus pull-right"></i>
                                        </a>
                                    </div>
                                    <div id="collapseOne<?php echo $baris1['ID_PERUSAHAAN'];?>" style="height: 0px;" class="accordion-body collapse">
                                        <div class="accordion-inner" style="background-color: #ffffff;">
                                            <!--<center><div class="thumbnail"><img src="resource/img/default.png"></div></center>-->
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <br>Name Of Company<br>
                                                    <br>Sector<br>
                                                    <br>web<br>
													<br>Fax Number<br>
                                                    <br>Phone Number<br>
                                                    <br>Email<br>
                                                    <br>Address<br>
                                                     <hr>

                                                </div>
                                                <div class="span8">
                                                    <br>: <? echo $baris1['NAMA_PERUSAHAAN']; ?><br>
                                                    <br>: <? echo $baris1['BIDANG']; ?><br>
                                                    <br>: <? echo $baris1['WEB']; ?><br>
                                                    <br>: <? echo $baris1['NO_FAX']; ?><br>
                                                    <br>: <? echo $baris1['NO_TELP']; ?><br>
                                                    <br>: <? echo $baris2['EMAIL']; ?><br>
                                                    <br>: <? echo $baris1['ALAMAT_PERUSAHAAN']; ?><br> <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
						<?
						$nm = $baris1['NAMA_PERUSAHAAN'];
						?>
						<a href="profiluser.php?namauser=<?=$nm;?>" class="btn btn primary"><i class="icon-share-alt"></i>See Profil User</a>
                            <a href="#" class="btn" data-dismiss="modal">Close</a>
<!--                            <a href="#" class="btn btn-primary">Save changes</a>-->
                        </div>
                    </div>
                 <td> <a data-toggle="modal" href="#myModal<?php echo $baris1['ID_PERUSAHAAN'];?>" class="btn btn-primary">See More Info..</a> </td>

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