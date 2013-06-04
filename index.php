<?php

    //mulai session
    session_start();

    //cek apakah user masih aktif login
    if(isset($_SESSION['username']))
    {
        $y = $_SESSION['hak_akses'];
        switch($y)
        {
            case 'ad':
                header('Location:homeadmin.php');
                break;

            case 'al':
                header('Location:homealumni.php');
                break;

            case 'pr':
                header('Location:homeperusahaan.php');
                break;
        }
    }

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

//            $("#save").click(function(){
//                // ambil value data dari form
//                var nama  = $("#nama").val();
//                var bidang  = $("#bidang").val();
//                var telpon  = $("#telpon").val();
//                var alamat  = $("#alamat").val();
//                var password  = $("#password").val();
//                var email  = $("#email").val();
//                var website  = $("#website").val();
//                var fax  = $("#fax").val();
//                var pesan1= $("#pesan1").val();
//                // kirim dengan metode POST ke proses-addperusahaan.php
//                $.ajax({
//                    type:"POST",
//                    url:"proses-addperusahaan.php",
//                    data:"aksi=tambah&nama=" + nama + "&bidang=" + bidang + "&telpon=" + telpon + "&alamat=" + alamat + "&password=" + password + "&email=" + email + "&website=" + website + "&fax=" + fax+ "&pesan1=" + pesan1,
//                    success: function(data){
//                        $("#info").html(data);
//                    }
//                });
//            });

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
<body background="resource/img/bg2.jpg">
<div class="container-fluid">
    <div class="row">
        <div class="navbar navbar-fixed-top">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="#">Alumni TF STTA</a>

                            <ul class="nav pull-right">
                                <form class="form-inline" method="post" action="login.php">
                                    <input class='span2' type='email'  name='email' style="margin-top: 10px"  placeholder='email address'>
                                    <input class='span2' type='password' name='password' style="margin-top: 10px" placeholder='password'>
                                    <button type="submit" class="btn" style="margin-top: 10px">Sign in</button>
                                </form>
                            </ul>
                        </div><!-- /.nav-collapse -->
                    </div>
                </div><!-- /navbar-inner -->
            </div>
        </div>
    <div class="row">
        <div class="span7" style="margin-top: 150px;margin-left: 100px">
            <font color="#25587E" face="times new roman"><h2>WELCOME TO PORTAL ALUMNI TF STTA.</h2><br>
            <h3>You Can Find Friends And job Information.<br>Enjoy With Us.<br>Informatics Engineering of Sekolah Tinggi Teknologi Adisudjipto.</h3></font>
        </div>
        <div class="span5">
            <form class="form-horizontal" method="post" action="proses-tambahperusahaan.php">
                <fieldset>
                    <legend>Registration (just for company)</legend>
                    <div class="control-group">
                        <label class="control-label">Company Name</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="nama" name="nama"><span id="pesan1"></span>
                            <input type="hidden" class="input-xlarge" id="pesan3" name="pesan3">
                            <input type="hidden" class="input-xlarge" id="pesan4" name="pesan4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" >Sector</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="bidang" name="bidang">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" >Password</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-lock"></i></span>
                                <input class="span2"  type="password" id="password" name="password" >
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" >Re-enter Password</label>
                        <div class="controls">
                            <input type="password" class="input-xlarge" id="repassword" name="repassword"><span id="pesan2"></span>

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" >Email</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope"></i></span>
                                <input class="span2"  type="text" id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" >Website</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-home"></i></span>
                                <input class="span2"  type="text" id="website" name="website">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" >Phone Number</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="telpon" name="telpon">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" >Fax Number</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="fax" name="fax" >

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="alamat">Address</label>
                        <div class="controls">
                            <textarea class="input-xlarge" id="alamat" rows="3" name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" id="save">Sign Up</button>
                        <button class="btn">Cancel</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; Ika Kartika Sari 2012</p>
    </footer>

    </div>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>
</html>