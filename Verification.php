<?php


$config=parse_ini_file("/afs/cad/u/h/h/hhm4/public_html/.mysql.ini",false,true);
$con=mysql_connect($config['host'],$config['username'],$config['password']);
if(!$con)
{
	print "Not connected";
}
$dbCon=mysql_select_db($config['database'], $con);
$VerificationCode=$_POST['VerificationCode'];
$email=$_POST['EmailId'];

$registration=mysql_query("Select * From UNVERIFIED_USERS where TOKEN='{$VerificationCode}' AND EmailId='{$email}' ",$con);
if ($registration){
	$row = mysql_fetch_array($registration, MYSQL_ASSOC)
	$name=$row['UserName'];
	$pass=$row['Password'];
	$em=$row['User_Password'];
	$sql=mysql_query("Insert into USERS(UserName,EmailId,User_Password) values('$name','$pass','$em')", $con);
	$delete=mysql_query("Delete FROM UNVERIFIED_USERS where EmailId='$em'",$con);
	$response=array("Result"=>1);
}
else{
	$response=array("Result"=>0);
}
$encoded = json_encode($response);
header('Content-type: application/json');
echo $encoded;
mysql_close()
?>