<?
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');}
$id = $_SESSION['id'];
include('oraconn.php');
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <title >Homepage</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <link rel="stylesheet" type="text/css" href="resource/style.css">
<!--    <script type="text/javascript" src="resource/jquery.1.4.2.min.js"></script>-->
<!--    <script type="text/javascript" src="update.js"></script>-->
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <?
include ('navbaralumni.php');
        ?>
    </div>
    <div class="row">
        <h3>List Of Company</h3><br>
        <?
    $com="select * from Perusahaan order by id_perusahaan desc";
    $statement1=oci_parse($c,$com);
    oci_execute($statement1);

        ?>
        <table class="table">
            <thead>
            <tr>
                <th>Company Name</th>
                <th>Sector</th>
                <th>Website</th>
                <th>Telp</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            </thead>
<?
    while($baris1=oci_fetch_array($statement1)){
        $nama=$baris1['NAMA_PERUSAHAAN'];
        ?>
            <tbody>
            <tr>
                <td><?echo $baris1['NAMA_PERUSAHAAN']; ?></td>
                <td><?echo $baris1['BIDANG']; ?></td>
                <td><?echo $baris1['WEB']; ?></td>
                <td><?echo $baris1['NO_TELP']; ?></td>
                <td><?echo $baris1['ALAMAT_PERUSAHAAN']; ?></td>
                <td><a href="profiluser.php?namauser=<?=$nama;?>" class="btn btn-primary">Go To Profil</a></td>
            </tr>
            </tbody>
        <?
    }
?>
        </table>
    </div>
</div>

<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<footer>
    <p>&copy; Ika Kartika Sari 2012</p>
</footer>

</body>
</html>