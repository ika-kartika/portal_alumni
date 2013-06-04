<?
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
$id = $_SESSION['id'];
include('oraconn.php');
$tahun= $_POST['tahun'];
$insert = "insert into tahun (tahun) values ('$tahun')";
$statement = oci_parse($c, $insert);
oci_execute($statement);
