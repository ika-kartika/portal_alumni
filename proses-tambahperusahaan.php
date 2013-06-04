<?
include('oraconn.php');
$nama = $_POST['nama'];
$bidang = $_POST['bidang'];
$tlp = $_POST['telpon'];
$alamat = $_POST['alamat'];
$password1 = $_POST['password'];
$password = md5($password1);
$repassword = $_POST['repassword'];
$email = $_POST['email'];
$web = $_POST['website'];
$fax = $_POST['fax'];
$id_user = "pr".$nama;
$foto="belum upload";
$pesan = $_POST['pesan3'];
$pesan1 = $_POST['pesan4'];

if (($pesan=='Company Has Not Registered') && ($pesan1=='Password Match')){
    $insert_perusahaan="insert into perusahaan (id_perusahaan, nama_perusahaan, alamat_perusahaan, web, no_telp, no_fax, bidang, id_user,foto) values ('','$nama','$alamat','$web','$tlp','$fax','$bidang','$id_user','$foto')";
    $insert_login = "insert into login (id_user, password, email) values ('$id_user','$password','$email')";
    $statement_perusahaan = oci_parse($c, $insert_perusahaan);
    $statement_login = oci_parse($c, $insert_login);
    oci_execute($statement_perusahaan);
    oci_execute($statement_login);
    ?>
    <script language="javascript">
        alert("Registration Is Successful. Now You Can Log In...!!");
			document.location="index.php";
	</script>
        <?
}
else {
?>
<script language="javascript">
    alert("company name or password isn't valid...!!");
    document.location="index.php";
</script>
<?
}
?>