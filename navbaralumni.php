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
                    <?  echo                   "<i class='icon-user'></i>",$_SESSION['username']         ;                    ?>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">

                    <li>
                        <div style="width: 314px">
                            <div class="modal-header">

                                <h3><?echo $_SESSION['username']         ; ?></h3>
                            </div>
                            <div class="modal-body">
                                <div class="row-fluid">
                                    <div class="span3">
<!-- ambil foto -->
<?
		include("oraconn.php");
		$username = $_SESSION['username'];
		$query_foto = "select foto from alumni where id_user = '$id'";
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
			echo 	"<img src='photo/",$foto[0],"' alt=''  class='thumbnail span12'>";
			//echo 	"</br>sudah upload</br>";
		}		
?>
                          <!--              <img src="resource/img/default.png" alt="" class="thumbnail span12">	-->
                                    </div>
                                    <div class="span9">
                                        <a href="homealumni.php"><i class="icon-home"></i> Home </a>
                                        <a href="profiluser.php?namauser=<?=$namauser;?>"><i class="icon-user"></i> Profile </a>
										<a href="cariuser.php"><i class="icon-search"></i> Search</a>
                                        <a href="editpicturealumni.php"><i class="icon-picture"></i> Edit Profile Picture</a>
										<a href="editinfoalumni.php"><i class="icon-cog"></i> Edit Account</a>
										
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">

                                <a href="logout.php" class="btn btn-primary"><i class="icon-off"></i> Log Out</a>
                            </div>
                        </div>

                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>