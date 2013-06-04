<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
$y = 0;
$id=$_SESSION['id'];
include('oraconn.php');
                                        $data_admin1="select * from admin where id_user='$id'";
                                        $statement_admin1=oci_parse($c,$data_admin1);
                                        oci_execute($statement_admin1);
                                        while($baris1 = oci_fetch_array ($statement_admin1, OCI_BOTH))
                                        {
                                            $nama=$baris1['NAMA'];
                                            $namauser=$baris1['NAMA'];
                                            $nip=$baris1['NIP'];
                                        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Panel Admin</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="jquery.autocomplete.css">
    <script type="text/javascript" src="jquery.autocomplete.js"></script>
    <link rel="stylesheet" type="text/css" href="resource/style.css">
    <script type="text/javascript" src="resource/jquery.1.4.2.min.js"></script>
    <script type="text/javascript" src="update.js"></script>
    <script type="text/javascript" src="pagingumum.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script>
        $(document).ready(function(){

            $("#add").click(function(){
                // ambil value data dari form
                var tahun  = $("#tahun").val();
                // kirim dengan metode POST ke proses.php
                $.ajax({
                    type:"POST",
                    url:"proses-addtahun.php",
                    data:"aksi=tambah&tahun=" + tahun,
                    success: function(data){
                        $("#info").html(data);
                    }
                });
            });
        });
    </script>
<!--	<script type="text/javascript">
        $(document).ready(function(){

            $("#autoadmin").autocomplete("proses-carisubadmin.php", {
                width: 150
            });

            $("#autoalumni").autocomplete("proses-carisubalumni.php", {
                width: 150
            });
            $("#autoperusahaan").autocomplete("proses-carisubperusahaan.php", {
                width: 150
            });

			$("#cari").autocomplete("proses-carisubadmin.php", {
                width: 150
            });

        });
    </script>	-->
</head>
<body>
<div class="container">
    <div class="row">
<?
include('navbaradmin.php');
?>
    </div>
    <div class="row">
        <h2>Panel Admin</h2><br>
    <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#lA" data-toggle="tab">Admin</a></li>
            <li class=""><a href="#lB" data-toggle="tab">Alumni</a></li>
            <li class=""><a href="#lC" data-toggle="tab">Perusahaan</a></li>
            <li class=""><a href="#lD" data-toggle="tab">Other</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="lA">
                <p>if you want add admin <a href="addadmin.php">klik here</a></p><br>
                <form class="form-horizontal" method="post" action="cariadmin.php">
                <fieldset>
                    <div class="control-group">
                    <label class="control-label">Search</label>
                    <div class="controls">
                        <input type="text" class="input-medium search-query" id="autoadmin" name="autoadmin">
                        <button type="submit" class="btn" id="cariadmin"><i class="icon-search"></i></button>
                    </div>
                </div>

                    </fieldset>
                </form>
                <?php
                include('oraconn.php');
                $admin="select nip,nama,alamat,no_telp from admin order by id_admin asc";
                $statement_admin=oci_parse($c,$admin);
                oci_execute($statement_admin,OCI_DEFAULT);
                ?>

                <table class="table">
                    <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    while($baris=oci_fetch_array($statement_admin,OCI_BOTH)){

                        ?>
                    <tr>
                        <td><?php echo $baris['NIP'];?></td>
                        <td><?php echo $baris['NAMA'];?></td>
                        <td><?php echo $baris['ALAMAT'];?></td>
                        <td><?php echo $baris['NO_TELP'];?></td>
                        <?
                        $nama1 = $baris['NAMA'];
                        $nip1 = $baris['NIP'];
                        ?>
                        <td>
                            <a href="seemore-admin.php?nama=<?=$nama1?>&nip=<?=$nip1?>" class="btn btn">See More</a>
                            <a href="proses-deleteadmin.php?nip=<?=$nip1?>" class="btn btn">Delete</a></form>
                        </td>
                    </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="lB">
                <?php
                $alumni="select nim,nama,judul_ta,ipk from alumni order by id_alumni asc";
                $statement_alumni=oci_parse($c,$alumni);
                oci_execute($statement_alumni,OCI_DEFAULT);
                ?>
                <p>if you want add alumni <a href="addalumni.php">klik here</a></p>
                <form class="form-horizontal" method="post" action="carialumni.php">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label">Search</label>
                            <div class="controls">
                                <input type="text" class="input-medium search-query" id="autoalumni" name="autoalumni">
                                <button type="submit" class="btn" id="carialumni" name="carialumni"><i class="icon-search"></i></button>
                            </div>
                        </div>

                    </fieldset>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Name</th>
                        <th>Titlt Of TA</th>
                        <th>IPK</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($baris1=oci_fetch_array($statement_alumni,OCI_BOTH)){

                        ?>
                    <tr>
                        <td><?php echo $baris1['NIM'];?></td>
                        <td><?php echo $baris1['NAMA'];?></td>
                        <td><?php echo $baris1['JUDUL_TA'];?></td>
                        <td><?php echo $baris1['IPK'];?></td>
                        <?
                        $nama = $baris1['NAMA'];
                        $nim = $baris1['NIM'];
                        echo    "<form method='post' action='seemore-alumni.php' name='alumni'>";
                        echo    "<input type='hidden' name='nama' value='",$nama,"' />";
                        echo    "<input type='hidden' name='nim' value='",$nim,"' />";
                        echo    "<td><input type='submit' value='see more' class='btn btn'>";
                     ?>
                                <input type='submit' value='delete' class='btn btn' formaction='proses-deletealumni.php'></td>
                        </form>

                    </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>


            <div class="tab-pane" id="lC">
                <?php
                $perusahaan="select nama_perusahaan,bidang,web,alamat_perusahaan from perusahaan order by id_perusahaan asc";
                $statement_perusahaan=oci_parse($c,$perusahaan);
                oci_execute($statement_perusahaan,OCI_DEFAULT);
                ?>
                <p>if you want add company <a href="addperusahaan.php">klik here</a></p>
                <form class="form-horizontal" method="post" action="cariperusahaan.php">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label">Search</label>
                            <div class="controls">
                                <input type="text" class="input-medium search-query" id="autoperusahaan" name="autoperusahaan">
                                <button type="submit" class="btn" id="cariperusahaan" name="cariperusahaan"><i class="icon-search"></i></button>
                            </div>
                        </div>

                    </fieldset>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Sector</th>
                        <th>Website</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    while($baris2=oci_fetch_array($statement_perusahaan,OCI_BOTH)){

                        ?>
                    <tr>
                        <td><?php echo $baris2['NAMA_PERUSAHAAN'];?></td>
                        <td><?php echo $baris2['BIDANG'];?></td>
                        <td><?php echo $baris2['WEB'];?></td>
                        <td><?php echo $baris2['ALAMAT_PERUSAHAAN'];?></td>
                        <?
                        $nama2 = $baris2['NAMA_PERUSAHAAN'];
                        $bidang = $baris2['BIDANG'];
                        ?>
                        <td><a href="seemore-perusahaan.php?nama_perusahaan=<?=$nama2?>&bidang=<?=$bidang?>" class="btn btn">See More</a>
                            <a href="proses-deleteperusahaan.php?nama=<?=$nama2?>" class="btn btn">Delete</a></form>
                        </td>
                    </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="lD">
                <form class="form-horizontal">
                    <?php
                    include('oraconn.php');
                    ?>
                    <fieldset>
                        <legend>Input Year</legend>
                        <div class="control-group">
                            <label class="control-label" >Year</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="tahun" name="tahun">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" id="add">Add</button>
                            <button class="btn" data-dismiss="modal">Cancel</button>
                        </div>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
    </div>
</div>
<footer>
    <p>&copy; Ika Kartika Sari 2012</p>
</footer>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>
</html>