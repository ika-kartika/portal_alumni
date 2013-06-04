<ol id="updates">
<?php
//session_start();
//if (!isset($_SESSION['username'])) {
//    header('Location: index.php');}


$tampil = "select * from status where ROWNUM <= 7 order by id_status desc ";
$statement1 = oci_parse($c,$tampil);
oci_execute($statement1);
while($baris = oci_fetch_array ($statement1, OCI_BOTH))
{
    $id_status=$baris['ID_STATUS'];
    $status=$baris['STATUS'];
    $id1=$baris['ID_USER'];
    $id2=$baris['ID_USER_TUJUAN'];
    $tanggal=$baris['TANGGAL'];
    $awalan = substr($id1, 0,2);
    $awalan2 = substr($id2, 0,2);
    switch($awalan)
    {
        case 'ad':
            $nama="select * from admin where id_user = '$id1'";
            $statement2=oci_parse($c,$nama);
            oci_execute($statement2);
//        echo $nama;
            while($baris2 = oci_fetch_array ($statement2, OCI_BOTH))
            {
                $nama2= $baris2['NAMA'];
                                $tabel = "admin";
            }
            break;

        case 'al':
            $nama="select * from alumni where id_user = '$id1'";
            $statement2=oci_parse($c,$nama);
            oci_execute($statement2);
//        echo $nama;
            while($baris2 = oci_fetch_array ($statement2, OCI_BOTH))
            {

                $nama2= $baris2['NAMA'];
                                $tabel = "alumni";
            }
            break;

        case 'pr':
            $nama="select * from perusahaan where id_user = '$id1'";
            $statement2=oci_parse($c,$nama);
            oci_execute($statement2);
//        echo $nama;
            while($baris2 = oci_fetch_array ($statement2, OCI_BOTH))
            {
                $nama2= $baris2['NAMA_PERUSAHAAN'];
                                $tabel = "perusahaan";  
                        }
            break;
    }

    switch($awalan2)
    {
        case 'ad':
            $nama_tujuan="select * from admin where id_user = '$id2'";
            $statement_nama1=oci_parse($c,$nama_tujuan);
            oci_execute($statement_nama1);
//        echo $nama;
            while($baris_nama1 = oci_fetch_array ($statement_nama1, OCI_BOTH))
            {
                $nama3= $baris_nama1['NAMA'];
            }
            break;

        case 'al':
            $nama_tujuan="select * from alumni where id_user = '$id2'";
            $statement_nama1=oci_parse($c,$nama_tujuan);
            oci_execute($statement_nama1);
//        echo $nama;
            while($baris_nama1 = oci_fetch_array ($statement_nama1, OCI_BOTH))
            {

                $nama3= $baris_nama1['NAMA'];
            }
            break;

        case 'pr':
            $nama_tujuan="select * from perusahaan where id_user = '$id2'";
            $statement_nama1=oci_parse($c,$nama_tujuan);
            oci_execute($statement_nama1);
//        echo $nama;
            while($baris_nama1 = oci_fetch_array ($statement_nama1, OCI_BOTH))
            {

                $nama3= $baris_nama1['NAMA_PERUSAHAAN'];}
            break;
    }

    $jum="select * from komen where id_status='$id_status'";
    $statement3=oci_parse($c,$jum);
    oci_execute($statement3);
    $total= oci_fetch_all($statement3,$total);
    ?>
<div class="row-fluid" id="stbody<?php echo $id_status;?>">
    <div class="span2">
<!-- ambil foto -->
<?
                $username = $_SESSION['username'];
                $query_foto = "select foto from ".$tabel." where id_user = '$id1'";
                $stat_foto = oci_parse($c, $query_foto);
                oci_execute($stat_foto);
                $foto = oci_fetch_array ($stat_foto, OCI_BOTH);
                if($foto[0] == "belum upload")
                {
                        echo    "<img src='resource/img/default.png' alt='' class='thumbnail span12'>";
                }
                else
                {
                        echo    "<img src='photo/",$foto[0],"'height='55' alt='' class='thumbnail span12'>";
                }               
?>

    </div>
    <div class="span10">
        <a class="stdelete" href="#" id="<?php echo $id_status;?>" title="Hapus Status"> x </a>
    <?
    if ($id1==$id2){
        ?>
        <strong><a href="profiluser.php?namauser=<?=$nama2;?>"  ><?php echo $nama2; ?></a></strong><br>
        <?
    }
        elseif($id1!=$id2){
            ?>
            <strong><a href="profiluser.php?namauser=<?=$nama2;?>"      ><?php echo $nama2; ?></a>
            <i class="icon-play"></i>
            <a href="profiluser.php?namauser=<?=$nama3;?>"      ><?php echo $nama3; ?></a></strong><br>
            <?
        }
?>
        <?php echo $status; ?> <br>
        <?php echo $tanggal; ?>

        <div class="accordion" id="accordion2">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<? echo $id_status; ?>">
                    <?echo $total; ?> Comments
                </a>
            </div>
            <div id="collapse<? echo $id_status; ?>" class="accordion-body collapse out">
                <div class="accordion-inner">
                    <div class="row-fluid">
                        <div id="commentload<?php echo $id_status;?>">
                            <?php include ('buka_komentar.php'); ?>
                        </div>
                        <div style='display:none' id='commentbox<?php echo $id_status; ?>'></div>
                        <div class="row-fluid">
                            <div class="span2">
<!-- ambil foto -->
<?
                                $awalanid = substr($id, 0,2);
                                switch($awalanid)
                                {
                                    case 'ad':
                                        $query_foto1 = "select foto from admin where id_user = '$id'";
                                        $stat_foto1 = oci_parse($c, $query_foto1);
                                        oci_execute($stat_foto1);
                                        $foto1 = oci_fetch_array ($stat_foto1, OCI_BOTH);
                                        if($foto1[0] == "belum upload")
                                        {
                                            echo    "<img src='resource/img/default.png' alt='' class='thumbnail span12'>";
                                            //echo 	"</br>",$foto[0],"</br>";
                                        }
                                        else
                                        {
                                            echo 	"<img src='photo/",$foto1[0],"' alt='' class='thumbnail span12'>";
                                            //echo 	"</br>sudah upload</br>";
                                        }
                                        break;

                                    case 'al':
                                        $query_foto1 = "select foto from alumni where id_user = '$id'";
                                        $stat_foto1 = oci_parse($c, $query_foto1);
                                        oci_execute($stat_foto1);
                                        $foto1 = oci_fetch_array ($stat_foto1, OCI_BOTH);
                                        if($foto1[0] == "belum upload")
                                        {
                                            echo    "<img src='resource/img/default.png' alt='' class='thumbnail span12'>";
                                            //echo 	"</br>",$foto[0],"</br>";
                                        }
                                        else
                                        {
                                            echo 	"<img src='photo/",$foto1[0],"' alt='' class='thumbnail span12'>";
                                            //echo 	"</br>sudah upload</br>";
                                        }
                                        break;

                                    case 'pr':
                                        $query_foto1 = "select foto from perusahaan where id_user = '$id'";
                                        $stat_foto1 = oci_parse($c, $query_foto1);
                                        oci_execute($stat_foto1);
                                        $foto1 = oci_fetch_array ($stat_foto1, OCI_BOTH);
                                        if($foto1[0] == "belum upload")
                                        {
                                            echo    "<img src='resource/img/default.png' alt='' class='thumbnail span12'>";
                                            //echo 	"</br>",$foto[0],"</br>";
                                        }
                                        else
                                        {
                                            echo 	"<img src='photo/",$foto1[0],"' alt='' class='thumbnail span12'>";
                                            //echo 	"</br>sudah upload</br>";
                                        }
                                        break;
                                }?>
                            </div>
                            <div class="span10">
                                <div class="well">
                                    <input type="text" class="span12" id="ctextarea<?php echo $id_status; ?>" name="komen" placeholder='Write a comment...'>
                                    <input type="submit" value="Comment" id="<?php echo $id_status;?>" class="comment_button"/>
                                </div>
                            </div>

                        </div></div></div></div></div>

    </div></div>
<?php
}
?>
</ol>

<div class="facebook_style" id="facebook_style">
    <a id="<?php echo $id_status; ?>" href="#" class="load_more" >Show Older Posts <img src="resource/img/arrow1.png" /></a>
</div>