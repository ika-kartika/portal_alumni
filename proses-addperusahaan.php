<?php
include("oraconn.php");
if($_POST['aksi']=='checknama'){
    $nama=$_POST['nama'];

    $nama_perusahaan = "select * from perusahaan where nama_perusahaan ='$nama'";
    $statement_nama=oci_parse($c, $nama_perusahaan);
    oci_execute( $statement_nama);
    $nama_dapat= oci_fetch_all($statement_nama, $nama_dapat);
    echo $nama_dapat;
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
elseif($_POST['aksi']=='tambah'){
    $nama = $_POST['nama'];
    $bidang = $_POST['bidang'];
    $tlp = $_POST['telpon'];
    $alamat = $_POST['alamat'];
    $password1 = $_POST['password'];
    $password = md5($password1);
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    $web = $_POST['website'];
    $fax = $_POST['fax'];
    $pesan = $_POST['pesan1'];
    $id_user = "pr".$nama;
    $foto="belum upload";

    if ($pesan=='Perusahaan sudah terdaftar'){
        echo 'gagal daftar';
    }
    else {
        echo' berhasil daftar';
    }
    $insert_perusahaan="insert into perusahaan (id_perusahaan, nama_perusahaan, alamat_perusahaan, web, no_telp, no_fax, bidang, id_user,foto) values ('','$nama','$alamat','$web','$tlp','$fax','$bidang','$id_user','$foto')";
    $insert_login = "insert into login (id_user, password, email) values ('$id_user','$password','$email')";
    $statement_perusahaan = oci_parse($c, $insert_perusahaan);
    $statement_login = oci_parse($c, $insert_login);
    oci_execute($statement_perusahaan);
    oci_execute($statement_login);
}
?>