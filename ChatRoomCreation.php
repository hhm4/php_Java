<?php

$config=parse_ini_file("/afs/cad/u/h/h/hhm4/public_html/.mysql.ini",false,true);
$con=mysql_connect($config['host'],$config['username'],$config['password']);
if(!$con)
{
	print "Not connected";
}
$dbCon=mysql_select_db($config['database'], $con);

$groupchat=$_POST[IsGroupChat];
$userids=$_POST[UserIds];
$groupname=$_POST[GroupName];
$chatroomid=$_POST[ChatRoomId];

$isgroupchat = $groupchat === 'true'? true: false;

if($isgroupchat)
{

   $query="Select max(ChatRoomId) From CHATROOM_USERS";
   $maxroomid=mysql_query($query,$con);

   $grpchatroomid=$maxroomid < 10,00,000 ? 10,00,000: $maxroomid++;
   $response= array("Result"=>0);
/*    $sql=mysql_query("Insert into CHATROOM_USERS(ChatRoomId,UserIds,IsGroupChat,GroupName) values('{$grpchatroomid}','{$userids}','{$isgroupchat}','{$groupname}')", $con);
   $response = $sql ? array("Result"=>0):array("Result"=>2); */

}

else
{
	/* $sql=mysql_query("Insert into CHATROOM_USERS(ChatRoomId,UserIds,IsGroupChat,GroupName) values('{$chatroomid}','{$userids}','{$isgroupchat}','{$groupname}')", $con);
	$response = $sql ? array("Result"=>0):array("Result"=>2); */
	
}

$encoded = json_encode($response);
header('Content-type: application/json');
echo $encoded;
mysql_close();
?>
