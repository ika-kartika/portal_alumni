<?php
include('oraconn.php');

$nama=$_GET['nama'];
$id_userperusahaan="select * from perusahaan where nama_perusahaan='$nama'";
$statement_id=oci_parse($c,$id_userperusahaan);
oci_execute($statement_id);
while ($baris=oci_fetch_array($statement_id,OCI_BOTH)){
    $id_user= $baris['ID_USER'];
    //echo $id_user;
}
$delete_login="delete from login where id_user='$id_user'";
$statement_login=oci_parse($c,$delete_login);
oci_execute($statement_login);
$delete_perusahaan="delete from perusahaan where nama_perusahaan='$nama'";
$statement_perusahaan=oci_parse($c,$delete_perusahaan);
oci_execute($statement_perusahaan);

header('Location:paneladmin.php')
?>