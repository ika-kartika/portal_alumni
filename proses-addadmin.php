<?php
include("oraconn.php");
if($_POST['aksi']=='checknip'){
    $nip1=$_POST['nip'];

    $nip = "select * from admin where nip='$nip1'";
    $statement_nip=oci_parse($c,$nip);
    oci_execute($statement_nip);
    $nip_dapat= oci_fetch_all($statement_nip, $nip_dapat);
    // apabila nip ditemukan, maka $ketemu bernilai 1,
    // apabila nip tidak ditemukan, maka $ketemu bernilai 0.
    echo $nip_dapat;
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
//elseif ($_POST['aksi']=='tambah'){
//    $nama = $_POST['nama'];
//    $nip = $_POST['nip'];
//    $tempat_lahir = $_POST['tempat_lahir'];
//    $bulan = $_POST['bulan'];
//    $tgl = $_POST['tgl'];
//    $thn = $_POST['thn'];
//    $kelamin = $_POST['kelamin'];
//    $agama = $_POST['agama'];
//    $tlp = $_POST['telpon'];
//    $alamat = $_POST['alamat'];
//    $lahir = $tgl." ".$bulan." ".$thn;
//    $password = $_POST['password'];
//    $email = $_POST['email'];
//    $id_user = "ad".$nip;
//    $foto = "belum upload";
//    //$insert_admin="insert into admin (id_admin, nip, nama, tempat_lahir, tgl_lahir, alamat, agama, jenis_kelamin, no_telp, foto, id_user) values ('','22','ss','ll','1 january 1999','ll','ll','ll','74574','$foto','ad22')";
//    $insert_admin="insert into admin (id_admin, nip, nama, tempat_lahir, tgl_lahir, alamat, agama, jenis_kelamin, no_telp, foto, id_user) values ('','$nip','$nama','$tempat_lahir','$lahir','$alamat','$agama','$kelamin','$tlp','$foto','$id_user')";
//    $insert_login = "insert into login (id_user, password, email) values ('$id_user','$password','$email')";
//    $statement_admin = oci_parse($c, $insert_admin);
//    $statement_login = oci_parse($c, $insert_login);
//    oci_execute($statement_admin);
//    oci_execute($statement_login);
//}

?>