<?php
#error_reporting(0);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)

// Report all errors except E_NOTICE

// Same as error_reporting(E_ALL);
$config=parse_ini_file('/afs/cad/u/h/h/hhm4/.my.cnf');
$con=mysql_connect($config['host'],$config['username'],$config['password']);
if(!$con)
{
	print "Not connected";
}
$dbCon=mysql_select_db($config['database'], $con);
print "connected".$dbCon;
$sql=mysql_query('SELECT GroupName FROM CHATROOM_USERS', $con);

while($row = mysql_fetch_assoc($sql))
{
echo $row['GroupName'];

}
?>
