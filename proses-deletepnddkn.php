<?php
include('oraconn.php');

$id_pendidikan=$_GET['id'];
$delete_pendidikan="delete from pendidikan where id_pendidikan='$id_pendidikan'";
$statement_pendidikan=oci_parse($c,$delete_pendidikan);
oci_execute($statement_pendidikan);

header('Location:editinfoalumni.php');
?>