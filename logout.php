<?php

//error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) 
	{
		header('Location: index.php');
	}
	
//echo 'Anda telah logout dari sistem..';

//echo '</br> session destroyed';
session_destroy();
header('Location: index.php');

?>