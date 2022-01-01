<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
$UserID=$_GET['UserID'];
$User_name=$_GET['User_name'];
$ISRCcode=$_GET['ISRCcode'];
$SongName=$_GET['SongName'];
$ArtistName=$_GET['ArtistName'];
$Album_name=$_GET['Album_name'];
$SubscriptionPrice=$_GET['SubscriptionPrice'];

$sql = "SELECT * from reqsubscription_tbl where UserID=:UserID and ISRCcode=:ISRCcode";
$query = $dbh -> prepare($sql);
$query->bindParam(':UserID',$UserID,PDO::PARAM_STR);
$query->bindParam(':ISRCcode',$ISRCcode,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
$_SESSION['msg']="You have already requested this book";
header('location:req-song.php');
}
else{
  $sql = "SELECT * from reqsubscription_tbl where UserID=:UserID";
  $query = $dbh -> prepare($sql);
  $query->bindParam(':UserID',$UserID,PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query->rowCount() == 2)
  {
	$_SESSION['msg']="You cannot request more than 2 books at a time";
	header('location:req-song.php');
  }
  else 
  {
	$sql="INSERT INTO reqsubscription_tbl(UserID,User_name,SongName,Album_name,ArtistName,ISRCcode,SubscriptionPrice) VALUES(:UserID,:User_name,:SongName,:Album_name,:ArtistName,:ISRCcode,:SubscriptionPrice)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':UserID',$UserID,PDO::PARAM_STR);
	$query->bindParam(':User_name',$User_name,PDO::PARAM_STR);
	$query->bindParam(':SongName',$SongName,PDO::PARAM_STR);
	$query->bindParam(':Album_name',$Album_name,PDO::PARAM_STR);
	$query->bindParam(':ArtistName',$ArtistName,PDO::PARAM_STR);
	$query->bindParam(':ISRCcode',$ISRCcode,PDO::PARAM_STR);
	$query->bindParam(':SubscriptionPrice',$SubscriptionPrice,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	$_SESSION['msg']="Book requested successfully";
	header('location:req-song.php');
  }
}
}?>


