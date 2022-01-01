<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$bookname=$_POST['bookname'];
$category=$_POST['category'];
$author=$_POST['author'];
$isbn=$_POST['isbn'];
$price=$_POST['price'];
$bookid=intval($_GET['bookid']);
$Copies=($_GET['Copies']);
$sql="update songs_tbl set SongName=:bookname,CatId=:category,ArtistId=:author,ISRCcode=:isbn,SubscriptionPrice=:price,Copies=:Copies where id=:bookid";
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
$query->bindParam(':price',$price,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->bindParam(':Copies',$Copies,PDO::PARAM_STR);
$query->execute();
$_SESSION['msg']="Book info updated successfully";
header('location:manage-songs.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Music Network | Edit Song</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

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
                <h4 class="header-line">Add Song</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Song Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$bookid=intval($_GET['bookid']);
$sql = "SELECT songs_tbl.SongName,album_tbl.Album_name,songs_tbl.Copies,album_tbl.id as cid,tbl_artists.ArtistName,tbl_artists.id as athrid,songs_tbl.ISRCcode,songs_tbl.SubscriptionPrice,songs_tbl.id as bookid from  songs_tbl join album_tbl on album_tbl.id=songs_tbl.CatId join tbl_artists on tbl_artists.id=songs_tbl.ArtistId where songs_tbl.id=:bookid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<div class="form-group">
<label>Song ID</label>
<input class="form-control" type="number" name="bookid" value="<?php echo htmlentities($result->bookid);?>" readonly />
</div>

<div class="form-group">
<label>Song Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->SongName);?>" required />
</div>

<div class="form-group">
<label> Album<span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value="<?php echo htmlentities($result->cid);?>"> <?php echo htmlentities($catname=$result->Album_name);?></option>
<?php 
$status=1;
$sql1 = "SELECT * from  album_tbl where Status=:status";
$query1 = $dbh -> prepare($sql1);
$query1-> bindParam(':status',$status, PDO::PARAM_STR);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
if($catname==$row->Album_name)
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->Album_name);?></option>
 <?php }}} ?> 
</select>
</div>


<div class="form-group">
<label> Artist<span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->ArtistName);?></option>
<?php 

$sql2 = "SELECT * from  tbl_artists ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
if($athrname==$ret->ArtistName)
{
continue;
} else{

    ?>  
<option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->ArtistName);?></option>
 <?php }}} ?> 
</select>
</div>

<div class="form-group">
<label>ISCR Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISRCcode);?>"  required="required" />
<p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
</div>
 
  <div class="form-group">
 <label>User Subscriber<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="copies" value="<?php echo htmlentities($result->Copies);?>"   required="required" />
 </div>
  
 <div class="form-group">
 <label>Subcription Cost<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->SubscriptionPrice);?>"   required="required" />
 </div>
 <?php }} ?>
<button type="submit" name="update" class="btn btn-info">Update </button>

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
<?php } ?>
