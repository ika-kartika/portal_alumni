<?
session_start();
$id = $_SESSION['id'];
include("oraconn.php");
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
<!--    <link rel="stylesheet" type="text/css" href="Password_Strength.css">-->
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
<!--	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>-->
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
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Alumni TF STTA</a>
                <div class="btn-group pull-right">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                        <!--                        <i class='icon-user'></i>-->
                        <?  echo"<i class='icon-user'></i>",$_SESSION['username']; ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">

                        <li>
                            <div style="width: 314px">
                                <div class="modal-header">

                                    <h3>Username - Administrator</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row-fluid">
                                        <div class="span3">
<!-- ambil foto -->
<?
		//$username = $_SESSION['username'];
		$query_foto = "select foto from admin where id_user = '$id'";
		//echo "</br>",$query_foto,"</br>";
		$stat_foto = oci_parse($c, $query_foto);
		oci_execute($stat_foto);
		$foto = oci_fetch_array ($stat_foto, OCI_BOTH);
		if($foto[0] == "belum upload")
		{
			echo    "<img src='resource/img/default.png' alt='' class='thumbnail span12'>";
			//echo 	"</br>",$foto[0],"</br>";
		}
		else
		{
			echo 	"<img src='photo/",$foto[0],"' alt='' class='thumbnail span12'>";
			//echo 	"</br>sudah upload</br>";
		}		
?>
                                <!--            <img src="resource/img/default.png" alt="" class="thumbnail span12">		-->
                                        </div>
                                        <div class="span9">
                                            <a href="#"><i class="icon-cogs"></i> Home </a>
                                            <a href="#"><i class="icon-cogs"></i> Edit Profile </a>
											<a href="#"><i class="icon-cogs"></i> Edit Profile Picture</a>
                                            <a href="#"><i class="icon-cogs"></i> Settings Account</a>
										</div>
                                    </div>

                                </div>
                                <div class="modal-footer">

                                    <button href="#" class="btn btn-primary"><i class="icon-off"></i> Log Out</button>
                                </div>
                            </div>

                        </li>

                    </ul>
                </div>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li class="icon-user icon-white" style="margin-top: 10px"><a href="#"></a></li>
                        <li class="icon-eye-open icon-white" style=" margin-top: 10px; margin-left: 10px"><a href="#about"></a></li>
                        <li style="margin-left: 10px"><form class="form-search">
                            <input type="text" class="input-medium search-query">
                            <button type="submit" class="btn">Search</button>
                        </form></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
</div>
<div class="row">
<div class="span3">
    <div class="well" style="padding: 8px 0;">
        <ul class="nav nav-list">
            <li class="nav-header">List header</li>
<!-- ambil foto -->
<?
		//$username = $_SESSION['username'];
		$query_foto = "select foto from admin where id_user = '$id'";
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
            <li><a href="#"><i class="icon-file"></i> News Feed</a></li>
            <li><a href="#"><i class="icon-user"></i> Profile</a></li>
            <li><a href="#"><i class="icon-list-alt"></i> Info</a></li>
            <li><a href="#"><i class="icon-eye-open"></i> Notification</a></li>
            <li><a href="paneladmin.php"><i class="icon-check"></i> Administrator</a></li>
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

<form class="form-horizontal" action="proses-editpicture.php" method="post" enctype="multipart/form-data">
<fieldset>
<div class="control-group">
<label class="control-label">Image</label>
<div class="controls">
    <a href="#" class="thumbnail">
<?
        if($foto[0] == "belum upload")
        {
            echo    "<img src='resource/img/default.png' alt='' id='img_prev' name='img_prev'>";
            //echo 	"</br>",$foto[0],"</br>";
        }
        else
        {
            echo 	"<img src='photo/",$foto[0],"' alt='' id='img_prev' name='img_prev'>";
            //echo 	"</br>sudah upload</br>";
        }	?>




<!--        <img src="resource/img/default.png" alt="" id="img_prev" name="img_prev">-->
        <input type="file" onchange="readURL(this);" id="foto" name="foto"/>
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