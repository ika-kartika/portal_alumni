<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: cpanel.php');}

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
                 document.location="homeadmin.php";
                </script>
                <?
             }
            else{
                $query_photo="update admin set foto = '$nama_foto' where id_user = '$id'";
                $statement_photo=oci_parse($c, $query_photo);
                oci_execute($statement_photo);

                move_uploaded_file($_FILES["foto"]["tmp_name"],
                "photo/" . $_FILES["foto"]["name"]);
//echo "Stored in: " . "photo/" . $_FILES["foto"]["name"];
header('Location: homeadmin.php');
            }
}
else{?>
<script language="javascript">
    alert("Sorry, Your Type File isn't valid..! ");
			document.location="homeadmin.php";
	</script>
    <?}

	
//blok kode upload foto
//        if ((($_FILES["foto"]["type"] == "image/gif") || ($_FILES["foto"]["type"] == "image/jpeg") || ($_FILES["foto"]["type"] == "image/pjpeg") || ($_FILES["foto"]["type"] == "image/jpg")) && ($_FILES["foto"]["size"] < 2000000))
//        {
//                if ($_FILES["foto"]["error"] > 0)
//                {
//                        //echo "Error Code: " . $_FILES["foto"]["error"] . "<br />";
//                }
//                else
//                {
//                        //echo "Upload: " . $_FILES["foto"]["name"] . "<br />";
//                        //echo "Tipe: " . $_FILES["foto"]["type"] . "<br />";
//                        //echo "Ukuran: " . ($_FILES["foto"]["size"] / 1024) . " Kb<br />";
//                        //echo "Temp file: " . $_FILES["foto"]["tmp_name"] . "<br />";
//
//                        if (file_exists("photo/" . $_FILES["foto"]["name"]))
//                        {
//                                //echo $_FILES["foto"]["name"] . " sudah terupload. ";
//                        }
//                        else
//                        {
//                                //blok kode input ke db
//                                $nama_foto=$_FILES["foto"]["name"];
//
//                                        $query_photo="update admin set foto = '$nama_foto' where nama = '$username'";
//                                        echo "</br>",$query_photo,"</br>";
//                                        $statement_photo=oci_parse($c, $query_photo);
//                                        oci_execute($statement_photo);
//
//                                        move_uploaded_file($_FILES["foto"]["tmp_name"],
//                                        "photo/" . $_FILES["foto"]["name"]);
//                                        //echo "Stored in: " . "photo/" . $_FILES["foto"]["name"];
//
//                                        //echo "</br><p align='center'>Foto sudah tersimpan..!!</p></br>";
//										header('Location: homeadmin.php');
//                        }
//                }
//        }
//        else
//        {
//                //echo "Tipe file salah";
//        }
//?>