<?php

//mulai session
session_start();
//cek apakah user masih aktif login
if(isset($_SESSION['username']))
{
    $y = $_SESSION['hak_akses'];
    if($y='ad'){
        header('Location:homeadmin.php');
    }
    else{
       header('Location:cpanel.php');
    }
}


include("oraconn.php");

//tangkap variable yg dikirim halaman index.php
$email = $_POST['email'];
//echo '$email = ',$email,'<br />';
$password1 = $_POST['password'];
$password = md5($password1);

//cek email & password ke db
$query = "select id_user from login where email = '$email' and password = '$password'";
$statement = oci_parse($c, $query);
oci_execute($statement);
//$hasil = oci_fetch_all($statement, $hasil);
$id_user = oci_fetch_array($statement,OCI_BOTH);
//echo '$id_user = ',$id_user[0],'</br>';
//$query2 = "select nama from admin where id_user = '$id_user[0]'";
//$statement2 = oci_parse($c, $query2);
//oci_execute($statement2);
//echo $query2;


if($id_user=='')
{
    header('Location:cpanel.php');
}
else
{
    //echo $id_user[0];
    $x = substr($id_user[0], 0, 2);
    //echo '$x = ',$x;

    if($x='ad'){
        $query2 = "select nama from admin where id_user = '$id_user[0]'";
        $statement2 = oci_parse($c, $query2);
        oci_execute($statement2);
        //echo $query2;
        $nama = oci_fetch_array($statement2, OCI_BOTH);
        $_SESSION['username'] = $nama[0];
        $_SESSION['hak_akses'] = $x;
        $_SESSION['id'] = $id_user[0];
        header('Location:homeadmin.php');
    }
    else{
        header('Location:index.php');
    }
}
?>