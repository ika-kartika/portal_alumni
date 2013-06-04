<?php
//include_once 'db.php';
include('oraconn.php');
if(isSet($_POST['id_kom'])){
  $id_kom=$_POST['id_kom'];
  //$qryhapus = mysql_query("DELETE FROM komentar WHERE id_kom='$id_kom'");
$hapuskomen="delete from komen where id_komen='$id_kom'";
$statementhapuskom=oci_parse($c,$hapuskomen);
oci_execute($statementhapuskom);
  }
?>
