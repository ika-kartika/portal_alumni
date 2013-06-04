<?php
include("oraconn.php");
if($_POST['aksi']=='checknim'){
    $nim1=$_POST['nim'];

    $nim = "select * from alumni where nim='$nim1'";
    $statement_nim=oci_parse($c,$nim);
    oci_execute($statement_nim);
    $nim_dapat= oci_fetch_all($statement_nim, $nim_dapat);
    // apabila nim ditemukan, maka $ketemu bernilai 1,
    // apabila nim tidak ditemukan, maka $ketemu bernilai 0.
    echo $nim_dapat;
}
elseif($_POST['aksi']=='checkemail'){
    $email1=$_POST['email'];
    $email = "select * from login where email='$email1'";
    $statement_email=oci_parse($c,$email);
    oci_execute($statement_email);
    $email_dapat= oci_fetch_all($statement_email, $email_dapat);
    // apabila email ditemukan, maka $ketemu bernilai 1,
    // apabila email tidak ditemukan, maka $ketemu bernilai 0.
    echo $email_dapat;
}
elseif ($_POST['aksi']=='tambah'){
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $konsentrasi = $_POST['konsentrasi'];
    //$angkatan = $_POST['angkatan'];
   // $lulusan = $_POST['lulus'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $bulan = $_POST['bulan'];
    $tgl = $_POST['tgl'];
    $thn = $_POST['thn'];
    $kelamin = $_POST['kelamin'];
    $agama = $_POST['agama'];
    $tlp = $_POST['telpon'];
    $alamat = $_POST['alamat'];
    $motto = $_POST['motto'];
    $ipk = $_POST['ipk'];
    $ta = $_POST['ta'];
    $tgll = $_POST['tgl_lls'];
    $blnl = $_POST['bln_lls'];
    $thnl = $_POST['thn_lls'];
    $lahir = $tgl." ".$bulan." ".$thn;
    $lulus = $tgll." ".$blnl." ".$thnl;
    $password1 = $_POST['password'];
    $password = md5($password1);
    $dua = substr($nim, 0, 2);
    $angkatan = "20".$dua;
//    //    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    $id_user = "al".$nim;
   $foto = "belum upload";
   // $insert_alumni = "insert into alumni (id_alumni, nim, nama, angkatan, lulus, tempat_lahir, tgl_lahir, alamat, agama, jenis_kelamin, no_telp, jurusan, konsentrasi, foto, motto_hidup, id_user) values ('','$nim','$nama',$angkatan,$lulusan,'$tempat_lahir','$lahir','$alamat','$agama','$kelamin','$no_telp','$jurusan','$konsentrasi','$foto', '$motto','$id_user')";
   $insert_alumni="insert into alumni (id_alumni, nim, nama, ipk, tgl_lulus, tempat_lahir, tgl_lahir, alamat, agama, jenis_kelamin, no_telp, jurusan, konsentrasi, foto, motto_hidup, id_user,judul_ta,angkatan,thn_lulus) values ('','$nim','$nama','$ipk','$lulus','$tempat_lahir','$lahir','$alamat','$agama','$kelamin','$tlp','$jurusan','$konsentrasi','$foto', '$motto','$id_user','$ta','$angkatan','$thnl')";
   $query_insert_login = "insert into login (id_user, password, email) values ('$id_user','$password','$email')";
   $statement_alumni = oci_parse($c, $insert_alumni);
   $statement_login = oci_parse($c, $query_insert_login);
   oci_execute($statement_alumni);
   oci_execute($statement_login);
   header('Location : addalumni.php');
}

?>