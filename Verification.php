<?php


$config=parse_ini_file("/afs/cad/u/h/h/hhm4/public_html/.mysql.ini",false,true);
$con=mysql_connect($config['host'],$config['username'],$config['password']);
if(!$con)
{
	print "Not connected";
}
$dbCon=mysql_select_db($config['database'], $con);
$VerificationCode=$_POST['VerificationCode'];
$vc=intval($VerificationCode);
$email=$_POST['EmailId'];
$registration=mysql_query("Select count(*) From UNVERIFIED_USERS where Token='{$VerificationCode} AND Emailid= '".$email."'",$con);
#$registration=mysql_query("Select count(*) From UNVERIFIED_USERS where TOKEN=' ". $vc. " ' AND (EmailId=' ".$email. " ')",$con);
#$registration=mysql_query("CALL FetchUnverifiedUsers('$email','$vc')",$con);
echo $registration;
if ($registration=1){
	$row = mysql_fetch_array($registration, MYSQL_ASSOC);
	$name=$row['UserName'];
	$em=$row['User_Password'];
	$sql=mysql_query("Insert into USERS(UserName,EmailId,User_Password) values('{$name}','{$email}','{$em}')", $con);
	$delete=mysql_query("Delete FROM UNVERIFIED_USERS where EmailId='".$email."'",$con);
	$response=array("Result"=>1);
}
else{
	$response=array("Result"=>0,"Type"=>gettype($vc));
}
$encoded = json_encode($response);
header('Content-type: application/json');
echo $encoded;
mysql_close()
?>
