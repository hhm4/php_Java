<?php
$config=parse_ini_file("/afs/cad/u/h/h/hhm4/public_html/.mysql.ini",false,true);
$con=mysql_connect($config['host'],$config['username'],$config['password']);
if(!$con)
{
	print "Not connected";
}
$dbCon=mysql_select_db($config['database'], $con);
$email=$_POST['EmailId'];
$query="select * from USERS where EmailId='$email'";
$query1="select * from Token_Verification where EmailId='$email'";
$authentication=mysql_query($query,$con);
$emailauthentication=mysql_query($query1,$con);
$count=mysql_num_rows($authentication);
$count1=mysql_num_rows($emailauthentication);
if($count>0 && $count1 =0)
{
$id= rand(1000000,2000000);
$verification=mysql_query("Insert into Token_Verification(EmailId,Token) values ('{$email}',$id)", $con);

			mail($email, "Password Reset", "Password Reset Token :".$id);
			$response=array("Result"=>0);
}
else
{
	
	$response=array("Result"=>1);
	
}
$encoded = json_encode($response);
header('Content-type: application/json');
echo $encoded;

mysql_close();


?>