<?php


$snd=$_GET["snd"];
$campname=$_GET["campname"];

exec("rm /var/lib/asterisk/agi-bin/DialerCamps/$campname/sounds/$snd");

	echo "  <SCRIPT LANGUAGE='JavaScript'>
          window.opener.document.location='campaigns.php?pin=$campname'
            window.close();
           </SCRIPT>";
?>
