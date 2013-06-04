<?php
include("oraconn.php");
if($_POST['aksi']=='ubah'){
    $nama=$_POST['nama'];
    $bidang=$_POST['bidang'];
    $tlp=$_POST['telpon'];
    $almt=$_POST['alamat'];
    $password1 = $_POST['password'];
    $password = md5($password1);
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    $web=$_POST['website'];
    $fax=$_POST['fax'];
    $id_user="pr".$nama;
//    $foto="belum bisa";

if($password1==''){
$edit_perusahaan= "update perusahaan set bidang='$bidang',web='$web',no_fax='$fax',alamat_perusahaan='$almt',no_telp='$tlp' where nama_perusahaan='$nama'";
    $edit_login= "update login set email='$email' where  id_user='$id_user'";
    $statement_perusahaan=oci_parse($c,$edit_perusahaan);
    $statement_login=oci_parse($c,$edit_login);
    oci_execute($statement_perusahaan);
    oci_execute($statement_login);
}
else{
    $edit_perusahaan= "update perusahaan set bidang='$bidang',web='$web',no_fax='$fax',alamat_perusahaan='$almt',no_telp='$tlp' where nama_perusahaan='$nama'";
    $edit_login= "update login set email='$email',password='$password' where  id_user='$id_user'";
    $statement_perusahaan=oci_parse($c,$edit_perusahaan);
    $statement_login=oci_parse($c,$edit_login);
    oci_execute($statement_perusahaan);
    oci_execute($statement_login);
    //header('Location:paneladmin.php');
}
}


?>
