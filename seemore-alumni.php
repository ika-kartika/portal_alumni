<?
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
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
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include('oraconn.php');
if(!isset($_POST['nama']))
{
    // echo "pake session</br>";
    //echo $_SESSION['nama'],"</br";
    $nama=$_SESSION['nama'];
    $nim=$_SESSION['nim'];
}
else
{
    $nama=$_POST['nama'];
    $nim=$_POST['nim'];
}

$data_alumni="select * from alumni where nim='$nim' and nama='$nama'";
$statement_alumni=oci_parse($c,$data_alumni);
oci_execute($statement_alumni);
while($baris = oci_fetch_array ($statement_alumni, OCI_BOTH))

{
    $_SESSION['id_alumni'] = $baris['ID_ALUMNI'];
    $_SESSION['nama'] = $baris['nama'];
    $_SESSION['nim'] = $baris['nim'];
    ?>
    <title>
        Complete Data
    </title>
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="Password_Strength.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script>
        $(document).ready(function(){

            $("#save").click(function(){
                // ambil value data dari form
                var nama  = $("#nama").val();
                var nim  = $("#nim").val();
                var jurusan  = $("#jurusan").val();
                var konsentrasi  = $("#konsentrasi").val();
                var ta  = $("#ta").val();
                var bln_lls  = $("#bln_lls").val();
                var tgl_lls  = $("#tgl_lls").val();
                var thn_lls  = $("#thn_lls").val();
                var ipk  = $("#ipk").val();
                var tempat_lahir  = $("#tempat_lahir").val();
                var bulan  = $("#bulan").val();
                var tgl  = $("#tgl").val();
                var thn  = $("#thn").val();
                var kelamin  = $("#kelamin").val();
                var agama  = $("#agama").val();
                var telpon  = $("#telpon").val();
                var alamat  = $("#alamat").val();
                var motto  = $("#motto").val();
                var password  = $("#password").val();
                var email  = $("#email").val();
                // kirim dengan metode POST ke proses.php
                $.ajax({
                    type:"POST",
                    url:"proses-editalumni.php",
                    data:"aksi=ubah&nama=" + nama + "&nim=" + nim + "&jurusan=" +jurusan + "&konsentrasi=" + konsentrasi +  "&ta=" + ta + "&bln_lls=" + bln_lls + "&tgl_lls=" + tgl_lls + "&thn_lls="+thn_lls +"&ipk=" + ipk+  "&tempat_lahir=" + tempat_lahir + "&bulan=" + bulan + "&tgl=" + tgl + "&thn=" + thn + "&kelamin=" + kelamin + "&agama=" + agama + "&telpon=" + telpon + "&alamat=" + alamat + "&motto=" + motto + "&password=" + password + "&email=" + email,
                    success: function(data){
                        $("#info").html(data);
                    }
                });
            });

            $("#email").change(function(){
                // tampilkan animasi loading saat pengecekan ke database
                $('#pesan').html("<img src='resource/img/loader.gif' /> checking ...");
                var email  = $("#email").val();

                $.ajax({
                    type:"POST",
                    url:"proses-addalumni.php",
                    data: "aksi=checkemail&email=" + email,
                    success: function(data){
                        if(data==0){
                            $("#pesan").html('<img src="resource/img/tick.png"> email belum digunakan');
                            $('#email').css('border', '3px #090 solid');
                        }
                        else{
                            $("#pesan").html('<img src="resource/img/cross.png"> email sudah dipakai');
                            $('#email').css('border', '3px #C33 solid');
                        }
                    }
                });
            })

            if ($('#seemore-alumni').size()) {
                $.getScript(
                    'jquery.passroids.min.js',
                    function() {
                        $('form').passroids({
                            main : "#password"
                        });
                    }
                );
            }

            $("#repassword").change(function(){
                // tampilkan animasi loading saat pengecekan ke database
                $('#pesan2').html("<img src='resource/img/loader.gif' /> checking ...");
                var repassword  = $("#repassword").val();
                var password =$("#password").val();

                if (password==repassword){
                    $("#pesan2").html('<img src="resource/img/tick.png"> Password Match');
                    $('#repassword').css('border', '3px #090 solid');

                }
                else{
                    $("#pesan2").html('<img src="resource/img/cross.png"> Password Do Not Match');
                    $('#repassword').css('border', '3px #C33 solid');
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
        <i class="icon-file"></i> Data Alumni <i class="icon-minus pull-right"></i>
    </a>
</div>
<div id="collapsealumni" class="accordion-body collapse in">
<div class="accordion-inner" style="background-color: #ffffff;">

<form class="form-horizontal">
<fieldset>
<legend>Basic Info</legend>
<!--<div class="control-group">-->
<!--<label class="control-label">Image</label>-->
<!--<div class="controls">-->
<!--    <a href="#" class="thumbnail">-->
<!--        <img src="resource/img/default.png" alt="">-->
<!--    </a>-->
<!--</div> <br>-->
<div class="control-group">
    <label class="control-label">Name</label>
    <div class="controls">
        <input type="text" class="input-xlarge" id="nama" name="nama" value="<?php echo $baris['NAMA'];?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" >NIM</label>
    <div class="controls">
        <input type="text" class="input-xlarge" id="nim" name="nim" readonly="readonly" value="<?php echo $baris['NIM'];?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" >Majors</label>
    <div class="controls">
        <input type="text" class="input-xlarge" readonly="readonly" value="Teknik Informatika" id="jurusan" name="jurusan">
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="konsentrasi">Concentration</label>
    <div class="controls">
        <select id="konsentrasi" name="konsentrasi">
            <?php
            if ($baris['KONSENTRASI']='Jaringan Komputer'){?>
                <option>Jaringan Komputer</option>
                <option>Sistem Informasi</option>
                <option>Animasi Dan Disain</option>
                <?php }
            elseif ($baris['KONSENTRASI']='Sistem Informasi'){?>
                <option>Sistem Informasi</option>
                <option>Jaringan KOmputer</option>
                <option>Animasi Dan Disain</option>
                <?php }
            elseif($baris['KONSENTRASI']='Animasi Dan Disain'){?>
                <option>Animasi Dan Disain</option>
                <option>Jaringan KOmputer</option>
                <option>Sistem Informasi</option>
                <?php }
            ?>
        </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label">Title Of TA</label>
    <div class="controls">
        <input type="text" class="input-xlarge" id="ta" name="ta" value="<?php echo $baris['JUDUL_TA'];?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label">IPK</label>
    <div class="controls">
        <input type="text" class="input-xlarge" id="ipk" name="ipk" value="<?php echo $baris['IPK'];?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label"> Graduate of Date</label>
    <div class="controls">
        <?php
        $lulus=$baris['TGL_LULUS'];
        $cek1=substr($lulus, 5,1);
        $cek2=substr($lulus, 6,1);
        $cek3=substr($lulus, 7,1);
        $cek4=substr($lulus, 8,1);
        $cek5=substr($lulus, 9,1);
        $cek6=substr($lulus, 10,1);
        if($cek1==' '){
            $blnl=substr($lulus,3,3);}
        elseif($cek2==' '){
            $blnl=substr($lulus,3,4);}
        elseif($cek3==' '){
            $blnl=substr($lulus,3,5);}
        elseif($cek4==' '){
            $blnl=substr($lulus,3,6);}
        elseif($cek5==' '){
            $blnl=substr($lulus,3,7);}
        elseif($cek6==' '){
            $blnl=substr($lulus,3,8);}
        else
            $blnl=substr($lulus,3,9);
        ?>
        <select id="bln_lls" name="bln_lls" style="width:110px">
            <option><?php echo $blnl;?></option>
            <option>January</option>
            <option>February</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>june</option>
            <option>july</option>
            <option>August</option>
            <option>September</option>
            <option>October</option>
            <option>November</option>
            <option>December</option>
        </select>
        <?php
        $tgll=substr($lulus,0,2);
        ?>
        <select id="tgl_lls" name="tgl_lls" style="width: 70px">
            <option><?php echo $tgll;?></option>
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
        </select>
        <?php
        $thnl=substr($lulus,-4,4);
        ?>
        <select id="thn_lls" name="thn_lls" style="width: 85px">
            <option><?php echo $thnl;?></option>
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
    <label class="control-label" >Place Of Birth</label>
    <div class="controls">
        <input type="text" class="input-xlarge" name="tempat_lahir" id="tempat_lahir" value="<?php echo $baris['TEMPAT_LAHIR'];?>">
    </div>
</div>
<div class="control-group">
    <label class="control-label" >Date of Birth</label>
    <div class="controls">
        <?php
        $lahir=$baris['TGL_LAHIR'];
        $cek1=substr($lahir, 5,1);
        $cek2=substr($lahir, 6,1);
        $cek3=substr($lahir, 7,1);
        $cek4=substr($lahir, 8,1);
        $cek5=substr($lahir, 9,1);
        $cek6=substr($lahir, 10,1);
        if($cek1==' '){
            $bln=substr($lahir,3,3);}
        elseif($cek2==' '){
            $bln=substr($lahir,3,4);}
        elseif($cek3==' '){
            $bln=substr($lahir,3,5);}
        elseif($cek4==' '){
            $bln=substr($lahir,3,6);}
        elseif($cek5==' '){
            $bln=substr($lahir,3,7);}
        elseif($cek6==' '){
            $bln=substr($lahir,3,8);}
        else
            $bln=substr($lahir,3,9);
        ?>
        <select id="bulan" name="bulan" style="width:110px">
            <option><?php echo $bln;?></option>
            <option>January</option>
            <option>February</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>june</option>
            <option>july</option>
            <option>August</option>
            <option>September</option>
            <option>October</option>
            <option>November</option>
            <option>December</option>
        </select>
        <?php
        $tgl=substr($lahir,0,2);
        ?>
        <select id="tgl" name="tgl" style="width: 70px">
            <option><?php echo $tgl;?></option>
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
        </select>
        <?php
        $thn=substr($lahir,-4,4);
        ?>
        <select id="thn" name="thn" style="width: 85px">
            <option><?php echo $thn;?></option>
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
    <label class="control-label" for="kelamin">Sex</label>
<div class="controls">
<select id="kelamin" name="kelamin">
    <?php
    if ($baris['JENIS_KELAMIN']=="men"){?>
        <option>Men</option>
        <option>Women</option>
        <?php }
    else?>
        <option>Women</option>
        <option>Men</option>
        </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="agama">Religion</label>
    <div class="controls">
        <select id="agama" name="agama">
            <?php
    if ($baris['AGAMA']=="Islam"){?>
        <option>Islam</option>
        <option>Katolik</option>
        <option>Protestan</option>
        <option>Hindu</option>
        <option>Budha</option>
        <?php }
    elseif ($baris['AGAMA']=="Katolik"){?>
        <option>Katolik</option>
        <option>Islam</option>
        <option>Protestan</option>
        <option>Hindu</option>
        <option>Budha</option>
        <?php }
    elseif ($baris['AGAMA']=="Protestan"){?>
        <option>Protestan</option>
        <option>Islam</option>
        <option>Katolik</option>
        <option>Hindu</option>
        <option>Budha</option>
        <?php }
    elseif ($baris['AGAMA']=="Hindu"){?>
        <option>Hindu</option>
        <option>Islam</option>
        <option>Protestan</option>
        <option>Katolik</option>
        <option>Budha</option>
        <?php }
    else?>
        <option>Budha</option>
        <option>Islam</option>
        <option>Protestan</option>
        <option>Katolik</option>
        <option>Hindu</option>
         </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label" >Phone Number</label>
    <div class="controls">
        <input type="text" class="input-xlarge" id="telpon" name="telpon" value="<?php echo $baris['NO_TELP'];?>">
</div>
</div>
    <?php
    $id_user=$baris['ID_USER'];
    $pass_alumni = "select * from login where id_user ='$id_user'";
    $statement_pass = oci_parse($c,$pass_alumni);
    oci_execute($statement_pass);
    while($baris1 = oci_fetch_array ($statement_pass, OCI_BOTH))
    {
        ?>
    <div class="control-group">
        <label class="control-label" >Password</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-lock"></i></span>
                <input class="span2"  type="password" id="password" name="password" value="<?php echo $baris1['PASSWORD'];?>">
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" >Re-enter Password</label>
        <div class="controls">
            <input type="password" class="input-xlarge" id="repassword" name="repassword" value="<?php echo $baris1['PASSWORD'];?>"><span id="pesan2"></span>

        </div>
    </div>
    <div class="control-group">
        <label class="control-label" >Email</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input class="span2"  type="text" id="email" name="email" value="<?php echo $baris1['EMAIL'];?>"> <span id="pesan"></span>
            </div>
        </div>
    </div>
        <?php
    }
    ?>
<div class="control-group">
    <label class="control-label" for="alamat">Address</label>
    <div class="controls">
        <textarea class="input-xlarge" id="alamat" name="alamat" rows="3"><?php echo $baris['ALAMAT'];?></textarea>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="motto">Motto Of Life</label>
    <div class="controls">
        <textarea class="input-xlarge" id="motto" name="motto" rows="3"><?php echo $baris['MOTTO_HIDUP'];?></textarea>
    </div>
</div>

<a href="addpendidikan.php">Add Education</a>
<h4>List Of Education</h4>
    <?php
    // include('oraconn.php');
    $id_alumni=$_SESSION['id_alumni'];
    $al="select * from pendidikan where id_alumni='$id_alumni' order by id_pendidikan asc";
    $statement_al=oci_parse($c,$al);
    oci_execute($statement_al,OCI_DEFAULT);
    ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

    while($baris1=oci_fetch_array($statement_al,OCI_BOTH)){

        ?>
    <tr>
        <td><?php echo $baris1['NAMA_SEKOLAH'];?></td>
        <td><?php echo $baris1['ALAMAT_SEKOLAH'];?></td>
        <td><?php echo $baris1['TAHUN_MASUK'];?></td>
        <td><?php echo $baris1['TAHUN_KELUAR'];?></td>
        <td><?php echo $baris1['JENJANG'];?></td>
        <?
        $id_pendidikan = $baris1['ID_PENDIDIKAN'];
        ?>
        <td>
            <a href="proses-deletependidikan.php?id=<?=$id_pendidikan?>" class="btn btn"><i class="icon-remove"></i>Delete</a></form>
                        </td>
    </tr>
        <?php
    }
    ?>

</tbody>
</table>
<a href="addpekerjaan.php">Add Jobs</a>
<h4>List Of Jobs</h4>
    <?php
    // include('oraconn.php');
    $id_alumni=$_SESSION['id_alumni'];
    $pk="select * from pekerjaan where id_alumni='$id_alumni' order by id_pekerjaan asc";
    $statement_pk=oci_parse($c,$pk);
    oci_execute($statement_pk,OCI_DEFAULT);
    ?>
<table class="table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Departement</th>
        <th>Position</th>
        <th>Start</th>
        <th>End</th>
        <th>Address</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php

        while($baris2=oci_fetch_array($statement_pk,OCI_BOTH)){

            ?>
        <tr>
            <td><?php echo $baris2['NAMA_PERUSAHAAN'];?></td>
            <td><?php echo $baris2['BAGIAN'];?></td>
            <td><?php echo $baris2['JABATAN'];?></td>
            <td><?php echo $baris2['TAHUN_MASUK'];?></td>
            <td><?php echo $baris2['TAHUN_KELUAR'];?></td>
            <td><?php echo $baris2['ALAMAT_PERUSAHAAN'];?></td>
            <?
            $id_pekerjaan = $baris2['ID_PEKERJAAN'];
            ?>
            <td>
                <a href="proses-deletepekerjaan.php?id=<?=$id_pekerjaan?>" class="btn btn"><i class="icon-remove"></i>Delete</a></form>
            </td>
        </tr>
            <?php
        }
        ?>

    </tbody>
</table>

<div class="form-actions">
    <button type="submit" class="btn btn-primary" id="save">Save Changes</button>
<!--    <button class="btn">Cancel</button>-->
    <?
    $nama1=$baris['NAMA'];
?>
    <a href="profilad.php?namauser=<?=$nama1;?>" class="btn">Go To Profil</a>
</div>
</fieldset>
</form>
    <?php
}
?>
</div>
</div>
</div>

</div>
</div>

</div>
<footer>
    <p>&copy; Ika Kartika Sari 2012</p>
</footer>
<?
//header("Refresh: 20;");
?>
</div>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>
</html>