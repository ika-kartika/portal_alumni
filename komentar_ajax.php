<?php
session_start();
$id_user = $_SESSION['id'];
include('oraconn.php');
if(isSet($_POST['komentar'])){
// Simpan query komentar
$today = date("F j, Y, g:i a");
$komentar=$_POST['komentar'];
$id_status=$_POST['id_status'];
$qrysimpan="INSERT INTO komen(id_komen,komen,tanggal,id_status,id_user) VALUES('','$komentar','$today','$id_status','$id_user')";
$statementsimpanstatus=oci_parse($c,$qrysimpan);
oci_execute($statementsimpanstatus);

$qrytampil="SELECT * FROM komen WHERE id_status='$id_status' ORDER BY id_komen DESC";
$statementselectstatus=oci_parse($c,$qrytampil);
    oci_execute($statementselectstatus);
	$rowtampil = oci_fetch_array ($statementselectstatus, OCI_BOTH);
$id_kom=$rowtampil['ID_KOMEN'];
$komentar=$rowtampil['KOMEN'];
$id=$rowtampil['ID_USER'];
$tanggal=$rowtampil['TANGGAL'];
$awalan = substr($id, 0,2);
		 switch($awalan)
            {
                case 'ad':
                    $nama="select * from admin where id_user = '$id'";
                    $statement2=oci_parse($c,$nama);
                    oci_execute($statement2);
//        echo $nama;
                    $baris2 = oci_fetch_array ($statement2, OCI_BOTH);
                    
                        $nama2= $baris2['NAMA'];
						$tabel= 'admin';
                   
                    break;

                case 'al':
                    $nama="select * from alumni where id_user = '$id'";
                    $statement2=oci_parse($c,$nama);
                    oci_execute($statement2);
//        echo $nama;
                    $baris2 = oci_fetch_array ($statement2, OCI_BOTH);
                    
                        $nama2=$baris2['NAMA'];
						$tabel= 'alumni';
                    
                    break;

                case 'pr':
                    $nama="select * from perusahaan where id_user = '$id'";
                    $statement2=oci_parse($c,$nama);
                    oci_execute($statement2);
//        echo $nama;
                    $baris2 = oci_fetch_array ($statement2, OCI_BOTH);
                    
                        $nama2=$baris2['NAMA_PERUSAHAAN'];
						$tabel= 'perusahaan';
                    break;
            }
?>
<div class="row-fluid" id="stcommentbody<?php echo $id_kom; ?>">
    <div class="span2">
<?
		include("oraconn.php");
		$username = $_SESSION['username'];
		$query_foto = "select foto from ".$tabel." where id_user = '$id'";
		//echo "</br>",$query_foto,"</br>";
		$stat_foto = oci_parse($c, $query_foto);
		oci_execute($stat_foto);
		$foto = oci_fetch_array ($stat_foto, OCI_BOTH);
		if($foto[0] == "belum upload")
		{
			echo    "<img src='resource/img/default.png' alt='' class='thumbnail span12'>";
			//echo 	"</br>",$foto[0],"</br>";
		}
		else
		{
			echo 	"<img src='photo/",$foto[0],"' alt='' class='thumbnail span12'>";
			//echo 	"</br>sudah upload</br>";
		}		
?>
     <!--   <img src="resource/img/default.png" alt="" class="thumbnail span12">	-->
    </div>
    <div class="span10">
        <div class="well">
<!--            <div id="stcommentbody--><?php //echo $id_kom; ?><!--"></div>-->
            <a class="stcommentdelete" href="#" id='<?php echo $id_kom; ?>' title="Hapus Komentar"> x </a>
            <strong><a href="profiluser.php?namauser=<?=$nama2;?>"	>	<?php echo $nama2; ?></a></strong><br>
                <?php echo $komentar; ?><br>
            <?php echo $tanggal; ?>
        </div>
    </div></div>
<?php } ?>
