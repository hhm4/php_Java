<?php
$config=parse_ini_file("/afs/cad/u/h/h/hhm4/public_html/.mysql.ini",false,true);
$con=mysql_connect($config['host'],$config['username'],$config['password']);
if(!$con)
{
	print "Not connected";
}
$dbCon=mysql_select_db($config['database'], $con);
$username=$_POST['UserName'];
$password=$_POST['Password'];
$email=$_POST['EmailId'];

$sql=mysql_query("Insert into hhm4.USERS(UserName,EmailId,User_Password) values ($username,$password,$email)", $con);

if($sql)
	{
		echo "Success123";
	}
mysql_close();
?>