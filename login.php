<?php

    //mulai session
    session_start();
    //cek apakah user masih aktif login
    if(isset($_SESSION['username']))
    {
       $y = $_SESSION['hak_akses'];
        switch($y)
        {
            case 'ad':
                header('Location:homeadmin.php');
                break;

            case 'al':
                header('Location:homealumni.php');
                break;

            case 'pr':
                header('Location:homeperusahaan.php');
                break;
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
    //echo '$id_user = ',$id_user[0];

    if($id_user=='')
    {?>
        <script language="javascript">
        alert("Sorry, Your Username or Password isn't valid!!");
			document.location="index.php";
	</script>
<?
       // header('Location:index.php');
    }
    else
    {
        //echo $id_user[0];
        $x = substr($id_user[0], 0, 2);
        //echo '$x = ',$x;

        switch($x)
        {
            case 'ad':
                $query2 = "select nama from admin where id_user = '$id_user[0]'";
                $statement2 = oci_parse($c, $query2);
                oci_execute($statement2);
                $nama = oci_fetch_array($statement2, OCI_BOTH);
                $_SESSION['username'] = $nama[0];
                $_SESSION['hak_akses'] = $x;
                $_SESSION['id'] = $id_user[0];
                header('Location:homeadmin.php');
                break;

            case 'al':
                $query3 = "select nama from alumni where id_user = '$id_user[0]'";
                $statement3 = oci_parse($c, $query3);
                oci_execute($statement3);
                $nama = oci_fetch_array($statement3, OCI_BOTH);
                $_SESSION['username'] = $nama[0];
                //echo 'nama = ',$_SESSION['username'];
                $_SESSION['hak_akses'] = $x;
                $_SESSION['id'] = $id_user[0];
                header('Location:homealumni.php');
                break;

            case 'pr':
                $query4 = "select nama_perusahaan from perusahaan where id_user = '$id_user[0]'";
                $statement4 = oci_parse($c, $query4);
                oci_execute($statement4);
                $nama = oci_fetch_array($statement4, OCI_BOTH);
                $_SESSION['username'] = $nama[0];
                $_SESSION['hak_akses'] = $x;
                $_SESSION['id'] = $id_user[0];
                header('Location:homeperusahaan.php');
                break;
        }
    }
?>