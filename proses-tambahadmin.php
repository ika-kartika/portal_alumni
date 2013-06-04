<?
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}
$id = $_SESSION['id'];
include('oraconn.php');
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$tempat_lahir = $_POST['tempat_lahir'];
$bulan = $_POST['bulan'];
$tgl = $_POST['tgl'];
$thn = $_POST['thn'];
$kelamin = $_POST['kelamin'];
$agama = $_POST['agama'];
$tlp = $_POST['telpon'];
$alamat = $_POST['alamat'];
$lahir = $tgl." ".$bulan." ".$thn;
$password1 = $_POST['password'];
$password = md5($password1);
$email = $_POST['email'];
$id_user = "ad".$nip;
$foto = "belum upload";
$pesannip = $_POST['pesan3'];
$pesanemail = $_POST['pesan4'];
$pesanpass = $_POST['pesan5'];
//$insert_admin="insert into admin (id_admin, nip, nama, tempat_lahir, tgl_lahir, alamat, agama, jenis_kelamin, no_telp, foto, id_user) values ('','22','ss','ll','1 january 1999','ll','ll','ll','74574','$foto','ad22')";
if (($pesannip=='Ok,,NIP Has Not Registered.') && ($pesanemail=='Ok,,email Has Not Registered.') && ($pesanpass=='Password Match')){
$insert_admin="insert into admin (id_admin, nip, nama, tempat_lahir, tgl_lahir, alamat, agama, jenis_kelamin, no_telp, foto, id_user) values ('156','$nip','$nama','$tempat_lahir','$lahir','$alamat','$agama','$kelamin','$tlp','$foto','$id_user')";
$insert_login = "insert into login (id_login, id_user, password, email) values ('156','$id_user','$password','$email')";
$statement_admin = oci_parse($c, $insert_admin);
$statement_login = oci_parse($c, $insert_login);
oci_execute($statement_admin);
oci_execute($statement_login);
    header('Location: paneladmin.php');
}
else{
    ?>
<script language="javascript">
    alert("NIP or Email or Password isn't valid...!!");
    document.location="addadmin.php";
</script>
<?

}