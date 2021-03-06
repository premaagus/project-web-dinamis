<?php 
	require_once 'koneksi/koneksi.php';
	if (!isset($_SESSION['user_login'])) {
		# code...
	}
	else{
		header('location: index.php');
	}
 ?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width,intial-scale=1.0" >
    	<title>Login - Repalti</title>
    	<link rel="icon" href="img/31.png">
    	<link rel="stylesheet" type="text/css" href="css/login.css">
    	<link rel="stylesheet" href="fontawesome/font-css/css/fontawesome.min.css">
		<link rel="stylesheet" href="fontawesome/font-css/css/fa-solid.min.css">
		<link rel="stylesheet" href="fontawesome/font-css/css/fa-regular.min.css">
		<link rel="stylesheet" href="fontawesome/font-css/css/fa-brands.min.css">
		<link rel="stylesheet" href="css/animations.css">
	</head>
	
	<body>
		<div class="wrapper">
			<div class="bg-banner row animatedParent">
				<div class="back animated fadeInDown slowest">
					<a href="index.php">
						<i class="fas fa-angle-double-left" aria-hidden="true"></i>
	                  	<span>
	                    	Back to Home
	                 	</span>
                	</a>
				</div><!-- back-to-index -->
				<div class="col-lg-12">
					<div class="max-content">
						<div class="banner">
							<div class="col-lg-6 animatedParent">
								<div class="img animated fadeInLeft">
									<img src="img/p-login.png">
								</div><!-- img -->
							</div><!-- col-lg-6 -->
							<div class="col-lg-6 animatedParent">
								<div class="form animated fadeInRight">
									<h1>Halo,</h1>
									<h2>Selamat datang kembali manusia bebal !</h2>
									<form action="" method="POST">
										<div class="form-control">
											<label>E-Mail / Username</label>
											<input type="text" name="email_user" placeholder="Tulis email / username kamu disini">
										</div>
										<div class="form-control">
											<label>Password</label>
											<input type="password" name="password" placeholder="Tulis password kamu disini">
										</div>
										<button type="submit" name="btn_submit">Login
						                  <span>
						                    <i class="fas fa-chevron-circle-right" aria-hidden="true"></i>
						                  </span>
						                </button>
									</form>
								</div>
								<div class="animated fadeInUp">
									<hr>
									<p class="txt-register ">Belum Menjadi Bagian Dari Barbar? <a href="register.php">Register</a></p>
								</div>
							</div><!-- col-lg-6 -->
						</div><!-- banner -->
					</div><!-- max-content -->
				</div><!-- col-lg-12 -->
			</div><!-- bg-banner -->
		</div><!-- wrapper -->
	</body>
	<?php 
		if (isset($_POST['btn_submit'])) {
			$email_user = $koneksi->real_escape_string($_POST['email_user']);
			$password = $koneksi->real_escape_string($_POST['password']);

			$query_check = $koneksi->query("SELECT * FROM tb_user WHERE email_user = '$email_user' OR username = '$email_user'");
			if ($query_check->num_rows > 0) {
				$data_user = $query_check->fetch_assoc();
				$id_user = $data_user['id_user'];
				$db_email_user = $data_user['email_user'];
				$username = $data_user['username'];
				$db_password = $data_user['password'];
				$level_user = $data_user['level_user'];

				if (password_verify($password, $db_password)) {
					$_SESSION['user_login']['id_user'] = $id_user;
					$_SESSION['user_login']['username'] = $username;
					$_SESSION['user_login']['level_user'] = $level_user;

					echo $_SESSION['user_login']['username'];

					if ($level_user == 'Admin') {
						header('location: admin/index.php');
					}
					else{
						header('location: index.php');
					}
				}
				else{
					echo "<script>alert('Password Salah')</script>";
				}
			}
			else{
				echo "<script>alert('Email Tidak Ada')</script>";
			}
		}
	 ?>
	 <script src="js/jquery-3.2.1.min.js"> </script>
	 <script type="text/javascript" src="css3-animate-it-master/js/css3-animate-it.js"></script>

</html>