
<?
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
$id = $_SESSION['id'];
include("oraconn.php");
$alumni="select * from alumni where id_user='$id'";
$statementa=oci_parse($c,$alumni);
oci_execute($statementa,OCI_DEFAULT);
while($baris=oci_fetch_array($statementa,OCI_BOTH)){
    $id_alumni = $baris['ID_ALUMNI'];
}
    $nama_perusahaan = $_POST['nama_perusahaan'];
    $jabatan = $_POST['jabatan'];
    $bagian = $_POST['bagian'];
    $keluar_kerja = $_POST['keluar_kerja'];
    $masuk_kerja = $_POST['masuk_kerja'];
    $alamat_perusahaan = $_POST['alamat_perusahaan'];
    $insert="insert into pekerjaan (id_pekerjaan,id_alumni,nama_perusahaan,alamat_perusahaan,tahun_masuk,tahun_keluar,bagian,jabatan) values ('','$id_alumni','$nama_perusahaan','$alamat_perusahaan','$masuk_kerja','$keluar_kerja','$bagian','$jabatan')";
    $statement_insert=oci_parse($c,$insert);
    oci_execute($statement_insert);
?>
<script language="javascript">
    alert("data has been successfully saved...!!");
    document.location="homealumni.php";
</script>

