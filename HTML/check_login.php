<?php
$username = $_POST['user']; //Set UserName
$password = $_POST['pwd']; //Set Password
$msg ='';
if(isset($username, $password)) {
    ob_start();

$link = mysql_connect('localhost','dialeruser','dialerpass') or die(mysql_error());
mysql_select_db('dialerdb', $link);

    $myusername = stripslashes($username);
    $mypassword = stripslashes($password);
    $sql="SELECT * FROM login_admin WHERE user_name='$myusername' and user_pass=SHA('$mypassword')";
    $result=mysql_query($sql, $link);
    $count=mysql_num_rows($result);
    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1){
        // Register $myusername, $mypassword and redirect to file "admin.php"
        /*session_register("admin");
        session_register("password");
        $_SESSION['name']= $myusername;*/

	session_start();
        $_SESSION['login'] = "1";
        $_SESSION['name']= $myusername;

        header("location:upload.php");
    }
    else {
        $msg = "Wrong Username or Password. Please retry&type=0";
        header("location:index.php?msg=$msg");
    }
    ob_end_flush();
}
else {
    header("location:index.php?msg=Please enter  username and password");
}
?>
