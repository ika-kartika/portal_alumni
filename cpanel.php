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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>
       Login Admin
    </title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style.css">
    <style type="text/css">
        body {
            background-color: #56A5EC;
        }
    </style>
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>

</head>

<body>
<div class="container">
    <div class="row">
    <div class="well span5 panel">
        <form class="form-horizontal" method="post" action="login-admin.php">
            <fieldset>
                <legend>Admin Panel</legend>
                <div class="control-group">

                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input name="email"
                                                                                        class="span2"
                                                                                        type="text"
                                                                                        placeholder="email">
                        </div>
                    </div>
                </div>
                <div class="control-group">

                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input name="password" class="span2"
                                                                                        type="password"
                                                                                        placeholder="Password">
                        </div>
                    </div>
                </div>

                <div>

                    <button type="submit" class="btn btn-primary"> Login
                    </button>
                    <button class="btn">Cancel</button>
                </div>
            </fieldset>
        </form>
    </div>
    </div>
</div>
<!-- /container -->
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</body>
</html>