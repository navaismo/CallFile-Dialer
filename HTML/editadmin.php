<?php
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
header ("Location: index.php");
}else{ //Continue to current page
header( 'Content-Type: text/html; charset=utf-8' );
}

?>

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
						<h2>Edit Username <?php echo $_GET['desc']; ?><span class="req"></span></h2>>
					</div>
					<!-- End Box Head -->

<?php
if(isset($_POST['button'])){
        $errors = array(); // declaramos un array para almacenar los errores
        if($_POST['username'] == ''){
            $errors1 = '<span class="error2">Insert a UserName</span>';
        }else if($_POST['password'] == ''){
            $errors2 = '<span class="error2">Insert a Password</span>';
        }else{

		$host="localhost";
		$user="dialeruser";
		$pass="dialerpass";
		$db="dialerdb";
		$username=$_POST["username"];
		$password=$_POST["password"];

		$link = mysql_connect($host,$user,$pass) or die(mysql_error());
		mysql_select_db($db, $link);

		$sql1 = "UPDATE login_admin set user_pass=SHA('$password') where user_name='$username'";
		$result = mysql_query($sql1,$link) or die(mysql_error());


		$_POST['username'] = '';
		$_POST['password'] = '';
		
		
		echo "	<SCRIPT LANGUAGE='JavaScript'>
			 window.opener.location.reload();
			 window.close();
			 </SCRIPT>";
				
            
        }
    }
?>

					
					<form  id="contact-form" action="" method="post">
						
						<!-- Form -->
						<div class="form">
	

					<?php
						$desc=$_GET['desc'];

						$link = mysql_connect("localhost","dialeruser","dialerpass") or die (mysql_error());
					       mysql_select_db("dialerdb", $link);
						$sql="SELECT user_name,user_pass FROM login_admin WHERE user_name='$desc'";

						$res = mysql_query($sql,$link) or die(mysql_error());
						$row = mysql_fetch_assoc($res);
						$username=$row['user_name'];
						$password=$row['password'];

						

						echo "<p>
							<label>UserName<span><span><label>$errors1
							<input type='text' name=username class='field' value='$username' READONLY/>
							</p>
							
							<p>
							<label>Password<span><span><label>$errors2
							<input type=password name=password class='field' value='password'/>
							</p>";
							
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
