<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Dialer System</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<script src='funciones.js'></script>
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#">Dialer System</a></h1>
			<div id="top-navigation">
				<strong>Login</strong>
				<span>|</span>
				<a href="#">Help</a>
			</div>
		</div>
		<!-- End Logo + Top Nav -->
		
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
	<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
			<!--<a href="#">Dashboard</a>
			<span>&gt;</span>
			Current Articles-->
		</div>
		<!-- End Small Nav -->
		
			
		
		<br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content5">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Login<span class="req"></span></h2>>
					</div>
					<!-- End Box Head -->
				<form  id="contact-form" action="check_login.php" method="post">

						<!-- Form -->
						<div class="form">
							<p>
							<label>User<span><span><label>
							<input type='text' name=user class='field' value=''/>
							</p>

							<p>
							<label>Password<span><span><label>
							<input type='password' name=pwd class='field' value=''/>
							</p>
							<?php
							$msg = $_GET['msg'];
							$type= $_GET['type'];
							if ($msg!=''){
								if ( $type==0 ){
									echo "<div class='msg msg-error'>
									<p><strong>$msg</strong></p>
									<a href='index.php' class='close'>close</a>
									</div>";
								}else{
									echo "<div class='msg msg-ok'>
									<p><strong>$msg</strong></p>
									<a href='index.php' class='close'>close</a>
									</div>";
								}
							}
							?>
						<!-- Form Buttons -->
						<div class="buttons">

							<input name="button" type="submit" class="button" value="submit" />

						</div>
						<!-- End Form Buttons -->
					</form>
				</div>
				<!-- End Box -->

			</div>
			<!-- End Content -->


			<div class="cl">&nbsp;</div>
		</div>
		<!-- Main -->
	</div>
</div>

<p align="center">&copy; <a href="http://chocotemplates.com/" target="_blank">Design by ChocoTemplates</a> 2012 / Adapted for <a href="http://digital-merge.com" target="_blank">Digital-Merge</a></p><p align="center"><a href="http://about.me/navaismo" target="_blank"> Modified by Navaismo</a></p></body>
</html>


