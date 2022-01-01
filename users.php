<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else { 

    
    // $_SESSION["favanimal"] = "cat";
    $sid = $_SESSION['stdid'];
    $sql = "SELECT * from  users_tbl where id = :sid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sid', $sid, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $_SESSION["uname"] = $results[0]->FullName ;
    ?>
<!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Music Network | User Dash Board</title><link href="assets/css/bootstrap.css" rel="stylesheet" /><link href="assets/css/font-awesome.css" rel="stylesheet" /><link href="assets/css/style.css" rel="stylesheet" /><link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  </head>

  <body>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
    <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Site Users</h4>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Users List
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User fName</th>
                                                    <th>User lName </th>
                                                    <th>DOB</th>
                                                    <th>Address</th>
                                                    <th>Add Friend</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sid = $_SESSION['stdid'];
                                                $sql = "SELECT * from  users_tbl where id = :sid";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':sid', $sid, PDO::PARAM_INT);
                                                
                                                // $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $sname = $results[0]->FullName ;
                                                // $sql = "SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
                                                $sql = "SELECT * from  users_tbl";
                                                $query = $dbh->prepare($sql);
                                                // $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {               ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?php echo htmlentities($result->id); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->FullName); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->EmailId); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->MobileNumber); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->address); ?></td>
                                                            <td class="center">
                                                            <?php
                                                            $rql = "SELECT relationship FROM `friend_list` WHERE `user_first_id` = :ufi AND `user_second_id` = :usi;";
                                                            // $ql = "SELECT relationship from friend_list Where user_first_id = :user_first_id and user_second_id = :user_second_id";
                                                            $ruery = $dbh->prepare($rql);
                                                            $ruery->bindParam(':ufi', $sid, PDO::PARAM_INT);
                                                            $ruery->bindParam(':usi', $result->id, PDO::PARAM_INT);
                                                            $ruery->execute();
                                                            $qesult = $ruery->fetchAll(PDO::FETCH_OBJ);
                                                            // if ($ruery->rowCount() == 0) echo htmlentities("No");
                                                            // else 
                                                                // echo htmlentities($qesult[0]->relationship); 
                                                            if ($sid == $result->id) echo htmlentities("Cant Add Self as Friend");else 
                                                            if ($qesult[0]->relationship == "") {?>
                                                                <a href="relationship.php?user1=<?php echo $sid; ?>&user2=<?php echo $result->id; ?>&relation=PS"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i>Send Request</button><?php

                                                            } else if ($qesult[0]->relationship == "PS") {?>
                                                                <a href="relationship.php?user1=<?php echo $sid; ?>&user2=<?php echo $result->id; ?>&relation=N"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i>UnSend Request</button><?php

                                                            } else if ($qesult[0]->relationship == "PR") {?>
                                                                <a href="relationship.php?user1=<?php echo $sid; ?>&user2=<?php echo $result->id; ?>&relation=F"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i> accept</button><?php
                                                            } else if ($qesult[0]->relationship == "F") {?>
                                                                <a href="relationship.php?user1=<?php echo $sid; ?>&user2=<?php echo $result->id; ?>&relation=N"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i> Unfriend</button>
                                                                <?php if ($sid < $result->id) {
                                                                
                                                                    $_SESSION["user2"] = $result->id;
                                                                    $_SESSION["user1"] = $sid;
                                                                    $_SESSION["sname"] = $_SESSION["uname"];
                                                                    
                                                                ?>
                                                                <!-- <a href="chat.php?user1=<?php echo $sid; ?>&user2=<?php echo $result->id; ?>&sender=<?php echo $sid; ?>&sname=<?php echo $sname; ?>"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i> Chat</button> -->
                                                                <a href="chatmainfriends.php?uname=user1"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i> Chat</button>
                                                                <?php } else {
                                                                    $_SESSION["user1"] = $result->id;
                                                                    $_SESSION["user2"] = $sid;
                                                                    ?>
                                                                <!-- <a href="chat.php?user2=<?php echo $sid; ?>&user1=<?php echo $result->id; ?>&sender=<?php echo $sid; ?>&sname=<?php echo $sname; ?>"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i> Chat</button> -->
                                                                <a href="chatmainfriends.php?uname=user1"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i> Chat</button>
                                                                <?php
                                                            }}
                                                            ?>
                                                            
                                                            <!-- <a href="relationship.php?user1=<?php echo $sid; ?>&user2=<?php echo $result->id; ?>&relation=PS"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i>Send Request</button>
                                                            <a href="relationship.php?user1=<?php echo $sid; ?>&user2=<?php echo $result->id; ?>&relation=F"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i> accept</button>
                                                            <a href="relationship.php?user1=<?php echo $sid; ?>&user2=<?php echo $result->id; ?>&relation=N"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i> reject</button>
                                                            <a href="relationship.php?user1=<?php echo $sid; ?>&user2=<?php echo $result->id; ?>&relation=N"><button class="btn btn-primary" name="submit" id="submit" type="submit"><i class="fa fa-edit "></i> Unfriend</button> -->
                                                            </td>
                                                            
                                                            

                                                        </tr>
                                                <?php $cnt = $cnt + 1;
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>



                </div>
            </div>
        </div>

  </body>

  </html>
<?php } ?>