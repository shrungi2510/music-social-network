
<html>

<head>
        <link rel="stylesheet" href="chat.css">
</head>
<body onload="show_func()">
    <div id="container">
        <main>
            <header>
                <!-- <img src="https://s3-us-west-2.amazonaws.com/
             s.cdpn.io/1940306/ico_star.png" alt=""> -->
                <div>
                    <h2>Chat</h2>
                </div>
                <!-- <img src="https://s3-us-west-2.amazonaws.com/
            s.cdpn.io/1940306/ico_star.png" alt=""> -->
            </header>

            <script>
                function show_func() {

                    var element = document.getElementById("chathist");
                    element.scrollTop = element.scrollHeight;

                }
            </script>

            <form id="myform" action="chatpmfriends.php" method="POST">
                <div class="inner_div" id="chathist">
                    <?php
                    $host = "localhost";
                    $user = "root";
                    $pass = "";
                    $db_name = "personal_chat";
                    $con = new mysqli($host, $user, $pass, $db_name);

                    $query = "SELECT * FROM chats";
                    $run = $con->query($query);
                    $i = 0;

                    while ($row = $run->fetch_array()) :
                        if ($i == 0) {
                            $i = 5;
                            $first = $row;
                    ?>
                            <div id="triangle1" class="triangle1"></div>
                            <div id="message1" class="message1">
                                <span style="color:white;float:right;">
                                    <?php echo $row['msg']; ?></span> <br />
                                <div>
                                    <span style="color:black;float:left;font-size:10px;clear:both;">
                                        <?php echo $row['UName']; ?>,
                                        <?php echo $row['dt']; ?>
                                    </span>
                                </div>
                            </div>
                            <br /><br />
                            <?php
                        } else {
                            // if ($row['uname'] != $first['uname']) {
                            if ($row['UName'] != $_GET['uname']) {
                            ?>
                                <div id="triangle" class="triangle"></div>
                                <div id="message" class="message"> <span style="color:white;float:left;">
                                        <?php echo $row['msg']; ?>
                                    </span> <br /><div><span style="color:black;float:right;font-size:10px;clear:both;">
                                            <?php echo $row['UName']; ?>,
                                            <?php echo $row['dt']; ?>
                                        </span>
                                    </div>
                                </div>
                                <br /><br />
                            <?php
                            } else {
                            ?>
                                <div id="triangle1" class="triangle1"></div>
                                <div id="message1" class="message1">
                                    <span style="color:white;float:right;">
                                        <?php echo $row['msg']; ?>
                                    </span> <br />
                                    <div>
                                        <span style="color:black;float:left;
         font-size:10px;clear:both;">
                                            <?php echo $row['UName']; ?>,
                                            <?php echo $row['dt']; ?>
                                        </span>
                                    </div>
                                </div>
                                <br /><br />
                    <?php
                            }
                        }
                    endwhile;
                    ?>
                </div>
                <footer>
                    <table>
                        <tr>
                            <th>
                                <!-- <input type="hidden" class="input1" type="text" id="uname" name="uname" placeholder="From" value = "test"> -->
                                <input type="hidden" class="input1" type="text" id="uname" name="uname" placeholder="From" value = "<?php echo $_GET['uname'];?>">
                            </th>
                            <th>
                                <textarea id="msg" name="msg" rows='3' cols='50' placeholder="Type your message">
            </textarea>
                            </th>
                            <th>
                                <input class="input2" type="submit" id="submit" name="submit" value="send">
                            </th>
                        </tr>
                    </table>
                </footer>
            </form>
        </main>
    </div>

</body>

</html>