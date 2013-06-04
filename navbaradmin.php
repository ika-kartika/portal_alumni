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
                                        include("oraconn.php");
                                        $username = $_SESSION['username'];
										$id = $_SESSION['id'];
//                                        $data_admin1="select * from admin where id_user='$id'";
//                                        $statement_admin1=oci_parse($c,$data_admin1);
//                                        oci_execute($statement_admin1);
//                                        while($baris1 = oci_fetch_array ($statement_admin1, OCI_BOTH))
//                                        {
//                                            $nama=$baris1['NAMA'];
//                                            $namauser=$baris1['NAMA'];
//                                            $nip=$baris1['NIP'];
//                                        }

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
                                    </div>
                                    <div class="span9">
                                        <a href="homeadmin.php"><i class="icon-home"></i> Home </a>
                                        <a href="profilad.php?namauser=<?=$namauser;?>"><i class="icon-user"></i> Profile </a>
                                        <a href="editpicture.php"><i class="icon-picture"></i> Edit Profile Picture</a>
                                        <a href="seemore-admin.php?nama=<?=$nama?>&nip=<?=$nip?>"><i class="icon-cog"></i> Settings Account</a>
                                        <a href="paneladmin.php"><i class="icon-check"></i> Administrator</a>
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