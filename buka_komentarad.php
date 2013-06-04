<?php
include('oraconn.php');
$tampilkomen = "select * from komen where id_status='$id_status'order by id_komen asc";
$statementkomen=oci_parse($c,$tampilkomen);
oci_execute($statementkomen);
while($bariskomen = oci_fetch_array ($statementkomen, OCI_BOTH))
{
    $id_kom=$bariskomen['ID_KOMEN'];
    $komentar=$bariskomen['KOMEN'];
    $idu=$bariskomen['ID_USER'];
    $tanggalkomen=$bariskomen['TANGGAL'];
    $awalankomen = substr($idu, 0,2);
    switch($awalankomen)
    {
        case 'ad':
            $namakomen="select * from admin where id_user = '$idu'";
            $statement3=oci_parse($c,$namakomen);
            oci_execute($statement3);
//        echo $nama;
            while($baris3 = oci_fetch_array ($statement3, OCI_BOTH))
            {
                $nama3= $baris3['NAMA'];
                $tabel = "admin";
            }
            break;

        case 'al':
            $namakomen="select * from alumni where id_user = '$idu'";
            $statement3=oci_parse($c,$namakomen);
            oci_execute($statement3);
//        echo $nama;
            while($baris3 = oci_fetch_array ($statement3, OCI_BOTH))
            {
                $nama3= $baris3['NAMA'];
                $tabel = "alumni";
            }
            break;

        case 'pr':
            $namakomen="select * from perusahaan where id_user = '$idu'";
            $statement3=oci_parse($c,$namakomen);
            oci_execute($statement3);
//        echo $nama;
            while($baris3 = oci_fetch_array ($statement3, OCI_BOTH))
            {
                $nama3= $baris3['NAMA_PERUSAHAAN'];
                $tabel = "perusahaan";
            }
            break;
    }
    ?>

<div class="row-fluid" id="stcommentbody<?php echo $id_kom; ?>">
    <div class="span2">
        <!-- ambil foto -->
        <?
        //		include("oraconn.php");
        $username = $_SESSION['username'];
        $query_foto = "select foto from ".$tabel." where id_user = '$idu'";
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
        <!--            <img src="resource/img/default.png" alt="" class="thumbnail span12">	-->
    </div>
    <div class="span10">
        <div class="well">
            <a class="stcommentdelete" href="#" id='<?php echo $id_kom; ?>' title="Hapus Komentar"> x </a>
            <strong><a href="profilad.php?namauser=<?=$nama3;?>"	>	<?php echo $nama3; ?></a></strong><br>
            <?php echo $komentar; ?> <br>
            <?php echo $tanggalkomen; ?>
        </div>
    </div></div>

<?php } ?>