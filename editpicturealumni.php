<?
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
$id = $_SESSION['id'];
include("oraconn.php");
$name = "select * from alumni where id_user='$id'";
    $statement=oci_parse($c,$name);
    oci_execute($statement);
while($barisnama = oci_fetch_array ($statement, OCI_BOTH))
{
    $nama=$barisnama['NAMA'];
    $id_user=$id;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Upload Profile Picture
    </title>
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="Password_Strength.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="jquery.min.js"></script>
        <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        $('#img_prev')
        .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        }
        }
        </script>
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
		$query_foto = "select foto from alumni where nama = '$username'";
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
            <li><a href="homealumni.php"><i class="icon-file"></i> News Feed</a></li>
            <li><a href="profiluser.php?namauser=<?=$nama;?>"><i class="icon-user"></i> Profile</a></li>
            <li><a href="infouser.php?namauser=<?=$nama;?>"><i class="icon-list-alt"></i> Info</a></li>
            <li><a href="cariuser.php"><i class="icon-search"></i> Search</a></li>
        </ul>
    </div>
</div>
<div class="span8 well">
<h2>Upload Profile Picture</h2>
<div class="accordion" id="accordionalumni">
<div class="accordion-group">
<div class="accordion-heading">
    <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapsealumni">
        <i class="icon-pencil"></i> Select File <i class="icon-minus pull-right"></i>
    </a>
</div>
<div id="collapsealumni" class="accordion-body collapse in">
<div class="accordion-inner" style="background-color: #ffffff;">

<form class="form-horizontal" action="proses-editpicturealumni.php" method="post" enctype="multipart/form-data">
<fieldset>
<div class="control-group">
<label class="control-label">Image</label>
<div class="controls">
    <a href="#" class="thumbnail">
<!-- ambil foto -->
<?
		$username = $_SESSION['username'];
		$query_foto = "select foto from alumni where nama = '$username'";
		//echo "</br>",$query_foto,"</br>";
		$stat_foto = oci_parse($c, $query_foto);
		oci_execute($stat_foto);
		$foto = oci_fetch_array ($stat_foto, OCI_BOTH);
		if($foto[0] == "belum upload")
		{
			echo    "<img src='resource/img/default.png' alt='' id='img_prev' name='img_prev'>";
			//echo 	"</br>",$foto[0],"</br>";
		}
		else
		{
			echo 	"<img src='photo/",$foto[0],"' alt='' id='img_prev' name='img_prev'>";
			//echo 	"</br>sudah upload</br>";
		}		
?>
    <!--    <img src="resource/img/default.png" alt="" id="img_prev" name="img_prev">	-->
        <input type='file' onchange="readURL(this);" name="foto"/>
    </a>
</div> </div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary" id="save">Upload</button>
</div>
</fieldset>
</form>

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