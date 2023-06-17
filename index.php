<?php
session_start();
if (!empty($_SESSION['username'])){
  header("location:admin.php?menu=home");
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    	<meta content="width=device-width, initial-scale=1" name="viewport">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/themify-icons.css">
		<style>
			@import url("https://fonts.googleapis.com/css2?family=Courgette&display=swap");

			.login__title {
			color: hsl(244, 75%, 57%);
			font-size: 1.3rem;
			font-weight: bold;
			font-family: "Courgette", cursive;
			}
			.login__title span {
				color: hsl(244, 12%, 12%);
			}

			.icon-user {
				position: absolute;
				top: 18px;
				right: 18px;
			}

			@media only screen and (max-width: 758px) {
			.mt-12 {
				margin-top: 0;
				padding: 4;
			}
			}
			.container {
				height: 100vh;
				display: flex;
				justify-content: center;
				align-items: center;
			}
			. {
				box-shadow: 0 3px 20px rgba(0,0,0,0.4)
			}

		</style>
	</head>
	<body>
		<div class="container">
			<div class="row justify-content-md-center mt-12">
				<div class="col-sm-8 ">
					<div class="row border-box ">
						<div class="col-sm-6 p-0">
							<img src="img/buku.png" class="img-fluid ">
						</div>
						<div class="col-sm-6 p-0">
							<div class="card">
								<div class="card-header">
									<div>
										<h2 class="login__title">
											<span>Welcome to </span>MATAKU
										</h2>
									</div>
								</div>
								<div class="icon-user">
									<h4 class="ti-user"></h4>
								</div>
								<div class="card-body">
									<form method= 'POST'>
									  <div class="input-group mb-3">
										  <div class="input-group-prepend">
										    <span class="input-group-text"><i class="ti-user"></i></span>
										  </div>
										  <input type="text" class="form-control" name="username" id="username" placeholder="Username">
										</div>
									  <div class="input-group mb-3">
										  <div class="input-group-prepend">
										    <span class="input-group-text"><i class="ti-lock"></i></span>
										  </div>
										  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
										</div>
									  <button type="submit" class="btn btn-primary float-right" name="login">Logn in <i class="ti-angle-double-right" style="font-size: 12px"></i></button>
									  	<?php if(isset($_GET['login'])=="gagal"){?>
											<div class="alert alert-warning alert-dismissible fade show" role="alert">
												<strong>Login Gagal</strong> Username dan Passwordmu Salah
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
										<?php header("refresh:3;url=index.php");} ?>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="mt-4 text-center">
						<small>2023 &copy; by: Bay&Riski</small>
					</div>
				</div><!-- end row  -->
			</div>
		</div><!-- end conteiner  -->
		<?php
		include "koneksi.php";
		if(isset($_POST['login'])){ //jika tombol submit di klik
			$username = $_POST['username'];
			$pass     = md5($_POST['password']);
			$login=mysqli_query($koneksi,"SELECT * FROM login WHERE username='$username' AND kata_sandi='$pass' ");
			//utk mengetahui jumlah baris dari $login
			$ketemu=mysqli_num_rows($login);
			$r=mysqli_fetch_array($login);
			// Apabila username dan password ditemukan
			if ($ketemu > 0){  
			$_SESSION['username']     = $r['username'];
			$_SESSION['nama_lengkap']  = $r['nama_lengkap'];
			
			header("location:admin.php?menu=home");
			}else{
			header("location:index.php?login=gagal");
			}
			
		}
		?>
	</body>
</html>
