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
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#">Dialer System</a></h1>
			<div id="top-navigation">
				Welcome <strong><?php echo $_SESSION[name];?></strong>
				<span>|</span>
				<a href="#">Help</a>
				<span>|</span>
                                <a href="logout.php">logout</a>

			</div>
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <li><a href="upload.php" class="active" ><span>Create New Campaign</span></a></li>
			    <li><a href="campaigns.php"><span>Campaigns</span></a></li>
			    <li><a href="start.php"><span>Start Campiagn</span></a></li>
			    <li><a href="admins.php" class"active"><span>Administrators</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
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
		
		<!--<!-- Message OK -->		
		<!-- <div class="msg msg-ok">
			<p><strong>&nbsp;&nbsp;&nbsp;Please Insert the User Data</strong></p>			
		</div>
		<!-- End Message OK -->	
		
		<br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Create New Campaign<span class="req">&nbsp;&nbsp;(All data required)</span></h2>>
					</div>
					<!-- End Box Head -->
<?php
    if(isset($_POST['button'])){
        $errors = array(); // declaramos un array para almacenar los errores
        if($_POST['campname'] == ''){
            $errors1 = '<span class="error">Insert a Campaign Name</span>';
        }else if(!is_uploaded_file($_FILES['filenamecsv']['tmp_name'])){
	    $errors2 = '<span class="error">Select a File</span>';
        }else if(!is_uploaded_file($_FILES['Aud1']['tmp_name'])){
	    $errors3 = '<span class="error">Select an Audio File</span>';
        }else if(!is_uploaded_file($_FILES['Aud2']['tmp_name'])){
	    $errors4 = '<span class="error">Select an Audio File</span>';
	}
	else if(is_uploaded_file($_FILES['filenamecsv']['tmp_name'])) {
		echo "<div class='msg msg-ok'>
		<p><strong>Upload Successfully</strong></p>
		<a href='upload.php' class='close'>close</a>
		</div>";
		

		

		$host="localhost";
		$user="dialeruser";
		$pass="dialerpass";
		$db="dialerdb";
		$CampaignName=preg_replace("/ /",'_',$_POST['campname']);
		
		$link = mysql_connect($host,$user,$pass) or die(mysql_error());
		mysql_select_db($db, $link);


$sqlc="CREATE TABLE `$CampaignName` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDcamp` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `NameCamp` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Tel` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Tries` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CallStatus` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SIP_CAUSE` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Deliver` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";


		
		mysql_query($sqlc,$link);

		$sql=mysql_query("SELECT ID FROM  Campaign WHERE CampaignName='$CampaignName'", $link) or die(mysql_error());
		    if (mysql_num_rows($sql) == 0)
       			{
				$sql1="INSERT INTO Campaign(CampaignName,LastIdDial) VALUES('$CampaignName','0')";
				$res1=mysql_query($sql1,$link) or die(mysql_error());
			}

		$sql2="SELECT ID FROM Campaign WHERE CampaignName='" .$CampiagnName. "'";
		$res2=mysql_query($sql2,$link) or die("res2");
		$row = mysql_fetch_assoc($res2);
	        $myID = $row['ID'];
		echo $myID;

		//Import uploaded file to Database
		$handle = fopen($_FILES['filenamecsv']['tmp_name'], "r");
 
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$import="INSERT INTO " .$CampaignName. "(IDcamp,NameCamp,Name,LastName,Tel,Tries) values('$myID','$CampaignName','$data[0]','$data[1]','$data[2]','0')";
 		//echo $import;
		mysql_query($import) or die(mysql_error());
		}
 
		fclose($handle);
 
		
		exec("mkdir /var/lib/asterisk/agi-bin/DialerCamps/${CampaignName}");
		exec("mkdir /var/lib/asterisk/agi-bin/DialerCamps/${CampaignName}/sounds");
		
		$target_Path1 = "/var/lib/asterisk/agi-bin/DialerCamps/${CampaignName}/sounds/";
		$target_Path1 = $target_Path1.basename( $_FILES['Aud1']['name'] );
		move_uploaded_file( $_FILES['Aud1']['tmp_name'], $target_Path1 );

		$target_Path2 = "/var/lib/asterisk/agi-bin/DialerCamps/${CampaignName}/sounds/";
		$target_Path2 = $target_Path2.basename( $_FILES['Aud2']['name'] );
		move_uploaded_file( $_FILES['Aud2']['tmp_name'], $target_Path2 );






 	}
		

		$_POST['campname'] = '';
		header("REDIRECT 201 (upload.php)");
				
            
     }  
    
?>

					
					<form  enctype='multipart/form-data' id="contact-form" action="" method="post">
						
						<!-- Form -->
						<div class="form">
								
								<p>
									<label>Campaign Name<span></span></label><?php echo $errors1 ?>
									<input type=text class='field size1' name=campname id=campname value='<?php echo $_POST['campname']; ?>'>

								</p>
																	
								<p>
									<label>Import CSV File<span></span></label><?php echo $errors2 ?>
									<input type=file class='field size1' name=filenamecsv id=filenamecsv'>

								</p>
								<p>
									<label>Greeting Audio<span></span></label><?php echo $errors3 ?>
									<input type=file class='field size1' name=Aud1 id=Aud1'>

								</p>
								<p>
									<label>Message Audio<span></span></label><?php echo $errors4 ?>
									<input type=file class='field size1' name=Aud2 id=Aud2'>

								</p><br><br>

						</div>
						<!-- End Form -->
						
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
<!-- End Container -->


<p align="center">&copy; <a href="http://chocotemplates.com/" target="_blank">Design by ChocoTemplates</a> 2012 / Adapted for <a href="http://digital-merge.com" target="_blank">Digital-Merge</a></p><p align="center"><a href="http://about.me/navaismo" target="_blank"> Modified by Navaismo</a></p></body>
</html>

