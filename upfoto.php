<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['user-admin'])) {
    header('Location: index.php');}

include("oraconn.php");
include("header.php");

?>

<?php

//blok kode upload foto
if ((($_FILES["foto"]["type"] == "image/gif") || ($_FILES["foto"]["type"] == "image/jpeg") || ($_FILES["foto"]["type"] == "image/pjpeg") || ($_FILES["foto"]["type"] == "image/jpg")) && ($_FILES["foto"]["size"] < 2000000))
{
    if ($_FILES["foto"]["error"] > 0)
    {
        echo "Error Code: " . $_FILES["foto"]["error"] . "<br />";
    }
    else
    {
        //echo "Upload: " . $_FILES["foto"]["name"] . "<br />";
        //echo "Tipe: " . $_FILES["foto"]["type"] . "<br />";
        //echo "Ukuran: " . ($_FILES["foto"]["size"] / 1024) . " Kb<br />";
        //echo "Temp file: " . $_FILES["foto"]["tmp_name"] . "<br />";

        if (file_exists("foto_kandidat/" . $_FILES["foto"]["name"]))
        {
            echo $_FILES["foto"]["name"] . " sudah terupload. ";
        }
        else
        {
            //blok kode input ke db
            $nomor_calon=$_POST['nomor_calon'];
            $nama_calon=$_POST['nama_calon'];
            $partai_calon=$_POST['partai_calon'];
            $nama_foto=$_FILES["foto"]["name"];

            $query_cek = "select * from server_calon where nama_calon = '$nama_calon'";
            $statement_cek = oci_parse($c, $query_cek);
            oci_execute($statement_cek);
            $cek = oci_fetch_all($statement_cek, $cek);
            if($cek==0)
            {
                $query_calon="insert into server_calon (nomor_calon, nama_calon, partai_calon, nama_foto) values ('$nomor_calon','$nama_calon','$partai_calon','$nama_foto')";
                $statement_calon=oci_parse($c, $query_calon);
                oci_execute($statement_calon);

                move_uploaded_file($_FILES["foto"]["tmp_name"],
                    "foto_kandidat/" . $_FILES["foto"]["name"]);
                //echo "Stored in: " . "foto_kandidat/" . $_FILES["foto"]["name"];

                echo "</br><p align='center'>Data kandidat tersimpan..!!</p></br>";
            }
            else
            {
                echo "</br><p align='center'>Kandidat sudah terdaftar!</p></br>";
            }
        }
    }
}
else
{
    echo "Tipe file salah";
}




?>