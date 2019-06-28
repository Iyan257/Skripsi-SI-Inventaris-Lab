<!DOCTYPE html>
<html class="fixed">
	<head>
		<meta charset="UTF-8">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/magnific-popup/magnific-popup.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap-datepicker/css/datepicker3.css')?>" />

		<!-- Specific Table Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/select2/select2.css')?>" />
		<link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery-datatables-bs3/assets/css/datatables.css')?>" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme.css')?>" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/skins/default.css')?>" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/theme-custom.css')?>">

		<!-- Head Libs -->
		<script src="<?php echo base_url('assets/vendor/modernizr/modernizr.js')?>"></script>

		<!-- Bootstrap and jquery-->
		<!--<link rel="stylesheet" href="<?php //echo base_url('assets/vendor/bootstrap/bootstrap.min.css')?>">
		<script src="<?php //echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
		-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js')?>"></script>

	</head>
	<body>
		<section class="body">


		<!-- start: page -->
			<section class="body-sign">
				<div class="center-sign">
					<div class="panel panel-sign">
						<div class="panel-title-sign mt-xl text-right">
							<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
						</div>
						<div class="panel-body">
							<?= form_open('/home'); ?>
								<img src="<?= base_url('assets/images/logoInformatika.jpg')?>" height="54" alt="Porto Admin" />
								<div class="row">
									<div class="col-lg-12">
									<?php $errors = $this->session->flashdata('errors'); $len_error = is_array($errors)? count($errors) : 0; ?>
									<?php if($errors!=null):?>
									<div class="alert alert-danger">
										<b>Error!</b> <?= $len_error <= 1? (is_array($errors)? $errors[0] : $errors) : ''?>
										<?php if($len_error > 1): ?>
											<ul class="mb-0">
												<?php foreach($errors as $error): ?>
													<li><?= $error ?></li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</div>
									<?php endif; ?>
								</div>
								</div>
								<div class="form-group mb-lg">
									<label>Username</label>
									<div class="input-group input-group-icon">
										<input type="text" class="form-control input-lg" name="username" placeholder="username"/>
										<span class="input-group-addon">
											<span class="icon icon-lg">
												<i class="fa fa-user"></i>
											</span>
										</span>
									</div>
								</div>

								<div class="form-group mb-lg">
									<div class="clearfix">
										<label class="pull-left">Password</label>
										<a href="pages-recover-password.html" class="pull-right">Lost Password?</a>
									</div>
									<div class="input-group input-group-icon">
										<input type="password" class="form-control input-lg" name="password" placeholder="password"/>
										<span class="input-group-addon">
											<span class="icon icon-lg">
												<i class="fa fa-lock"></i>
											</span>
										</span>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-8">
										<div class="checkbox-custom checkbox-default">
											<input id="RememberMe" name="rememberme" type="checkbox"/>
											<label for="RememberMe">Remember Me</label>
										</div>
									</div>
									<div class="col-sm-4 text-right">
										<button name="submit" type="submit" class="btn btn-primary">Sign In</button>
									</div>
								</div>

								<span class="mt-lg mb-lg line-thru text-center text-uppercase">
									<span>or</span>
								</span>
								<p class="text-center">Don't have an account yet? <a href="pages-signup.html">Sign Up!</a>

							</form>
						</div>
					</div>

					<!--<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>-->
				</div>
			</section>
		<!-- end: page -->

		</section>
		
		
		<!-- Vendor -->
		<script src="<?php echo base_url('assets/vendor/jquery/jquery.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/nanoscroller/nanoscroller.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/magnific-popup/magnific-popup.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-placeholder/jquery.placeholder.js')?>"></script>
		
		<!-- Specific Page Vendor for modal -->
		<script src="<?php echo base_url('assets/vendor/pnotify/pnotify.custom.js')?>"></script>
		<!-- Specific Page Vendor for tables-->
		<script src="<?php echo base_url('assets/vendor/select2/select2.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-datatables/media/js/jquery.dataTables.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js')?>"></script>
		<script src="<?php echo base_url('assets/vendor/jquery-datatables-bs3/assets/js/datatables.js')?>"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url('assets/javascripts/theme.js')?>"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url('assets/javascripts/theme.custom.js')?>"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url('assets/javascripts/theme.init.js')?>"></script>
		
		<!-- Examples -->
		<script src="<?php echo base_url('assets/javascripts/ui-elements/examples.modals.js')?>"></script>

		<!-- Examples for tables-->
		<script src="<?php echo base_url('assets/javascripts/tables/examples.datatables.default.js')?>"></script>
		<script src="<?php echo base_url('assets/javascripts/tables/examples.datatables.row.with.details.js')?>"></script>
		<script src="<?php echo base_url('assets/javascripts/tables/examples.datatables.tabletools.js')?>"></script>
	</body>
</html>