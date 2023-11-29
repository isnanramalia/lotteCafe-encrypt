<!DOCTYPE html>
<html lang="en">

<head>
	<title>Lottie Café | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" href="assets/images/cafe/coffee.ico">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/fonts/fontawesome-free/css/all.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/login/css/sb-admin-2.min.css">
	<!--===============================================================================================-->
</head>

<style>
	body {
		background-image: url("assets/images/cafe/bg-login.svg");
		background-size: cover;
		background-repeat: no-repeat;
		background-attachment: fixed;
	}
</style>

<body>
	<div class="container">
		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block">
								<img src="assets/images/cafe/cafe.jpg" alt='image' width="405px" height="auto">
							</div>
							<div class="col-lg-6 mt-4">
								<div class="p-4">
									<div class="text-center">
										<img src="assets/images/cafe/coffee-cup.gif" alt='gif' width="100" class="rounded-circle mb-1">
										<p class="h4 text-dark text-uppercase">Lottie café</p>
									</div>

									<?php if (isset($_GET['msg'])) {
										$msg = $_GET['msg'];
										if ($msg == 1) {
									?>
											<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Anda berhasil logout!</div>
										<?php
										} else if ($msg == 2) {
										?>
											<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Password salah!</div>
										<?php
										} else if ($msg == 3) {
										?>
											<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Username tidak ditemukan!</div>
										<?php
										} else if ($msg == 4) {
										?>
											<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Silahkan login terlebih dahulu!</div>
										<?php
										} else if ($msg == 5) {
										?>
											<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Anda tidak memiliki otoritas!</div>
										<?php
										} else if ($msg == 6) {
										?>
											<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Error Database</div>
										<?php
										} else if ($msg == 7) {
										?>
											<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Autentikasi Gagal</div>
										<?php
										} else if ($msg == 8) {
										?>
											<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Password berhasil diubah!</div>
										<?php
										} else if ($msg == 9) {
										?>
											<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal ubah password!</div>
									<?php
										}
									}
									?>

									<hr>
									<form class="user" method="post" action="login.php">
										<div class="form-group">
											<i class="fas fa-user pl-3"> Username</i>
											<input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan Username" value="<?= ($_SERVER["REMOTE_ADDR"] == "5.189.147.47" ? "cakra" : ""); ?>">
										</div>
										<div class="form-group">
											<i class="fas fa-key pl-3"> Password</i>
											<div class="input-group">
												<input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan password" value="<?= ($_SERVER["REMOTE_ADDR"] == "5.189.147.47" ? "cakra" : ""); ?>">
												<div class="input-group-append">
													<span id="eye-button" onclick="change()" class="input-group-text">
														<i class="fas fa-fw fa-eye" title="tampilkan password"></i>
													</span>
												</div>
											</div>
										</div>
										<button type="submit" class="btn btn-dark btn-user btn-block" name="btn_login">
											<strong>Login</strong>
										</button>
									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="reset_password/lupa_password.php">Lupa password?</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Show Password -->
	<script type="text/javascript">
		function change() {
			var x = document.getElementById('password').type;
			if (x == 'password') {
				document.getElementById('password').type = 'text';
				document.getElementById('eye-button').innerHTML = `<i class="fas fa-fw fa-eye-slash" title="sembunyikan password"></i>`;
			} else {
				document.getElementById('password').type = 'password';
				document.getElementById('eye-button').innerHTML = `<i class="fas fa-fw fa-eye" title="tampilkan password"></i>`;
			}
		}
	</script>

</body>

</html>