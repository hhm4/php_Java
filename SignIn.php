<?php


$config=parse_ini_file("/afs/cad/u/h/h/hhm4/public_html/.mysql.ini",false,true);
$con=mysql_connect($config['host'],$config['username'],$config['password']);

$dbcon=mysql_select_db($config['database'],$con);
if ($con){
	echo 'hari';
}
$email=$_POST['EmailId'];
$password=$_POST['Passsword'];
$authentication=mysql_query(" select * from USERS where EmailId='hhm4@njit.edu' AND User_Password='kinder9joy'",$con);
$count=mysql_num_rows($authentication);
$count=array('Result' => $count);
echo json_encode($count);
mysql_close();

?>
