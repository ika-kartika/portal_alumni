<?php
include('oraconn.php');
$q = strtolower($_GET["q"]);
if (!$q) return;
$query_namaper = "select * from perusahaan where nama_perusahaan LIKE '%$q%'";
$statement_namaper=oci_parse($c,$query_namaper);
oci_execute($statement_namaper);
$namaper=oci_fetch_array($statement_namaper,OCI_BOTH);
if($namaper!=0){
    while($baris_namaper=oci_fetch_array($statement_namaper,OCI_BOTH)){

        echo"$baris_namaper[1] \n";
    }

}
else{
    $query_bidang = "select * from perusahaan where bidang LIKE '%$q%'";
    $statement_bidang=oci_parse($c,$query_bidang);
    oci_execute($statement_bidang);
    $bidang=oci_fetch_array($statement_bidang,OCI_BOTH);
    if($bidang!=0){
        while($baris_bidang=oci_fetch_array($statement_bidang,OCI_BOTH)){

            echo"$baris_bidang[6] \n";
        }

    }
}
?>