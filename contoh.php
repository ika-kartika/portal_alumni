<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['user-admin'])) {
    header('Location: index.php');}

include("oraconn.php");
include("header.php");

?>

<html>
<head>
    <title></title>
    <style type="text/css">
        table   {
            width:70%;
            border:5px solid #a1a1a1;
            margin:1em auto;
            border-collapse:collapse;
        }
        th              {
            border:5px solid #a1a1a1;
        }
        td              {
            color:#000000;
            border-bottom:1px solid #dddddd;
            border-left:1px solid #dddddd;
            padding:.3em 1em;
            text-align:center;
        }
        th.nomor{
            width:10px;
            color:#000000;
            border:5px solid #a1a1a1;
            padding:.3em 1em;
            text-align:center;
        }
    </style>
</head>

<body align='center'>
<br />
<h3>Daftar Kandidat</h3>

<table border="1" align="center" cellspacing="0" bgcolor='white'>
    <tr>
        <th class="nomor">Nomor Kandidat</th>
        <th><font color='black'>Nama Kandidat</font></th>
        <th><font color='black'>Partai Kandidat</font></th>
        <th><font color='black'>Foto Kandidat</font></th>
    </tr>
    <?php
    include("oraconn.php");

    $query="select * from server_calon";
    $statement=oci_parse($c, $query);
    oci_execute($statement);
    while($array_tps=oci_fetch_array($statement, OCI_BOTH))
    {
        echo "<tr>";
        echo "<td>",$array_tps[0],"</td>";
        echo "<td>",$array_tps[1],"</td>";
        echo "<td>",$array_tps[2],"</td>";
        echo "<td><img src='./foto_kandidat/",$array_tps[3],"' width='100' height='100' /></td>";
        echo "</tr>";

    }
/*      echo    "<tr>"
        echo            <td>Second</td>
        echo            <td>Row</td>
        echo    "</tr>"         */
    ?>
</table>

</body>
</html>