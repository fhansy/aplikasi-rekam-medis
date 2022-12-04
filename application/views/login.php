<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

	<link href="<?= base_url(); ?>css/font-awesome.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

	<link href="<?= base_url() ?>css/style.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>css/pages/dashboard.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/pages/signin.css" rel="stylesheet" type="text/css">
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<div class="brand pull-left" style="height:100%; padding-top:20px">
					<img src="<?= base_url("assets/") ?>images/logo.png" width="40px">
				</div>
				<div class="brand pull-left">
					<h2>Sistem Rekam Medis </h2>
					<h4>Klinik PKU Muhammadiyah Gandrungmangu</h4>
				</div>

				<!--/.nav-collapse -->
			</div>
			<!-- /container -->
		</div>
		<!-- /navbar-inner -->
	</div>
	<div class="account-container">

		<?php if (!empty($this->session->flashdata('message2'))) : ?>
			<div class="alert alert-danger fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<?= $this->session->flashdata('message2'); ?>
			</div>
		<?php endif; ?>

		<div class="content clearfix">

			<form action="<?= base_url(); ?>auth/login" method="post">
				<center>
					<h1 style="margin-bottom: 40px;">Login</h1>
				</center>

				<div class="login-fields">


					<div class="field">
						<input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" required />
					</div> <!-- /field -->

					<div class="field">
						<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field" required />
					</div> <!-- /password -->

				</div> <!-- /login-fields -->

				<div class="login-actions">

					<button class="btn" style="width: 100%; height:50px">Masuk</button>

				</div> <!-- .actions -->
				<?= $this->session->flashdata('message'); ?>


			</form>

		</div> <!-- /content -->

	</div> <!-- /account-container -->



	<div class="login-extra">
		<!-- <a href="#">Reset Password</a> -->
	</div> <!-- /login-extra -->


	<script src="<?= base_url(); ?>js/jquery-1.7.2.min.js"></script>
	<script src="<?= base_url(); ?>js/bootstrap.js"></script>

	<script src="<?= base_url(); ?>js/signin.js"></script>

</body>

</html>