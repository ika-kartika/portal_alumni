<?php
include('oraconn.php');
$q = strtolower($_GET["q"]);
if (!$q) return;
$query_nim = "select * from alumni where nim LIKE '%$q%'";
$statement_nim=oci_parse($c,$query_nim);
oci_execute($statement_nim);
$nim=oci_fetch_array($statement_nim,OCI_BOTH);
if($nim!=0){
    while($baris_nim=oci_fetch_array($statement_nim,OCI_BOTH)){

        echo"$baris_nim[1] \n";
    }

}
    else{
        $query_nama = "select * from alumni where nama LIKE '%$q%'";
        $statement_nama=oci_parse($c,$query_nama);
        oci_execute($statement_nama);
        $nama=oci_fetch_array($statement_nama,OCI_BOTH);
        if($nama!=0){
            while($baris_nama=oci_fetch_array($statement_nama,OCI_BOTH)){

                echo"$baris_nama[2] \n";
            }

        }
        else{
            $query_konsentrasi = "select * from alumni where konsentrasi LIKE '%$q%'";
            $statement_konsentrasi=oci_parse($c,$query_konsentrasi);
            oci_execute($statement_konsentrasi);
            $konsentrasi=oci_fetch_array($statement_konsentrasi,OCI_BOTH);
            if($konsentrasi!=0){
                while($baris_konsentrasi=oci_fetch_array($statement_konsentrasi,OCI_BOTH)){

                    echo"$baris_konsentrasi[12] \n";
                }

        }
            else{
                $query_lulus = "select * from alumni where thn_lulus LIKE '%$q%'";
                $statement_lulus=oci_parse($c,$query_lulus);
                oci_execute($statement_lulus);
                $lulus=oci_fetch_array($statement_lulus,OCI_BOTH);
                if($lulus!=0){
                    while($baris_lulus=oci_fetch_array($statement_lulus,OCI_BOTH)){

                        echo"$baris_lulus[18] \n";
                    }
                }


    }
    }

    }
?>