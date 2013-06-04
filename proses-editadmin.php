<?php
session_start();
include("oraconn.php");
//if($_POST['aksi']=='ubah'){
$nama1=$_POST['nama'];
//echo $nama;
$nip1=$_POST['nip'];
$tmp_lhr=$_POST['tempat_lahir'];
$bln=$_POST['bulan'];
$tgl=$_POST['tgl'];
$thn=$_POST['thn'];
$jk=$_POST['kelamin'];
$agama=$_POST['agama'];
$tlp=$_POST['telpon'];
$almt=$_POST['alamat'];
$lhr=$tgl." ".$bln." ".$thn;
$pass1=$_POST['password'];
$pass=md5($pass1);
$email=$_POST['email'];
$id_user="ad".$nip1;
$pesanemail=$_POST['pesan1'];
$pesanpass=$_POST['pesan3'];
$id_admin = $_SESSION['id_admin'];

if ($pass1==""){
        $edit_admin= "update admin set nama='$nama1',tempat_lahir='$tmp_lhr',tgl_lahir='$lhr',alamat='$almt',agama='$agama',jenis_kelamin='$jk',no_telp='$tlp' where nip='$nip1'";
        $edit_login= "update login set email='$email' where  id_user='$id_user'";
        $statement_admin=oci_parse($c,$edit_admin);
        $statement_login=oci_parse($c,$edit_login);
        oci_execute($statement_admin);
        oci_execute($statement_login);
    ?>
<script language="javascript">
    alert("Saved Successfully..!");
    document.location="paneladmin.php";
</script>
<?
}
else{
 $edit_admin= "update admin set nama='$nama1',tempat_lahir='$tmp_lhr',tgl_lahir='$lhr',alamat='$almt',agama='$agama',jenis_kelamin='$jk',no_telp='$tlp' where nip='$nip1'";
        $edit_login= "update login set email='$email', password='$pass' where  id_user='$id_user'";
        $statement_admin=oci_parse($c,$edit_admin);
        $statement_login=oci_parse($c,$edit_login);
        oci_execute($statement_admin);
        oci_execute($statement_login);
    ?>
<script language="javascript">
    alert("Saved Successfully..!");
    document.location="paneladmin.php";
</script>
<?
}
?>