<?php
session_start();
$id = $_SESSION['id'];
include("oraconn.php");
if($_POST['aksi']=='checkjenjang'){
    $jenjang=$_POST['jenjang'];
    $id_alumni = $_SESSION['id_alumni'];

    $carijenjang = "select * from pendidikan where jenjang='$jenjang'and id_alumni='$id_alumni'";
    $statement_jenjang=oci_parse($c,$carijenjang);
    oci_execute($statement_jenjang);
    $jenjang_dapat= oci_fetch_all($statement_jenjang,$jenjang_dapat);
    // apabila jenjang ditemukan, maka $ketemu bernilai 1,
    // apabila jenjang tidak ditemukan, maka $ketemu bernilai 0.
    echo $jenjang_dapat;
}
elseif($_POST['aksi']=='checknamaper'){
    $nama_perusahaan=$_POST['nama_perusahaan'];
    $id_alumni = $_SESSION['id_alumni'];

    $cariperusahaan = "select * from pekerjaan where nama_perusahaan='$nama_perusahaan'and id_alumni='$id_alumni'";
    $statement_perusahaan=oci_parse($c,$cariperusahaan);
    oci_execute($statement_perusahaan);
    $perusahaan_dapat= oci_fetch_all($statement_perusahaan,$perusahaan_dapat);
    // apabila jenjang ditemukan, maka $ketemu bernilai 1,
    // apabila jenjang tidak ditemukan, maka $ketemu bernilai 0.
    echo $perusahaan_dapat;
}

elseif($_POST['aksi']=='checkjenjangal'){
    $cari = "select * from alumni where id_user='$id'";
    $statement=oci_parse($c,$cari);
    oci_execute($statement);
    while($baris=oci_fetch_array($statement,OCI_BOTH)){
        $id_al = $baris['ID_ALUMNI'];}

    $jenjang1=$_POST['jenjang'];
    $carijenjang1 = "select * from pendidikan where jenjang='$jenjang1'and id_alumni='$id_al'";
    $statement_jenjang1=oci_parse($c,$carijenjang1);
    oci_execute($statement_jenjang1);
    $jenjang_dapat1= oci_fetch_all($statement_jenjang1,$jenjang_dapat1);
    // apabila jenjang ditemukan, maka $ketemu bernilai 1,
    // apabila jenjang tidak ditemukan, maka $ketemu bernilai 0.
    echo $jenjang_dapat1;
}

elseif($_POST['aksi']=='checknamaperusahaan'){
    $cari1 = "select * from alumni where id_user='$id'";
    $statementca=oci_parse($c,$cari1);
    oci_execute($statementca);
    while($baris1=oci_fetch_array($statementca,OCI_BOTH)){
        $id_almn = $baris1['ID_ALUMNI'];}
    $nama_perusahaan=$_POST['nama_perusahaan'];

    $cariperusahaan1 = "select * from pekerjaan where nama_perusahaan='$nama_perusahaan'and id_alumni=' $id_almn'";
    $statement_perusahaan1=oci_parse($c,$cariperusahaan1);
    oci_execute($statement_perusahaan1);
    $perusahaan_dapat1= oci_fetch_all($statement_perusahaan1,$perusahaan_dapat1);
    // apabila jenjang ditemukan, maka $ketemu bernilai 1,
    // apabila jenjang tidak ditemukan, maka $ketemu bernilai 0.
    echo $perusahaan_dapat1;
}
?>