<?php
include('oraconn.php');

$id_pekerjaan=$_GET['id'];
//echo $id_pendidikan;
$delete_pekerjaan="delete from pekerjaan where id_pekerjaan='$id_pekerjaan'";
$statement_pekerjaan=oci_parse($c,$delete_pekerjaan);
oci_execute($statement_pekerjaan);

header('Location:editinfoalumni.php');
?>