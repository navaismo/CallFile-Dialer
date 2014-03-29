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

	<script language="Javascript">
 		function showUser(str){
		 if (str==""){
		   document.getElementById("txtHint").innerHTML="";
			return;
		 } 
		 if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
			}
		}
 
		xmlhttp.open("GET","getcdata.php?q="+str,true);
		xmlhttp.send();
		 		
		
		}
	
	 </script>

	<script>
	function pin(str){
		 if (str==""){
		   document.getElementById("txtHint").innerHTML="";
			return;
		 } 

		if (typeof str =="undefined"){
		   document.getElementById("txtHint").innerHTML="";
			return;
		 } 

		 if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
			}
		}
 
		xmlhttp.open("GET","getcdata.php?q="+str,true);
		xmlhttp.send();
		 		
		
		}
</script>

<script>
function popup(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == 'string')
   href=mylink;
else
   href=mylink.href;
window.open(href, windowname, 'location=0,width=320,height=420,resizable=0,scrollbars=no');
return false;
}
</script>
</head>
<?php
if (isset($_GET['pin'])){
echo '<body onload=javascript:pin("'.$_GET['pin'].'")>';
}else{
echo "<body>";
}
?>
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
			    <li><a href="upload.php" ><span>Create New Campaign</span></a></li>
			    <li><a href="campaigns.php" class="active"><span>Campaigns</span></a></li>
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
		
		<!-- Message OK		
		<div class="msg msg-ok">
			<p><strong>&nbsp;&nbsp;&nbsp;Please Insert the User Data</strong></p>			
		</div>
		<!-- End Message OK -->		
		
		<br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content2">

				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Select A Campaign<span class="req"></span></h2>>
					</div>
					<!-- End Box Head -->


					<form  name="form1" id="contact-form" >
						
						<!-- Form -->
						<div class="form">
								
								<p>
									<label>Campaign Name<span></span></label>
									<?php

							                $link = mysql_connect("localhost","dialeruser","dialerpass") or die(mysql_error());
							                mysql_select_db("dialerdb", $link);
							                $res = mysql_query("SELECT  CampaignName FROM Campaign ORDER BY CampaignName asc") or die("Invalid query: " .mysql_error());           
									echo "<select class='field size3' name='campname' id='campname'onchange='javascript:showUser(this.value)'>";
									echo " <option value=''>- Choose -</option>";
									while ($row = mysql_fetch_assoc($res)) {
							                 $va = $row['CampaignName'];
							                 echo "<option value='$va'>$va</option>";
                 							}
									?>
									 </select>
		

								</p>
							
						</div>                 
					</form>
			</div>



				<!-- Box -->
				<div class="box">
					

					<form  id="contact-form" >
						
						<!-- Form -->
						<div class="form">

							<div id="txtHint">Select a Campaign to show the data
							



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
