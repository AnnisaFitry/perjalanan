<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'perjalanan');
	if (!$koneksi) {
	die('Error ' . mysql_connect_errno());
}
?>