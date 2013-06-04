<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
$id = $_SESSION['id'];
include("oraconn.php");
//if($_POST['aksi']=='ubah'){
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $konsentrasi = $_POST['konsentrasi'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $bulan = $_POST['bulan'];
    $tgl = $_POST['tgl'];
    $thn = $_POST['thn'];
    $kelamin = $_POST['kelamin'];
    $agama = $_POST['agama'];
    $tlp = $_POST['telpon'];
    $alamat = $_POST['alamat'];
    $motto = $_POST['motto'];
    $ipk = $_POST['ipk'];
    $ta = $_POST['ta'];
    $tgll = $_POST['tgl_lls'];
    $blnl = $_POST['bln_lls'];
    $thnl = $_POST['thn_lls'];
    $lahir = $tgl." ".$bulan." ".$thn;
    $lulus = $tgll." ".$blnl." ".$thnl;
    $password1 = $_POST['password'];
    $password = md5($password1);
    $dua = substr($nim, 0, 2);
    $angkatan = "20".$dua;
    $email = $_POST['email'];
    $id_user = "al".$nim;
if ($password1==''){
    $edit_alumni="update alumni set nama='$nama',ipk='$ipk',tgl_lulus='$lulus',tempat_lahir='$tempat_lahir',tgl_lahir='$lahir',alamat='$alamat',agama='$agama',jenis_kelamin='$kelamin',no_telp='$tlp',jurusan='$jurusan',konsentrasi='$konsentrasi',motto_hidup='$motto',judul_ta='$ta',angkatan='$angkatan',thn_lulus='$thnl' where nim='$nim'";
    $edit_login = "update login set email='$email' where  id_user='$id_user'";
    $statement_alumni = oci_parse($c, $edit_alumni);
    $statement_login = oci_parse($c, $edit_login);
    oci_execute($statement_alumni);
    oci_execute($statement_login);
    ?>
<script language="javascript">
    alert("data has been successfully changed...!!");
    document.location="homealumni.php";
</script>
<?


}
else{
    $edit_alumni="update alumni set nama='$nama',ipk='$ipk',tgl_lulus='$lulus',tempat_lahir='$tempat_lahir',tgl_lahir='$lahir',alamat='$alamat',agama='$agama',jenis_kelamin='$kelamin',no_telp='$tlp',jurusan='$jurusan',konsentrasi='$konsentrasi',motto_hidup='$motto',judul_ta='$ta',angkatan='$angkatan',thn_lulus='$thnl' where nim='$nim'";
    $edit_login = "update login set email='$email',password='$password' where  id_user='$id_user'";
    $statement_alumni = oci_parse($c, $edit_alumni);
    $statement_login = oci_parse($c, $edit_login);
    oci_execute($statement_alumni);
    oci_execute($statement_login);
    ?>
<script language="javascript">
    alert("data has been successfully changed...!!");
    document.location="homealumni.php";
</script>
<?
}


?>