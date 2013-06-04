<?php
include('oraconn.php');

$nim=$_POST['nim'];
echo $nim;
$nama=$_POST['nama'];
$id_useralumni="select * from alumni where nim='$nim'and nama='$nama'";
$statement_id=oci_parse($c,$id_useralumni);
oci_execute($statement_id);
while ($baris=oci_fetch_array($statement_id,OCI_BOTH)){
    $id_user= $baris['ID_USER'];
    $id_alumni=$baris['ID_ALUMNI'];
   // echo $id_user;
}
$delete_login="delete from login where id_user='$id_user'";
$statement_login=oci_parse($c,$delete_login);
oci_execute($statement_login);

$delete_alumni="delete from alumni where id_alumni='$id_alumni'";
$statement_alumni=oci_parse($c,$delete_alumni);
oci_execute($statement_alumni);

$delete_pendidikan="delete from pendidikan where id_alumni='$id_alumni'";
$statement_pendidikan=oci_parse($c,$delete_pendidikan);
oci_execute($statement_pendidikan);

$delete_pekerjaan="delete from pekerjaan where id_alumni='$id_alumni'";
$statement_pekerjaan=oci_parse($c,$delete_pekerjaan);
oci_execute($statement_pekerjaan);
header('Location:paneladmin.php')
?>