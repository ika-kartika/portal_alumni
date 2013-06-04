<?
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
$id = $_SESSION['id'];
include('oraconn.php');
$namauser=$_GET['namauser'];
$query_id="select*from alumni where nama='$namauser'";
$statement4=oci_parse($c,$query_id);
oci_execute($statement4);
$barisalumni=oci_fetch_array($statement4,OCI_BOTH);
if($barisalumni!=0){
    include('tengahalumni.php');
}
else{
    $query_ida="select * from admin where nama='$namauser'";
    $statement5=oci_parse($c,$query_ida);
    oci_execute($statement5);
    $barisadmin=oci_fetch_array($statement5,OCI_BOTH);
    if($barisadmin!=0){
        include('tengahadmin.php');
    }
    else{
        $query_idp="select * from perusahaan where nama_perusahaan='$namauser'";
        $statement6=oci_parse($c,$query_idp);
        oci_execute($statement6);
        $barisperusahaan=oci_fetch_array($statement6,OCI_BOTH);
        if($barisperusahaan!=0){
            include('tengahperusahaan.php');
        }
    }
}
?>
