<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
$id = $_SESSION['id'];

include('oraconn.php');
$nama1="select * from perusahaan where id_user='$id'";
$statement= oci_parse($c, $nama1);
oci_execute($statement);
while($baris=oci_fetch_array($statement,OCI_BOTH)){
    $nama=$baris['NAMA_PERUSAHAAN'];
    $bidang=$baris['BIDANG'];
    $fax=$baris['NO_FAX'];
    $telp=$baris['NO_TELP'];
    $alamat=$baris['ALAMAT_PERUSAHAAN'];
    $web=$baris['WEB'];
    $id_user = $id;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homepage Perusahaan</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="resource/style.css">
    <script type="text/javascript" src="resource/jquery.1.4.2.min.js"></script>
    <script type="text/javascript" src="updatepr.js"></script>
    <script type="text/javascript" src="paging.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>

</head>
<body>
<div class="container">
    <div class="row">
        <?
        include('navbarperusahaan.php');
        ?>
    </div>
    <div class="row-fluid">
        <div class="span3">
            <div class="well" style="padding: 8px 0;">
                <ul class="nav nav-list">
                    <li class="nav-header">List header</li>
<!-- ambil foto -->
<?
		//$username = $_SESSION['username'];
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
            <!--        <li><a href="#" class="thumbnail"><img src="resource/img/default.png" alt=""></a></li><br>		-->
                    <li class="active"><a href="homeperusahaan.php"><i class="icon-file"></i> News Feed</a></li>
                    <li><a href="infouserpr.php?namauser=<?=$nama;?>"><i class="icon-list-alt"></i> Info</a></li>
                    <li><a href="pencarian.php"><i class="icon-search"></i>Search </a> </li>
<!--                    <li><a href="#"><i class="icon-eye-open"></i> Notification</a></li>-->
                </ul>
            </div>
        </div>
        <div class="span6">

            <h2><?php echo  $nama;?></h2>
            <p><i class="icon-briefcase"></i> Sector <?php echo  $bidang;?>&nbsp &nbsp
                <i class="icon-signal"></i> Address <?php echo  $alamat;?>&nbsp &nbsp
                <i class="icon-home"></i> Website <?php echo  $web;?>&nbsp &nbsp
                Phone Number <?php echo  $telp;?>&nbsp &nbsp
                Fax Number <?php echo  $fax;?>&nbsp &nbsp <a href="infouserpr.php?namauser=<?=$nama;?>">See More Info...</a>
            </p>
            <form>
                <label><h3>Update Status</h3></label>
                <textarea class="span6" id="update" rows="4" style="width: 100%" placeholder='Write Somethings...'></textarea>
                <button type="submit" class="btn" id="update_button">Post</button>
                <input type='hidden' name='id_tujuan' id='id_tujuan' value='<?echo $id;?>' />
                <input type='hidden' name='id_tujuan' id='namausr' value='<?echo $nama;?>' />
                <!--                <div id="flashmessage">-->
                <div id="flash" align="left"></div>
                <!--                </div>-->
            </form>
            <div id="status">
                <?php include('buka_statuspr.php'); ?>
            </div>
        </div>
        <!--        </div>-->
        <div class="span3">
            <?
include('sialumni.php');
            ?>
        </div>

    </div>
</div></div>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<footer>
    <p>&copy; Ika Kartika Sari 2012</p>
</footer>
</body>
</html>