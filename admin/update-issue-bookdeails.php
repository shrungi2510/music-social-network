<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
$status=$_GET['status'];
$days=$_GET['days'];
if(isset($_POST['return']))
{
$rid=intval($_GET['rid']);
$fine=$_POST['fine'];
$ISRCcode=$_GET['ISRCcode'];

$rstatus=1;
$sql="update favsong_tbl set fine=:fine,SubscriptionStatus=:rstatus where id=:rid";
$query = $dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->bindParam(':fine',$fine,PDO::PARAM_STR);
$query->bindParam(':rstatus',$rstatus,PDO::PARAM_STR);
$query->execute();

$sql="update songs_tbl set SubscribersCount=SubscribersCount-1 where ISRCcode=:ISRCcode";
$query = $dbh->prepare($sql);
$query->bindParam(':ISRCcode',$ISRCcode,PDO::PARAM_STR);
$query->execute();

$_SESSION['msg']="Subscription cancelled";
header('location:manage-subscribed-songs.php');


}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Music Network | Display Details</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_user.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_song.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Details</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Song Details
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$rid=intval($_GET['rid']);
$sql = "SELECT users_tbl.FullName,songs_tbl.SongName,songs_tbl.id,songs_tbl.ISRCcode,favsong_tbl.SubscriptionDate,favsong_tbl.SubscriptionCancelDate,favsong_tbl.id as rid,favsong_tbl.fine,favsong_tbl.SubscriptionStatus from  favsong_tbl join users_tbl on users_tbl.UserId=favsong_tbl.UserId join songs_tbl on songs_tbl.id=favsong_tbl.SongId where favsong_tbl.id=:rid";
$query = $dbh -> prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                   



<div class="form-group">
<label>User Name :</label>
<?php echo htmlentities($result->FullName);?>
</div>

<div class="form-group">
<label>Song Name :</label>
<?php echo htmlentities($result->SongName);?>
</div>


<div class="form-group">
<label>Song ID :</label>
<?php echo htmlentities($result->id);?>
</div>

<div class="form-group">
<label>ISRC Code :</label>
<?php echo htmlentities($result->ISRCcode);?>
</div>

<div class="form-group">
<label>Subscription Issued Date :</label>
<?php echo htmlentities($result->SubscriptionDate);?>
</div>

<div class="form-group">
<label>Cancellation Date :</label>
<?php if($result->SubscriptionCancelDate=="")
                                            {
                                                echo htmlentities("Not Return Yet");
                                            } else {
                                            echo htmlentities($result->SubscriptionCancelDate);
}?>
</div>

<div class="form-group">
<?php
$flag=0;
if(strpos($status,'exceeded')!== false && $result->SubscriptionCancelDate===NULL)
{
$flag=1;
	?>
<span><b>Fine To Be Paid:</b><?php echo htmlentities($days*$_SESSION['fine']);?></span>
<?php
}?>
</div>


<?php if($flag===1){?>
<div class="form-group">
<label>Subscription Cost (in Rs) :</label>
<input class="form-control" type="text" name="fine" id="fine" />
<?php }
else {
?>
<div class="form-group">
<label>Fine (in Rs) :</label>
<?php
if($result->fine===Null){
echo htmlentities("0");
}
else
{
	echo htmlentities($result->fine);
}
}
?></div>
</div>

 <?php if($result->SubscriptionStatus==0){?>
<div class="form-group">
<div class="row">
<div class="col-sm-8" style="padding-left:20px;padding-top:-20px;">
<button type="submit" name="return" id="submit" class="btn btn-info">Cancel Subscription </button>
</div>
</div>
</div>
<br>
 </div>

<?php }}}?>
                                    </form>
                            </div>
                        </div>
                            </div>
        </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
