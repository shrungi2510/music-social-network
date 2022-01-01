<?php
if($_SESSION['thread1']==0)
{
include('includes/config.php');
$date=Date('Y/m/d');

$ret="select * from tblfine where 1";
$query= $dbh -> prepare($ret);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{
$_SESSION['fine']=$result->fine;
}
}

$ret="select SongId,UserID,SubscriptionDate from favsong_tbl where SubscriptionStatus=0";
$query= $dbh -> prepare($ret);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{	
$date2=Date("Y/m/d",strtotime($result->SubscriptionDate));
$diff=strtotime($date)- strtotime($date2);
$days=floor($diff/86400);
	if($days>7){
	$days=$days-7;
	//echo"<script>alert('".$days."')</script>";
	$totalfine=$days*$_SESSION['fine'];
	$ret1="select * from overdue where UserID=:id";
	$query1= $dbh -> prepare($ret1);
	$query1 -> bindParam(':id',$result->UserID, PDO::PARAM_STR);
	$query1-> execute();
	$res=$query1->fetchAll(PDO::FETCH_OBJ);
		if($query1->rowCount()<=0){
			$sql="INSERT INTO overdue(UserID,Fine,UserName,MobNumber) VALUES(:studentid,:fine,:name,:number)";
			$query2 = $dbh->prepare($sql);
			
			
			$sq="select FullName,MobileNumber from users_tbl where UserId=:studentid";
			$query4 = $dbh->prepare($sq);
			$query4->bindParam(':studentid',$result->UserID,PDO::PARAM_STR);
			$query4->execute();
			$res1=$query4->fetch(PDO::FETCH_OBJ);
			
			$query2->bindParam(':studentid',$result->UserID,PDO::PARAM_STR);
			$query2->bindParam(':fine',$totalfine,PDO::PARAM_STR);
			$query2->bindParam(':name',$res1->FullName,PDO::PARAM_STR);
			$query2->bindParam(':number',$res1->MobileNumber,PDO::PARAM_STR);
			$query2->execute();
			$lastInsertId = $dbh->lastInsertId();
		}
		else{
			$sql1="update overdue set Fine=Fine+:fine where UserID=:studentid";
			$query3 = $dbh->prepare($sql1);
			$query3->bindParam(':fine',$totalfine,PDO::PARAM_STR);
			$query3->bindParam(':studentid',$result->UserID,PDO::PARAM_STR);
			$query3->execute();	
		}

	}
}
}
$_SESSION['thread1']=1;
}
 ?>