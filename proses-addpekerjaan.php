<?php
session_start();
$id = $_SESSION['id'];?>
<html>
<body>
<?
include ("oraconn.php");
$nama_perusahaan = $_POST['nama_perusahaan'];
$bagian = $_POST['bagian'];
$jabatan = $_POST['jabatan'];
$tahun_masuk = $_POST['tahun_masuk'];
$tahun_keluar = $_POST['tahun_keluar'];
$alamat_perusahaan = $_POST['alamat_perusahaan'];
//    $id_alumni = $_POST['id_alumni'];
$id_alumni = $_SESSION['id_alumni'];
$pesan=$_POST['pesan1'];
$pesan1=$_POST['pesan3'];

if (($pesan=='Ok,,Job Has Not Registered') && ($pesan1=='ok,,,! ')){
$insert="insert into pekerjaan(id_pekerjaan,id_alumni,nama_perusahaan,alamat_perusahaan,bagian,tahun_masuk,tahun_keluar,jabatan) values ('','$id_alumni','$nama_perusahaan','$alamat_perusahaan','$bagian','$tahun_masuk','$tahun_keluar','$jabatan')";
$statement_insert=oci_parse($c,$insert);
oci_execute($statement_insert);

$data_alumni="select * from alumni where id_alumni='$id_alumni'";
$statement_alumni=oci_parse($c,$data_alumni);
oci_execute($statement_alumni);
while($baris = oci_fetch_array ($statement_alumni, OCI_BOTH))

{
    $nama = $baris['NAMA'];
    $nim = $baris['NIM'];
    //$_SESSION['nama'] = $baris['NAMA'];
    //$_SESSION['nim'] = $nim = $baris['NIM'];
    echo $nama;
    echo $nim;
    echo "</br><form method='get' action='seemore-alumni.php' >";
    echo "<input type='hidden' name='nama' value='",$nama,"' />";
    echo "<input type='hidden' name='nim' value='",$nim,"' />";
    echo "</form>";
    ?>

    <?
}?>
</body>
</html>
<?

header('Location:seemore-alumni.php');
}
else{
    ?>
<script language="javascript">
    alert("Company name or Year isn't valid...!!");
    document.location="addpekerjaan.php";
</script>
<?
}
?>