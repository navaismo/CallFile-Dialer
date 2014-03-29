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
  			    <li><a href="upload.php"><span>Create New Campaign</span></a></li>
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
			





<!--------------------       ------->

<?php
			$link = mysql_connect("localhost","dialeruser","dialerpass") or die(mysql_error());
		        mysql_select_db("dialerdb", $link);
			$sql="SELECT user_name FROM login_admin order by user_name asc";
			$res=mysql_query($sql,$link) or die (mysql_error());
			$fields_num = mysql_num_fields($res);		
			
			echo"	<!-- Content -->
				<div id='sidebar'>
				<!-- Box -->
				<div class='box'>
				<!-- Box Head -->
				<div class='box-head'>
				<h2>Administrators<span class='req'></span></h2>>
				</div>
				<form  id='contact-form' >
				<!-- Form -->
				<div class='form'>";

			 echo " <div class='table'>
				<table width='100%' border='0' cellspacing='0' cellpadding='0'>";

			echo "<tr>";
			for($i=0; $i<$fields_num; $i++)
			{
				$field = mysql_fetch_field($res);
			    	echo "<th><b>{$field->name}</b></th>";
			}
			echo "<th>Control</th>";
			echo "</tr>\n";
			$id="test";
			while($row = mysql_fetch_row($res))
			{
				echo "<tr>";

			    foreach($row as $cell)
		        echo "<td>$cell</td>";
			echo "<td><a href='deladmin.php?desc=$cell' class='ico del'>Delete</a>";
echo '<a href=\'editadmin.php?desc='.$cell.'\' onclick="return popup(this,\'windi\')" class="ico edit">Edit</a></td>
			</tr>';
			}

 			 echo "</table></div></div></div></form></div></div>";
			mysql_free_result($result);
			?>

			
			
			<!-- Content -->
			<div id="content3">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Add New Administrator<span class="req"></span></h2>>
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

		$sql1 = "INSERT INTO login_admin (user_name,user_pass) VALUES('$username',SHA('$password'))";
		$result = mysql_query($sql1,$link) or die(mysql_error());

	

		$_POST['username'] = '';
		$_POST['password'] = '';
		header("Location: admins.php");
				
            
        }
    }
?>



					
					<form  id="contact-form" action="" method="post">
						
						<!-- Form -->
						<div class="form">
								
								
								<p>
									<label>UserName<span></span></label><?php echo $errors1 ?>
									<input type=text class='field' name=username id=username value='<?php echo $_POST['prefix']; ?>'>

								</p>	


								<p>
									<label>Password<span></span></label><?php echo $errors2 ?>
									<input type=password class='field' name=password id=password value='<?php echo $_POST['cost']; ?>'>

								</p>	

							
							
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
			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
</div>

<!-- End Container -->


	
<p align="center">&copy; <a href="http://chocotemplates.com/" target="_blank">Design by ChocoTemplates</a> 2012 / Adapted for <a href="http://digital-merge.com" target="_blank">Digital-Merge</a></p><p align="center"><a href="http://about.me/navaismo" target="_blank"> Modified by Navaismo</a></p></body>
</html>
