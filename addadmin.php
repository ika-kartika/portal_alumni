<?
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
$id = $_SESSION['id'];
include('oraconn.php');
    $data="select * from admin where id_user='$id'";
    $statement=oci_parse($c,$data);
    oci_execute($statement);
while($baris = oci_fetch_array ($statement, OCI_BOTH))

{
 $namauser = $baris['NAMA'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Add User (Admin)
    </title>
    <link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="Password_Strength.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script>
        $(document).ready(function(){

//            $("#save").click(function(){
//                // ambil value data dari form
//                var nama  = $("#nama").val();
//                var nip  = $("#nip").val();
//                var tempat_lahir  = $("#tempat_lahir").val();
//                var bulan  = $("#bulan").val();
//                var tgl  = $("#tgl").val();
//                var thn  = $("#thn").val();
//                var kelamin  = $("#kelamin").val();
//                var agama  = $("#agama").val();
//                var telpon  = $("#telpon").val();
//                var alamat  = $("#alamat").val();
//                var password  = $("#password").val();
//                var email  = $("#email").val();
//                // kirim dengan metode POST ke proses.php
//                $.ajax({
//                    type:"POST",
//                    url:"proses-addadmin.php",
//                    data:"aksi=tambah&nama=" + nama + "&nip=" + nip + "&tempat_lahir=" + tempat_lahir + "&bulan=" + bulan + "&tgl=" + tgl + "&thn=" + thn + "&kelamin=" + kelamin + "&agama=" + agama + "&telpon=" + telpon + "&alamat=" + alamat + "&password=" + password + "&email=" + email,
//                    success: function(data){
//                        $("#info").html(data);
//                    }
//                });
//            });

            $("#nip").change(function(){
                // tampilkan animasi loading saat pengecekan ke database
                $('#pesan1').html("<img src='resource/img/loader.gif' /> checking ...");
                var nip  = $("#nip").val();

                $.ajax({
                    type:"POST",
                    url:"proses-addadmin.php",
                    data: "aksi=checknip&nip=" + nip,
                    success: function(data){
                        if(data==0){
                            $("#pesan1").html('<img src="resource/img/tick.png">Ok,,NIP Has Not Registered.');
                            $("#pesan3").val('Ok,,NIP Has Not Registered.');
                            $('#nip').css('border', '3px #090 solid');
                        }
                        else{
                            $("#pesan1").html('<img src="resource/img/cross.png">NIP already exists..!');
                            $("#pesan3").val('NIP already exists..!');
                            $('#nip').css('border', '3px #C33 solid');
                        }
                    }
                });
            })

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
                            $("#pesan").html('<img src="resource/img/tick.png">Ok,,email Has Not Registered.');
                            $("#pesan4").val('Ok,,email Has Not Registered.');
                            $('#email').css('border', '3px #090 solid');
                        }
                        else{
                            $("#pesan").html('<img src="resource/img/cross.png">email already exists..!');
                            $("#pesan4").val('email already exists..!');
                            $('#email').css('border', '3px #C33 solid');
                        }
                    }
                });
            })

            if ($('#add_alumni').size()) {
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
                    $("#pesan2").html('<img src="resource/img/tick.png">Password Match');
                    $("#pesan5").val('Password Match');
                    $('#repassword').css('border', '3px #090 solid');

                }
                else{
                    $("#pesan2").html('<img src="resource/img/cross.png">Password Do Not Match');
                    $("#pesan5").val('Password Do Not Match');
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
<h2>Add User (Admin)</h2>
<div class="accordion" id="accordionalumni">
<div class="accordion-group">
<div class="accordion-heading">
    <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapsealumni">
        <i class="icon-pencil"></i> Add Admin <i class="icon-minus pull-right"></i>
    </a>
</div>
<div id="collapsealumni" class="accordion-body collapse in">
<div class="accordion-inner" style="background-color: #ffffff;">

<form class="form-horizontal" method="post" action="proses-tambahadmin.php">
<fieldset>
<legend>Basic Info</legend>
<div class="control-group">
    <label class="control-label">Name</label>
    <div class="controls">
        <input type="text" class="input-xlarge" id="nama" name="nama">
    </div>
</div>
<div class="control-group">
    <label class="control-label" >NIP</label>
    <div class="controls">
        <input type="text" class="input-xlarge" id="nip" name="nip"><span id="pesan1"></span>
        <input type="hidden" class="input-xlarge" id="pesan3" name="pesan3">
    </div>
</div>
<div class="control-group">
    <label class="control-label" >Place Of Birth</label>
    <div class="controls">
        <input type="text" class="input-xlarge" id="tempat_lahir" name="tempat_lahir">
    </div>
</div>
<div class="control-group">
    <label class="control-label" >Date of Birth</label>
    <div class="controls">
        <select id="bulan" name="bulan" style="width:110px">
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
            <option>Men</option>
            <option>Women</option>
        </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="agama">Religion</label>
    <div class="controls">
        <select id="agama" name="agama">
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
        <input type="text" class="input-xlarge" id="telpon" name="telpon">
    </div>
</div>
<div class="control-group">
    <label class="control-label" >Password</label>
    <div class="controls">
        <div class="input-prepend">
            <span class="add-on"><i class="icon-lock"></i></span>
            <input class="span2"  type="password" id="password" name="password">
        </div>
    </div>
</div>
<div class="control-group">
    <label class="control-label" >Re-enter Password</label>
    <div class="controls">
        <input type="password" class="input-xlarge" id="repassword" name="repassword"><span id="pesan2"></span>
        <input type="hidden" class="input-xlarge" id="pesan5" name="pesan5">

    </div>
</div>
<div class="control-group">
    <label class="control-label" >Email</label>
    <div class="controls">
        <div class="input-prepend">
            <span class="add-on"><i class="icon-envelope"></i></span>
            <input class="span2"  type="text" id="email" name="email"> <span id="pesan"></span>
            <input type="hidden" class="input-xlarge" id="pesan4" name="pesan4">
        </div>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="alamat">Address</label>
    <div class="controls">
        <textarea class="input-xlarge" id="alamat" rows="3" name="alamat"></textarea>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary" id="save">Save</button>
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