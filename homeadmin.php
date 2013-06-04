<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
$id=$_SESSION['id'];
include('oraconn.php');
$name = "select * from admin where id_user='$id'";
$statement=oci_parse($c,$name);
oci_execute($statement);
while($barisnama = oci_fetch_array ($statement, OCI_BOTH))
{
    $namauser=$barisnama['NAMA'];
$nama=$namauser;
$nip=$barisnama['NIP'];
    $id_user=$id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homepage Admin</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="resource/style.css">
    <script type="text/javascript" src="resource/jquery.1.4.2.min.js"></script>
    <script type="text/javascript" src="updatead.js"></script>
    <script type="text/javascript" src="pagingumumad.js"></script>
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
        <div class="span6">
            <form>
                <label><h3>Update Status</h3></label>
                <textarea class="span6" id="update" rows="4" style="width: 100%" placeholder='Write Somethings...'></textarea>
                <button type="submit" class="btn" id="update_button">Post</button>
                <input type='hidden' name='id_tujuan' id='id_tujuan' value='<?echo $id;?>' />
                <input type='hidden' name='id_tujuan' id='namausr' value='<?echo $name;?>' />
                <!--                <div id="flashmessage">-->
                <div id="flash" align="left"></div>
                <!--                </div>-->
            </form>
            <div id="status">
                <?php include('buka_statusad.php'); ?>
            </div>
        </div>
        <div class="span3">
            <?
include('siadmin.php');
?>

        </div>
    </div></div></div></div></div></div></div>
<footer>
    <p>&copy;Ika Kartika Sari 2012</p>
</footer>

</div>

<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>
</html>