<?php



 $q=$_GET["q"];
// set_time_zone()
 $con = mysql_connect('localhost', 'dialeruser', 'dialerpass');
 if (!$con)
   {
   die('Could not connect: ' . mysql_error());
   }

 mysql_select_db("dialerdb", $con);

 $sql="SELECT ID,IDcamp,Name,LastName,Tel,Tries,CallStatus,Deliver,SIP_CAUSE FROM " .$q. "  WHERE NameCamp = '" .$q. "'";
 $result = mysql_query($sql)or die(mysql_error());


echo"	<!-- Box -->
	<div class='box'>
	<!-- Box Head -->
	<div class='box-head'>
	<h2 class=left>Campaign Data</h2>
	<div class=right>
	<a href=down.php?q=$q class=add-button><span>Download Data</span></a>
	<div class=cl>&nbsp;</div>
	</div>
	</div>
	<form  id='contact-form' >
	<!-- Form -->
	<div class='form'>";

 echo " <div class='table'>
	<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	<tr>
	<th>ID</th>
	<th>Name</th>
	<th>LastName</th>
	<th>Telephone</th>
	<th>Tries</th>
	<th>CallStatus</th>
	<th>SIP Cause</th>
	<th>Deliver</th>
	<th>Control</th>
	</tr>";


 while($row = mysql_fetch_array($result))
   {
   echo "<tr>";
   echo "<td>" . $row['ID'] . "</td>";
   echo "<td>" . $row['Name'] . "</td>";
   echo "<td>" . $row['LastName'] . "</td>";
   echo "<td>" . $row['Tel'] . "</td>";
   echo "<td>" . $row['Tries'] . "</td>";
   echo "<td>" . $row['CallStatus'] . "</td>";
   echo "<td>" . $row['SIP_CAUSE'] . "</td>";
   echo "<td>" . $row['Deliver'] . "</td>";
echo '<td><a href=\'editcdata.php?pin='.$row['ID'].'&campname=' .$q. '\' onclick="return popup(this,\'sunny\')" class="ico edit">Edit</a></td>';

   }
  echo "</tr>";
  echo "</table></div><br></div></div></div></div></form>";


echo "<br>";

echo"	<!-- Box -->
	<div class='box'>
	<!-- Box Head -->
	<div class='box-head'>
	<h2>Campaign Sounds<span class='req'></span></h2>>
	</div>
	<form  id='contact-form' >
	<!-- Form -->
	<div class='form'>";

echo " <div class='table'>
        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr>
        <th>Sound</th>
        <th>Control</th>";
echo   '<th><a href=addsound.php?cp='.$q.' onclick="return popup(this,\'sunny\')" class="add-button"><span>Add Sound</span></a></th>';        
echo   "</tr>";



	$path = "/var/lib/asterisk/agi-bin/DialerCamps/$q/sounds/";

	// Open the folder 
    	$dir_handle = @opendir($path) or die("Unable to open $path"); 

    	// Loop through the files 
    	while ($file = readdir($dir_handle)) { 

    	if($file == "." || $file == ".." || $file == "index.php" ) 

        continue; 
        
//	echo "<a href=\"$file\">$file</a><br />"; 
	echo "<tr>";
	echo "<td>" .$file. "</td>";
	echo '<td><a href=\'delsound.php?snd='.$file.'&campname='.$q.'\' onclick="return popup(this,\'sunny\')" class="ico del">Delete</a></td>';


}
 
    // Close 
    closedir($dir_handle);

  echo "</tr>";
  echo "</table></div><br></div></div></div></div></form>";


 mysql_close($con);
?>
