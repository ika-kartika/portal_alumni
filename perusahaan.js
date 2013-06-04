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
            url:"proses-editperusahaan.php",
            data:"aksi=ubah&nama=" + nama + "&bidang=" + bidang + "&telpon=" + telpon + "&alamat=" + alamat + "&password=" + password + "&email=" + email + "&website=" + website + "&fax=" + fax,
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
                    $("#pesan1").html('<img src="resource/img/tick.png">Perusahaan belum terdaftar');
                    $("#nama").css('border','3px #090 solid');
                }
                else{
                    $("#pesan1").html('<img src="resource/img/cross.png">Perusahaan sudah terdaftar');
                    $("#nama").css('border','3px #C33 solid');
                }
            }

        })
    })

    $("#email").change(function(){
        // tampilkan animasi loading saat pengecekan ke database
        $('#pesan').html("<img src='resource/img/loader.gif' /> checking ...");
        var email  = $("#email").val();

        $.ajax({
            type:"POST",
            url:"proses-addperusahaan.php",
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
            $('#repassword').css('border', '3px #090 solid');

        }
        else{
            $("#pesan2").html('<img src="resource/img/cross.png"> Password Do Not Match');
            $('#repassword').css('border', '3px #C33 solid');
        }
    })

});
