<?php 

//require_once 'core.php';
require_once 'includes/config.php';
	
	$sql = "SELECT users_tbl.FullName,songs_tbl.SongName,songs_tbl.ISRCcode,songs_tbl.id,favsong_tbl.SubscriptionDate,favsong_tbl.SubscriptionCancelDate,favsong_tbl.id as rid from  favsong_tbl join users_tbl on users_tbl.UserId=favsong_tbl.UserId join songs_tbl on songs_tbl.id=favsong_tbl.SongId order by favsong_tbl.id desc";
	$query = $dbh -> prepare($sql);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Student Name</th>
			<th>Song Name</th>
			<th>Song ID</th>
			<th>ISRC Number</th>
			<th>Subscription Date</th>
			<th>Date of Cancellation</th>
		</tr>

		<tr>';
		$cnt=1;
		if($query->rowCount() > 0)
		{
		foreach($results as $result)
		{  
			//echo"<script>alert('".$result->FullName."')</script>";
			$table .= '<tr>
				<td><center>'.$result->FullName.'</center></td>
				<td><center>'.$result->SongName.'</center></td>
				<td><center>'.$result->id.'</center></td>
				<td><center>'.$result->ISRCcode.'</center></td>
				<td><center>'.$result->SubscriptionDate.'</center></td>
				<td><center>'.$result->SubscriptionCancelDate.'</center></td>
			</tr>';	
		}
		}
		$table .= '
		</tr>		
	</table>
	<button onClick="window.print()">Print this page</button>
	';	

	echo $table;



?>