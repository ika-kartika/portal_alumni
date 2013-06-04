<?
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
$id = $_SESSION['id'];
include('oraconn.php');
$name = "select * from alumni where id_user='$id'";
$statement=oci_parse($c,$name);
oci_execute($statement);
while($barisnama = oci_fetch_array ($statement, OCI_BOTH))
{
    $namauser=$barisnama['NAMA'];
   // $id_user=$id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title >Edit Account</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script>
    $(document).ready(function(){
        var loading = $("#loading");
        var tampilkan = $("#tampilkan");

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
                        $("#pesan").html('<img src="resource/img/tick.png"> ok,,,');
                        $('#email').css('border', '3px #090 solid');
                    }
                    else{
                        $("#pesan").html('<img src="resource/img/cross.png"> email already exists');
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


        $("#jenjang").change(function(){
            // tampilkan animasi loading saat pengecekan ke database
            $('#pesan3').html("<img src='resource/img/loader.gif' /> checking ...");
            var jenjang  = $("#jenjang").val();

            $.ajax({
                type:"POST",
                url:"proses-checkjenjang.php",
                data: "aksi=checkjenjangal&jenjang=" + jenjang,
                success: function(data){
                    if(data==0){
                        $("#pesan3").html('<img src="resource/img/tick.png">Ok,,Jenjang Has Not Registered');
                        $('#jenjang').css('border', '3px #090 solid');
                    }
                    else{
                        $("#pesan3").html('<img src="resource/img/cross.png">Jenjang Has Registered');
                        $('#jenjang').css('border', '3px #C33 solid');
                    }
                }
            });
        })
        $("#tahun_keluar").change(function(){
            // tampilkan animasi loading saat pengecekan ke database
            $('#pesan1').html("<img src='resource/img/loader.gif' /> checking ...");
            var tahun_keluar  = $("#tahun_keluar").val();
            var tahun_masuk =$("#tahun_masuk").val();

            if (tahun_keluar > tahun_masuk){
                $("#pesan1").html('<img src="resource/img/tick.png">ok,,,');
                $('#tahun_keluar').css('border', '3px #090 solid');

            }
            else{
                $("#pesan1").html('<img src="resource/img/cross.png"> Wrong Year,,');
                $('#tahun_keluar').css('border', '3px #C33 solid');
            }
        })




        $("#nama_perusahaan").change(function(){
            // tampilkan animasi loading saat pengecekan ke database
            $('#pesan4').html("<img src='resource/img/loader.gif' /> checking ...");
            var nama_perusahaan  = $("#nama_perusahaan").val();

            $.ajax({
                type:"POST",
                url:"proses-checkjenjang.php",
                data: "aksi=checknamaperusahaan&nama_perusahaan=" +nama_perusahaan,
                success: function(data){
                    if(data==0){
                        $("#pesan4").html('<img src="resource/img/tick.png">Ok,,Jenjang Has Not Registered');
                        $('#nama_perusahaan').css('border', '3px #090 solid');
                    }
                    else{
                        $("#pesan4").html('<img src="resource/img/cross.png">Job Has Registered');
                        $('#nama_perusahaan').css('border', '3px #C33 solid');
                    }
                }
            });
        })
        $("#keluar_kerja").change(function(){
            // tampilkan animasi loading saat pengecekan ke database
            $('#pesan5').html("<img src='resource/img/loader.gif' /> checking ...");
            var keluar_kerja  = $("#keluar_kerja").val();
            var masuk_kerja =$("#masuk_kerja").val();

            if (keluar_kerja > masuk_kerja){
                $("#pesan5").html('<img src="resource/img/tick.png">ok,,,');
                $('#keluar_kerja').css('border', '3px #090 solid');

            }
            else{
                $("#pesan5").html('<img src="resource/img/cross.png">Wrong Year,,');
                $('#keluar_kerja').css('border', '3px #C33 solid');
            }
        })



    });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <?
include('navbaralumni.php');

    include('oraconn.php');
    $data_alumni="select * from alumni where id_user='$id'";
    $statement_alumni=oci_parse($c,$data_alumni);
    oci_execute($statement_alumni);
    while($baris = oci_fetch_array ($statement_alumni, OCI_BOTH))

{
    $nama = $baris['NAMA'];
    $ipk = $baris['IPK'];
    $jurusan = $baris['JURUSAN'];
    $konsentrasi = $baris['KONSENTRASI'];
    $nim = $baris['NIM'];
    $alamat = $baris['ALAMAT'];
    $agama = $baris['AGAMA'];
    $jenis_kelamin = $baris['JENIS_KELAMIN'];
    $ta = $baris['JUDUL_TA'];
    $tlp = $baris['NO_TELP'];
    $motto = $baris['MOTTO_HIDUP'];
    $id_alumni = $baris['ID_ALUMNI'];
    $tmp_lahir = $baris['TEMPAT_LAHIR'];
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
       $tgll=substr($lulus,0,2);
        $thnl=substr($lulus,-4,4);
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
        $tgl=substr($lahir,0,2);
        $thn=substr($lahir,-4,4);
}
    $pass_alumni = "select * from login where id_user ='$id'";
    $statement_pass = oci_parse($c,$pass_alumni);
    oci_execute($statement_pass);
    while($baris1 = oci_fetch_array ($statement_pass, OCI_BOTH))
{
    $email = $baris1['EMAIL'];
    $pass = $baris1['PASSWORD'];
}
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
		$query_foto = "select foto from alumni where id_user = '$id'";
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
        <!--            <li><a href="#" class="thumbnail"><img src="resource/img/default.png" alt=""></a></li><br>		-->
                    <li><a href="homealumni.php"><i class="icon-file"></i> News Feed</a></li>
                    <li><a href="profiluser.php?namauser=<?=$nama;?>"><i class="icon-user"></i> Profile</a></li>
                    <li><a href="infouser.php?namauser=<?=$nama;?>"><i class="icon-list-alt"></i> Info</a></li>
                    <li><a href="cariuser.php"><i class="icon-search"></i> Search</a></li>
                </ul>
            </div>
        </div>
        <div class="span8 well">
        <div class="accordion" id="accordionalumni">
        <div class="accordion-group">
        <div class="accordion-heading">
            <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapsealumni">
                <i class="icon-pencil"></i> Info Alumni <i class="icon-minus pull-right"></i>
            </a>
        </div>
        <div id="collapsealumni" class="accordion-body collapse in">
        <div class="accordion-inner" style="background-color: #ffffff;">

        <form class="form-horizontal" method="post" action="proses-editalumni.php">
        <fieldset>
        <legend>Basic Info</legend>
        <div class="control-group">
        <label class="control-label">Image</label>
        <div class="controls">
            <a href="#" class="thumbnail">
<!-- ambil foto -->
<?
		$username = $_SESSION['username'];
		$query_foto = "select foto from alumni where id_user = '$id'";
		//echo "</br>",$query_foto,"</br>";
		$stat_foto = oci_parse($c, $query_foto);
		oci_execute($stat_foto);
		$foto = oci_fetch_array ($stat_foto, OCI_BOTH);
		if($foto[0] == "belum upload")
		{
			echo    "<img src='resource/img/default.png' alt=''>";
			//echo 	"</br>",$foto[0],"</br>";
		}
		else
		{
			echo 	"<img src='photo/",$foto[0],"' alt=''>";
			//echo 	"</br>sudah upload</br>";
		}		
?>
    <!--            <img src="resource/img/default.png" alt="">		-->
            </a>
        </div> </div>
        <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <input type="text" class="input-xlarge" id="nama" name="nama" value="<?echo $nama;?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" >NIM</label>
            <div class="controls">
                <input type="text" class="input-xlarge" id="nim" name="nim" value="<?echo $nim;?>" readonly="readonly"><span id="pesan12"></span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" >Majors</label>
            <div class="controls">
                <input type="text" class="input-xlarge" name="jurusan" readonly="readonly" id="jurusan" value="<?echo $jurusan;?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="konsentrasi">Concentration</label>
            <div class="controls">
                <select id="konsentrasi" name="konsentrasi">
                    <option><? echo $konsentrasi; ?></option>
                    <option>Computer Networking</option>
                    <option>Information System</option>
                    <option>Design And Animation</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Title Of TA</label>
            <div class="controls">
                <input type="text" class="input-xlarge" id="ta" name="ta" value="<?echo $ta?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">IPK</label>
            <div class="controls">
                <input type="text" class="input-xlarge" id="ipk" name="ipk" value="<?echo $ipk?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"> Graduate of Date</label>
            <div class="controls">
                <select id="bln_lls" name="bln_lls" style="width:110px">
                    <option><?echo $blnl; ?></option>
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
                <select id="tgl_lls" name="tgl_lls" style="width: 70px">
                    <option><?echo $tgll; ?></option>
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
                <select id="thn_lls" name="thn_lls" style="width: 85px">
                    <option><?echo $thnl; ?></option>
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
                <input type="text" class="input-xlarge" id="tempat_lahir" name="tempat_lahir" value="<?echo $tmp_lahir?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" >Date of Birth</label>
            <div class="controls">
                <select id="bulan" name="bulan" style="width:110px">
                    <option><?echo $bln; ?></option>
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
                <select id="tgl" name="tgl" style="width: 70px">
                    <option><?echo $tgl; ?></option>
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
                <select id="thn" name="thn" style="width: 85px">
                    <option><?echo $thn; ?></option>
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
                    <option><?echo $jenis_kelamin; ?></option>
                    <option>Men</option>
                    <option>Women</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="agama">Religion</label>
            <div class="controls">
                <select id="agama" name="agama">
                    <option><?echo $agama; ?></option>
                    <option>Islam</option>
                    <option>Katolik</option>
                    <option>Protestan</option>
                    <option>Hindu</option>
                    <option>Budha</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" >Phone Number</label>
            <div class="controls">
                <input type="text" class="input-xlarge" id="telpon" name="telpon" value="<?echo $tlp;?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" >Password</label>
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-lock"></i></span>
                    <input class="span2"  type="password" id="password" name="password" value='''>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" >Re-enter Password</label>
            <div class="controls">
                <input type="password" class="input-xlarge" id="repassword" name="repassword" value=''><span id="pesan2"></span>

            </div>
        </div>
        <div class="control-group">
            <label class="control-label" >Email</label>
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-envelope"></i></span>
                    <input class="span2"  type="text" id="email" name="email" value="<?echo $email;?>"> <span id="pesan"></span>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="alamat">Address</label>
            <div class="controls">
                <textarea class="input-xlarge" id="alamat" name="alamat" rows="3" ><?echo $alamat;?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="motto">Motto Of Life</label>
            <div class="controls">
                <textarea class="input-xlarge" id="motto" name="motto" rows="3"><?echo $motto;?></textarea>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="save">Save</button>
            <button class="btn" data-dismiss="modal">Cancel</button>
        </div>
        </fieldset>
        </form>
<!--        </div>-->
        <div id="myModal" class="modal hide fade">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">x</button>
                <h3>Add Education</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="proses-addpendidikanalumni.php">
                    <fieldset>
                        <!--                <legend>Education</legend>-->
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
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select><span id="pesan3"></span>
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
                                </select><span id="pesan1"></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Address</label>
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
        <a data-toggle="modal" href="#myModal">Add Education</a>

<?
        $al="select * from pendidikan where id_alumni='$id_alumni' order by id_pendidikan asc";
        $statement_al=oci_parse($c,$al);
        oci_execute($statement_al,OCI_DEFAULT);
        ?>
        <h4>List Of Education</h4>




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
            $nama = $baris1['NAMA_SEKOLAH'];
            $alamat = $baris1['ALAMAT_SEKOLAH'];
            $msk = $baris1['TAHUN_MASUK'];
            $klr = $baris1['TAHUN_KELUAR'];
            $level = $baris1['JENJANG'];
            $id_pendidikan = $baris1['ID_PENDIDIKAN'];

            ?>
        <tr>
            <td><?php echo $nama;?></td>
            <td><?php echo $alamat;?></td>
            <td><?php echo $msk;?></td>
            <td><?php echo $klr;?></td>
            <td><?php echo $level;?></td>

            <td>
                <a href="proses-deletepnddkn.php?id=<?=$id_pendidikan?>" class="btn btn"><i class="icon-remove"></i>Delete</a></form>
            </td>

        </tr>
            <?php
        }
        ?>
        </tbody>
        </table>


        <div id="loading"></div>
        <div id="tampilkan"></div>


        <div id="myModal1" class="modal hide fade">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">x</button>
                <h3>Add Jobs</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="proses-addpekerjaanalumni.php">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" >Name Of Company</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="nama_perusahaan" name="nama_perusahaan"><span id="pesan4"></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Departement</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="bagian" name="bagian">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" >Position</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="jabatan" name="jabatan">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="masuk_kerja">Start</label>
                            <div class="controls">
                                <select id="masuk_kerja" name="masuk_kerja">
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
                            <label class="control-label" for="keluar_kerja">End</label>
                            <div class="controls">
                                <select id="keluar_kerja" name="keluar_kerja">
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
                                </select><span id="pesan5"></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="alamat_perusahaan">Address</label>
                            <div class="controls">
                                <textarea class="input-xlarge" rows="3" id="alamat_perusahaan" name="alamat_perusahaan"></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" id="add_pekerjaan">Add</button>
                            <button class="btn" data-dismiss="modal">Cancel</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <a data-toggle="modal" href="#myModal1">Add Jobs</a>
        <h4>List Of Jobs</h4>
        <?php
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
                    <a href="proses-deletepkrjaan.php?id=<?=$id_pekerjaan?>" class="btn btn"><i class="icon-remove"></i>Delete</a>
                </td>
            </tr>
                <?php
            }
            ?>

            </tbody>
        </table>

        <div id="loading"></div>
        <div id="munculkan"></div>


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