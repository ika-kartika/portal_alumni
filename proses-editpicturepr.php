<?php
ob_start();
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
include("oraconn.php");
$username = $_SESSION['username'];
$id = $_SESSION['id'];
$nama_foto=$_FILES["foto"]["name"];


if ((($_FILES["foto"]["type"] == "image/gif") || ($_FILES["foto"]["type"] == "image/jpeg") || ($_FILES["foto"]["type"] == "image/pjpeg") || ($_FILES["foto"]["type"] == "image/jpg")) && ($_FILES["foto"]["size"] < 2000000))
{
    if (file_exists("photo/" . $_FILES["foto"]["name"]))
    {
        ?>
    <script language="javascript">
        alert("Sorry, <? echo $_FILES["foto"]["name"]; ?> already exists..! choose new photo or rename your photo..!" );
        document.location="homeperusahaan.php";
    </script>
    <?
    }
    else{
        $query_photo="update perusahaan set foto = '$nama_foto' where id_user = '$id'";
        $statement_photo=oci_parse($c, $query_photo);
        oci_execute($statement_photo);

        move_uploaded_file($_FILES["foto"]["tmp_name"],
            "photo/" . $_FILES["foto"]["name"]);
        //echo "Stored in: " . "photo/" . $_FILES["foto"]["name"];
        header('Location: homeperusahaan.php');
    }
}
else{?>
<script language="javascript">
    alert("Sorry, Your Type File isn't valid..! ");
    document.location="homeperusahaan.php";
</script>
<?}
?>