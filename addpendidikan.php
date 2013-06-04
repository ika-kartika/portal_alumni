<?
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
$id=$_SESSION['id'];
$id_alumni = $_SESSION['id_alumni'];
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

    <title>
        Add Educations
    </title>
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script>
        $(document).ready(function(){
        $("#jenjang").change(function(){
            // tampilkan animasi loading saat pengecekan ke database
            $('#pesan').html("<img src='resource/img/loader.gif' /> checking ...");
            var jenjang  = $("#jenjang").val();

            $.ajax({
                type:"POST",
                url:"proses-checkjenjang.php",
                data: "aksi=checkjenjang&jenjang=" + jenjang,
                success: function(data){
                    if(data==0){
                        $("#pesan").html('<img src="resource/img/tick.png"> Ok,,Jenjang Has Not Registered');
                        $('#pesan1').val('Ok,,Jenjang Has Not Registered');
                        $('#jenjang').css('border', '3px #090 solid');
                    }
                    else{
                        $("#pesan").html('<img src="resource/img/cross.png"> Jenjang Has Registered');
                        $('#pesan1').val('Jenjang Has Registered');
                        $('#jenjang').css('border', '3px #C33 solid');
                    }
                }
            });
        })
            $("#tahun_keluar").change(function(){
                // tampilkan animasi loading saat pengecekan ke database
                $('#pesan2').html("<img src='resource/img/loader.gif' /> checking ...");
                var tahun_keluar  = $("#tahun_keluar").val();
                var tahun_masuk =$("#tahun_masuk").val();

                if (tahun_keluar > tahun_masuk){
                    $("#pesan2").html('<img src="resource/img/tick.png">ok,,,! ');
                    $('#pesan3').val('ok,,,! ');
                    $('#tahun_keluar').css('border', '3px #090 solid');

                }
                else{
                    $("#pesan2").html('<img src="resource/img/cross.png">Wrong Year,,,!');
                    $('#pesan3').val('Wrong Year,,,!');
                    $('#tahun_keluar').css('border', '3px #C33 solid');
                }
            })
        });
    </script>
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

        <div class="span8 well">
            <div class="accordion" id="accordionalumni">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapsealumni">
                            <i class="icon-file"></i>  Add Educations <i class="icon-minus pull-right"></i>
                        </a>
                    </div>
                    <div id="collapsealumni" class="accordion-body collapse in">
                        <div class="accordion-inner" style="background-color: #ffffff;">
                                                    <form class="form-horizontal" method="post" action="proses-addpendidikan.php">
                                                        <?php
                                                        include('oraconn.php');
?>
                                                        <fieldset>
                                                            <legend>Education</legend>
                                                            <div class="control-group">
                                                                <label class="control-label" >Name Of School</label>
                                                                <div class="controls">
                                                                    <input type="text" class="input-xlarge" id="nama_sekolah" name="nama_sekolah">
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label" for="jenjang">School Level</label>
                                                                <div class="controls">
                                                                    <select style="width:110px" id="jenjang" name="jenjang">
                                                                        <option> </option>
                                                                        <option>SD</option>
                                                                        <option>SMP</option>
                                                                        <option>SMA</option>
                                                                        <option>S1</option>
                                                                        <option>S2</option>
                                                                        <option>S3</option>
                                                                    </select><span id="pesan"></span>
                                                                    <input type="hidden" class="input-xlarge" id="pesan1" name="pesan1">
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label" for="tahun_masuk">Start</label>
                                                                <div class="controls">
                                                                    <select id="tahun_masuk" name="tahun_masuk">
                                                                        <?
                                                                        $tahunn = "select * from tahun order by tahun asc";
                                                                        $statementtahun=oci_parse($c,$tahunn);
                                                                        oci_execute($statementtahun);
                                                                        while($baristahun = oci_fetch_array ($statementtahun, OCI_BOTH))
                                                                        {?>
                                                                            <option><?echo $baristahun['TAHUN'];?></option>
                                                                            <?

                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label" for="tahun_keluar">End</label>
                                                                <div class="controls">
                                                                    <select id="tahun_keluar" name="tahun_keluar">
                                                                        <?
                                                                        $tahunn = "select * from tahun order by tahun asc";
                                                                        $statementtahun=oci_parse($c,$tahunn);
                                                                        oci_execute($statementtahun);
                                                                        while($baristahun = oci_fetch_array ($statementtahun, OCI_BOTH))
                                                                        {?>
                                                                            <option><?echo $baristahun['TAHUN'];?></option>
                                                                            <?

                                                                        }
                                                                        ?>
                                                                    </select><span id="pesan2"></span>
                                                                    <input type="hidden" class="input-xlarge" id="pesan3" name="pesan3">
                                                                </div>
                                                            </div>
                                                            <div class="control-group">
                                                                <label class="control-label" for="alamat_sekolah">Address</label>
                                                                <div class="controls">
                                                                    <textarea class="input-xlarge" rows="3" id="alamat_sekolah" name="alamat_sekolah"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-actions">
                                                                <button type="submit" class="btn btn-primary" id="add_pendidikan">Add</button>
                                                                <button class="btn" data-dismiss="modal">Cancel</button>
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