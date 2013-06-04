<?php
include('oraconn.php');
$q = strtolower($_GET["q"]);
if (!$q) return;
    $query_nama = "select * from alumni where nama LIKE '%$q%'";
    $statement_nama=oci_parse($c,$query_nama);
    oci_execute($statement_nama);
    $nama=oci_fetch_array($statement_nama,OCI_BOTH);
    if($nama!=0){
        while($baris_nama=oci_fetch_array($statement_nama,OCI_BOTH)){

            echo"$baris_nama[2] \n";
        }
}
?>