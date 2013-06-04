<?php
include('oraconn.php');

$nip=$_GET['nip'];
$id_useradmin="select * from admin where nip='$nip'";
$statement_id=oci_parse($c,$id_useradmin);
oci_execute($statement_id);
while ($baris=oci_fetch_array($statement_id,OCI_BOTH)){
    $id_user= $baris['ID_USER'];
    // echo $id_user;
}
$delete_login="delete from login where id_user='$id_user'";
$statement_login=oci_parse($c,$delete_login);
oci_execute($statement_login);

$delete_admin="delete from admin where nip='$nip'";
$statement_admin=oci_parse($c,$delete_admin);
oci_execute($statement_admin);
header('Location:paneladmin.php')
?>