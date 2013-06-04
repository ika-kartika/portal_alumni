<?php
//include 'db.php';
include('oraconn.php');
if(isSet($_POST['id_status'])){
  $id_status=$_POST['id_status'];
  //$query = mysql_query("DELETE FROM `status` WHERE id_status='$id_status'");
  $hapuskomen1="delete from komen where id_status='$id_status'";
$hapusstatus="delete from status where id_status='$id_status'";


$statementhapuskom1=oci_parse($c,$hapuskomen1);
$statementhapussta=oci_parse($c,$hapusstatus);

oci_execute($statementhapuskom1);
oci_execute($statementhapussta);


  }
?>
