<?php
session_start();
$nama = $_SESSION['nama'];
if($_SESSION['status']!="login"){
	header("location:index.php?pesan=belum_login");
}
?>
<html>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Catatan Lokasi</title>
 <!-- leaflet css -->
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
 integrity="sha512-
xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4Ps
ZChSR7A=="
 crossorigin="" />
 <!-- bootstrap cdn -->
 <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
 integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
crossorigin="anonymous">
<!- - My CSS - ->
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<!- - Boostrap ICON - ->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link rel="shortcut icon" href="asset/img/logo/logo.png">
	<title>Lokasi</title>
 <style>
 /* ukuran peta */
 #mapid {
height: 100%;
 }
 .jumbotron{
 height: 100%;
 border-radius: 0;
 background-color: #d4edd1;
 }
 body{
 background-color: #ebe7e1;
 }
 </style>
</head>
<body>
	<div class="container-fluid">
		<div class="row flex-nowrap">
			<div class="col-auto col-x1-2 px-sm-2 px-0 navigasi">
				<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
					<a href="index.php" class="d-flex align-items-center pb-3 md-mb-0 me-md-auto text-white text-decoration-none">
						<span class="fs-5 d-none d-sm-inline">Peduli Kesehatan</span>
					</a>
					<ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
						<li class="nav-item">
							<a href="beranda.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Beranda</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="perjalanan.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bi-calendar-plus"></i> <span class="ms-1 d-none d-sm-inline">Isi Data Perjalanan</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="historyperjalanan.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bi-calendar4-week"></i> <span class="ms-1 d-none d-sm-inline">Catatan Perjalanan</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="lokasi.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bi-geo-alt"></i> <span class="ms-1 d-none d-sm-inline">Lokasi</span>
							</a>
						</li>	
						<li class="nav-item">
							<a href="catatan_lokasi.php" class="nav-link align-middle px-0 text-white">
								<i class="fs-4 bi-collection"></i> <span class="ms-1 d-none d-sm-inline">Catatan Lokasi</span>
							</a>
						</li>	
							
					</ul>
						<hr>
						<div class="dropdown pb-4">
							<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="asset/img/dashboard/smile.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
								<span class="d-none d-sm-inline mx-1"><?php
									include "koneksi.php";
									$nama = $_SESSION['nama'];
									$data = mysqli_query($koneksi,"select * from login where nama = '$nama'");
									$d = mysqli_fetch_array($data);
									echo $d['nama'];
								?>
								</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-dark text-small shadow">
								<li><a class="dropdown-item" href="profile.php">Profile</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li>
									<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tombolkeluar">Keluar</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col py-3 beranda">
					<div class="text-center">
						<marquee width="400" height="50"><h1>Catatan Lokasi</h1></marquee>
					</div>
					<div class="card bg-light">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<form method="get" action="">
										<input class="form-control" type="text" name="nama_tempat" placeholder="Cari Nama Tempat" required>
									</div>
									<div class="col">
										<input type="submit" class="btn btn-success" value="Cari" name="cari">
									</form>
									</div>
								</div>
							</div>
						</div>
						<div class="bg-light shadow rounded">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">id</th>
							<th scope="col">lat_long</th>
							<th scope="col">nama tempat</th>
							<th scope="col">kategori</th>
							<th scope="col">keterangan</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						 <?php
						// error_reporting(0);
						// ini_set('display_errors', 0);
						// ?>
						<?php
						
						include 'koneksi.php';
						$id = 1;
						$data = mysqli_query($koneksi,"select * from lokasi");
						while($d = mysqli_fetch_array($data)){
							?>
							<tr>
								<td><?php echo $id++; ?></td>
								<td><?php echo $d['lat_long']; ?></td>
								<td><?php echo $d['nama_tempat']; ?></td>
								<td><?php echo $d['kategori']; ?></td>
								<td><?php echo $d['keterangan']; ?></td>
								<td>
									<button class="btn-outline-success">Show</button>
									<button class="btn-outline-primary">Edit</button>
									<button class="btn-outline-danger">Hapus</button>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
				</div>
				<div class="modal fade" id="tombolkeluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-fw-bold" id="exampleModalLabel">KELUAR</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								Apakah anda yakin untuk keluar?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-primary fw-bold" data-bs-dismiss="modal">Batal"</button>
								<a href="logout.php" type="button" class="btn btn-outline-danger fw-bold">Keluar</a>
							</div>
						</div>
					</div>
				</div>
			
		</div>
	</div>
	<!- - Boostrap JS - ->
	<script type="text/module/javascript" herf="asset/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" intergrity="sha384-ka75k0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0lRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>