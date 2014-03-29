<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Dialer System</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<script src='funciones.js'></script>
</head>
<body>

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
			<div id="content4">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Add Sounds<span class="req"></span></h2>>
					</div>
					<!-- End Box Head -->

<?php

    if(isset($_POST['button'])){
        $errors = array(); // declaramos un array para almacenar los errores
        if(!is_uploaded_file($_FILES['Aud1']['tmp_name'])){
	    $errors2 = '<span class="error2">Select an Audio File</span>';
        }else if(!is_uploaded_file($_FILES['Aud2']['tmp_name'])){
	    $errors3 = '<span class="error2">Select an Audio File</span>';
	}
	else{
		if(is_uploaded_file($_FILES['Aud1']['tmp_name'])) 
		{echo "<div class='msg msg-ok'>
		<p><strong>Upload Successfully</strong></p>
		<a href='upload.php' class='close'>close</a>
		</div>";
		}
		$CampaignName=$_POST['campname'];

		$target_Path1 = "/var/lib/asterisk/agi-bin/DialerCamps/${CampaignName}/sounds/";
		$target_Path1 = $target_Path1.basename( $_FILES['Aud1']['name'] );
		move_uploaded_file( $_FILES['Aud1']['tmp_name'], $target_Path1 );

		$target_Path2 = "/var/lib/asterisk/agi-bin/DialerCamps/${CampaignName}/sounds/";
		$target_Path2 = $target_Path2.basename( $_FILES['Aud2']['name'] );
		move_uploaded_file( $_FILES['Aud2']['tmp_name'], $target_Path2 );
 	}
		
		echo "<SCRIPT LANGUAGE='JavaScript'>
		window.opener.document.location='campaigns.php?pin=$CampaignName'
		window.close();
		</SCRIPT>";				
			            
     }  
    
?>
					
		<form  enctype='multipart/form-data' id="contact-form" action="" method="post" >
				
			<!-- Form -->
			<div class="form">
				<p>
				<label>Greeting Audio<span></span></label><?php echo $errors2 ?>
				<input type=file class='field size' name='Aud1' id='Aud1'>
				</p>
				<p>
				<label>Message Audio<span></span></label><?php echo $errors3 ?>
				<input type=file class='field size' name='Aud2' id='Aud2'>
				</p><br><br>
				<p>
				<?php
				$campname=$_GET['cp'];
				echo "<input type=hidden  name='campname' id='campname' value='" .$campname. "'>";
				?>
				</p>
			</div>

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

