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
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>

</head>
<body>
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
<!--                    <li><a href="#" class="thumbnail"><img src="resource/img/default.png" alt=""></a></li><br>-->
                    <li><a href="homeperusahaan.php"><i class="icon-file"></i> News Feed</a></li>
                    <li><a href="infouserpr.php?namauser=<?=$nama;?>"><i class="icon-list-alt"></i> Info</a></li>
                    <li class="active"><a href="pencarian.php"><i class="icon-search"></i>Search </a> </li>
<!--                    <li><a href="#"><i class="icon-eye-open"></i> Notification</a></li>-->
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="accordion" id="accordionperusahaan">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapseperusahaan">
                            <i class="icon-search"></i> Search <i class="icon-minus pull-right"></i>
                        </a>
                    </div>
                    <div id="collapseperusahaan" class="accordion-body collapse in">
                        <div class="accordion-inner" style="background-color: #ffffff;">
                            <form class="form-horizontal" method="post" action="proses-pencarian.php">
                                <fieldset>
                                    <legend>Search Alumni</legend>
                                    <div class="control-group">
                                        <label class="control-label">Name</label>
                                        <div class="controls">
                                            <input type="text" class="input-xlarge" id="nama" name="nama">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" >Major</label>
                                        <div class="controls">
                                            <input type="text" class="input-xlarge" id="jurusan" name="jurusan" readonly="readonly" value="Informatics Engineering">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" >Consentration</label>
                                        <div class="controls">
                                            <select id="konsentrasi" name="konsentrasi" style="width: 280px">
                                                <option> </option>
                                                <option>Computer Networking</option>
                                                <option>Information System</option>
                                                <option>Design And Animation</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" >Year of Graduate</label>
                                        <div class="controls">
                                            <select id="thn_lulus" name="thn_lulus" style="width: 280px">
                                                <option> </option>
                                                <option>2004</option>
                                                <option>2005</option>
                                                <option>2006</option>
                                                <option>2007</option>
                                                <option>2008</option>
                                                <option>2009</option>
                                                <option>2010</option>
                                                <option>2011</option>
                                                <option>2012</option>
                                                <option>2013</option>
                                                <option>2014</option>
                                                <option>2015</option>
                                                <option>2016</option>
                                                <option>2017</option>
                                                <option>2018</option>
                                                <option>2019</option>
                                                <option>2020</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" >sex</label>
                                        <div class="controls">
                                            <select id="jk" name="jk" style="width: 280px">
                                                <option> </option>
                                                <option>Men</option>
                                                <option>Women</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" >IPK</label>
                                        <div class="controls">
                                            <select id="operasi" name="operasi" style="width: 60px">
                                                <option><?echo "<"; ?></option>
                                                <option><?echo ">"; ?></option>
                                            </select>
                                            <input type="text" class="input" id="ipk" name="ipk">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary" id="cari">Search</button>
                                        <button class="btn">Cancel</button>
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