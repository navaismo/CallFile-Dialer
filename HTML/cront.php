#!/usr/bin/php -q
<?php
set_time_limit(30);

$campname=exec("pwd | awk -F/ '{ print \$NF;}'");
echo $campname;

$exist=exec("ls -lha /var/spool/asterisk/outgoing/*" .$campname. "* | grep -c call");
if($exist > 0){
	exit();
}else{
	
$host='localhost';
$user='dialeruser';
$pass='dialerpass';
$db='dialerdb';
$range=0;
$link = mysql_connect($host,$user,$pass) or die(mysql_error());
mysql_select_db($db, $link);


	$sql="SELECT LastIdDial from Campaign WHERE CampaignName='" .$campname. "'";
        $res=mysql_query($sql,$link) or die("sql1".mysql_error());
        $row = mysql_fetch_assoc($res);
        $lastID = $row['LastIdDial'];
	echo $lastID;

	$sql="SELECT MaxCalls from Campaign WHERE CampaignName='" .$campname. "'";
        $res=mysql_query($sql,$link) or die("sql1".mysql_error());
        $row = mysql_fetch_assoc($res);
        $calls = $row['MaxCalls'];
	echo $calls;


	$range = $lastID + $calls;
	
	for( $i=$lastID; $i<=$range; $i++){
		exec("mv /var/lib/asterisk/agi-bin/DialerCamps/" .$campname. "/" .$i. "_* //var/lib/asterisk/agi-bin/DialerCamps/");
	}


	$sqlu="UPDATE Campaign SET LastIdDial='" .$range. "' WHERE CampaignName='" .$campname. "'";
 	mysql_query($sqlu,$link) or die("sql3".mysql_error());
}
?>
