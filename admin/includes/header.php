<div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">

                    <img src="assets/img/logo.png" />
                </a>

            </div>

            <div class="right-div">
                <a href="logout.php" class="btn btn-danger pull-right">LOG ME OUT</a>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
            <div class="container" style="left:0">
			<div class="row">
                <div class="col-md-15" >
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>
                           
                            <li>
                                <a href="#" class="dropdown-toggle " style="" id="ddlmenuItem" data-toggle="dropdown"> Albums <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-album.php" >Add Album</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-albums.php">Manage Albums</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Artists <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-artists.php">Add Artist</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-artists.php">Manage Artists</a></li>
                                </ul>
                            </li>
 <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Song <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-song.php">Add Song</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-songs.php">Manage Songs</a></li>
									 <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="set-fine.php">Update Song</a></li> -->
                                </ul>
                            </li>
                            
							
							
                           <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Subscriptions <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="issue-song.php">New Subscription</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-subscribed-songs.php">Manage Subscription</a></li>
                                </ul>
                            </li>
							
							<li><a href="manage-requested-books.php" class="menu-top-active">Subscription Requests</a></li>
							<li><a href="report.php" class="menu-top-active">Report</a></li>
                           
                             <li><a href="reg-students.php">Registered Users</a></li>
                    
  <li><a href="change-password.php">Change Password</a></li>
                        </ul>
                    </div>
                </div>
			 </div>
        </div>
    </section>