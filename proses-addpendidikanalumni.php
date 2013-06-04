
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
    $nama_sekolah = $_POST['nama_sekolah'];
    $jenjang = $_POST['jenjang'];
    $tahun_keluar = $_POST['tahun_keluar'];
    $tahun_masuk = $_POST['tahun_masuk'];
    $alamat_sekolah = $_POST['alamat_sekolah'];
    $insert="insert into pendidikan(id_pendidikan,id_alumni,nama_sekolah,alamat_sekolah,tahun_masuk,tahun_keluar,jenjang) values ('','$id_alumni','$nama_sekolah','$alamat_sekolah','$tahun_masuk','$tahun_keluar','$jenjang')";
    $statement_insert=oci_parse($c,$insert);
    oci_execute($statement_insert);
?>
<script language="javascript">
    alert("data has been successfully saved...!!");
    document.location="homealumni.php";
</script>
