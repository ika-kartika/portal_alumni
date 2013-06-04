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
//error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Alumni TF STTA</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css"/>
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script>
        $(document).ready(function(){

            $("#save").click(function(){
                // ambil value data dari form
                var nama  = $("#nama").val();
                var bidang  = $("#bidang").val();
                var telpon  = $("#telpon").val();
                var alamat  = $("#alamat").val();
                var password  = $("#password").val();
                var email  = $("#email").val();
                var website  = $("#website").val();
                var fax  = $("#fax").val();
                // kirim dengan metode POST ke proses-addperusahaan.php
                $.ajax({
                    type:"POST",
                    url:"proses-addperusahaan.php",
                    data:"aksi=tambah&nama=" + nama + "&bidang=" + bidang + "&telpon=" + telpon + "&alamat=" + alamat + "&password=" + password + "&email=" + email + "&website=" + website + "&fax=" + fax,
                    success: function(data){
                        $("#info").html(data);
                    }
                });
            });

            $("#nama").change(function(){
                $("#pesan1").html("<img src='resource/img/loader.gif' />Checking...");
                var nama=$("#nama").val();

                $.ajax({
                    type:"POST",
                    url:"proses-addperusahaan.php",
                    data:"aksi=checknama&nama="+nama,
                    success:function(data){
                        if(data==0){
                            $("#pesan1").html('<img src="resource/img/tick.png">Company Has Not Registered');
                            $("#pesan3").val('Company Has Not Registered');
                            $("#nama").css('border','3px #090 solid');
                        }
                        else{
                            $("#pesan1").html('<img src="resource/img/cross.png">Company Has Registered');
                            $("#pesan3").val('Company Has Registered');
                            $("#nama").css('border','3px #C33 solid');
                        }
                    }

                })
            })

            if ($('#index').size()) {
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
                    $("#pesan4").val('Password Match');
                    $('#repassword').css('border', '3px #090 solid');

                }
                else{
                    $("#pesan2").html('<img src="resource/img/cross.png"> Password Do Not Match');
                    $("#pesan4").val('Password Do Not Match');
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

                <h2>Add User (Perusahaan)</h2>
                <div class="accordion" id="accordionperusahaan">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a style="text-align: left;text-decoration: none" class="accordion-toggle btn btn-primary" data-toggle="collapse" data-parent="#accordion2" href="#collapseperusahaan">
                                <i class="icon-pencil"></i> Add Company <i class="icon-minus pull-right"></i>
                            </a>
                        </div>
                        <div id="collapseperusahaan" class="accordion-body collapse in">
                            <div class="accordion-inner" style="background-color: #ffffff;">
                                <form class="form-horizontal">
                                    <fieldset>
                                        <legend>Basic Info</legend>
                                <!--        <div class="control-group">
                                            <label class="control-label">Image</label>
                                            <div class="controls">
                                                <a href="#" class="thumbnail">
                                                    <img src="resource/img/default.png" alt="">
                                                </a>
                                            </div> </div>		-->
                                        <div class="control-group">
                                            <label class="control-label">Company Name</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="nama"><span id="pesan1"></span>
                                                <input type="hidden" class="input-xlarge" id="pesan3" name="pesan3">
                                                <input type="hidden" class="input-xlarge" id="pesan4" name="pesan4">

                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" >Sector</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="bidang">

                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" >Password</label>
                                            <div class="controls">
                                                <div class="input-prepend">
                                                    <span class="add-on"><i class="icon-lock"></i></span>
                                                    <input class="span2"  type="password" id="password" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" >Re-enter Password</label>
                                            <div class="controls">
                                                <input type="password" class="input-xlarge" id="repassword" ><span id="pesan2"></span>

                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" >Email</label>
                                            <div class="controls">
                                                <div class="input-prepend">
                                                    <span class="add-on"><i class="icon-envelope"></i></span>
                                                    <input class="span2"  type="text" id="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" >Website</label>
                                            <div class="controls">
                                                <div class="input-prepend">
                                                    <span class="add-on"><i class="icon-home"></i></span>
                                                    <input class="span2"  type="text" id="website">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" >Phone Number</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="telpon">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" >Fax Number</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="fax" >

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