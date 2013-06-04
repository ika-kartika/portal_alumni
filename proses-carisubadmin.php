<?php
    include('oraconn.php');
    $q = strtolower($_GET["q"]);
    if (!$q) return;
    $query_nip = "select * from admin where nip LIKE '%$q%'";
    $statement_nip=oci_parse($c,$query_nip);
    oci_execute($statement_nip);
    $nip=oci_fetch_array($statement_nip,OCI_BOTH);
if($nip!=0){
    while($baris_nip=oci_fetch_array($statement_nip,OCI_BOTH)){

        echo"$baris_nip[1] \n";
    }

}
    else{
        $query_nama = "select * from admin where nama LIKE '%$q%'";
        $statement_nama=oci_parse($c,$query_nama);
        oci_execute($statement_nama);
        $nama=oci_fetch_array($statement_nama,OCI_BOTH);
        if($nama!=0){
            while($baris_nama=oci_fetch_array($statement_nama,OCI_BOTH)){

                echo"$baris_nama[2] \n";
            }

        }
    }
?>