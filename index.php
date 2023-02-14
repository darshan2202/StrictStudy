<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/icons/favicon.ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link  rel="stylesheet" href="style.css">
    <title>StrictStudy - Music & Study </title>
</head>
<body>
<span class="loader"></span>
    <header class="top">
    <a href="index.php"><img id="logo" src="images/logo.png" width="100px" height="70px" alt="logo"></a> 
    <span id="timer">00:00</span>
    <button id='loginbtn' onclick='loginform()'>Login</button>
    <div class="account">
    <span class="material-icons md-40">account_circle</span> <br> Account
        <div class="dropdown-content">
            <li onclick="showStats()">My Stats</li>
            <form action="logout.php">
             <input type="submit" value="Log Out" id="logoutbtn">
            </form>
        </div>
    </div>
    </header>
    <div class="grid-container-element">
        <!--Sidebar-->
    <nav class="sidebar">
        <ul>
            <!--<li id="oc">OPEN</li>-->
            <li id="goals" onclick="showGoals()"><span class="material-icons md-40">list_alt</span> <br> Goals</li>
            <li id="time" onclick="showTimer()"><span class="material-icons md-40">timer</span><br>Timer</li>
            <li><a href="studytips.html" target="_blank">&nbsp;<span class="material-icons md-40">tips_and_updates</span><br>Study<br>&nbsp;Tips</a> </li>
            <li id="about"> <a href="about.html" target="_blank"><span class="material-icons md-44">groups</span><br>About</a></li>
        </ul>
        </nav> 
            <!-- Goals-->
    <div id="goals-box">
            <h2>Goals</h2>
            <input type="text" id="goal_text" autofocus=true>
            <button id="addGoal" onclick="addGoalFunction(goal_text)">ADD</button>
            <div id="goal_list"></div>
            <div class="goal_records">
                <hr>
            <span id="goals_info">Remaining</span>
            <span id="divider"></span>
            <span id="goals_info">Completed</span> <br>
            <span id="goals_remaining">0</span>
            <span id="goals_completed">0</span>
            </div>
    </div>
    <!--Timer Function-->
    <div id="fulltimer">
        <div class="studytime"> <!-- Study time interface -->
            Study Time
            <button id="subtract_study" class="additionalTime" onclick="subtractFuntion(1)">-</button> <!-- Subtract button -->
            <span id="stime">25:00</span>
            <button id="addition_study" class="additionalTime" onclick="additionFuntion(1)">+</button> <!-- Addition button -->
        </div>
        <hr id="timerHr">
        <div class="breaktime"> <!-- Break time interface -->
            Break Time
            <button id="subtract_break" class="additionalTime" onclick="subtractFuntion(2)">-</button> <!-- Subtract button -->
            <span id="btime">10:00</span>
            <button id="addition_break" class="additionalTime" onclick="additionFuntion(2)">+</button><br> <!-- Addition button -->
        </div>
    <div class="buttons">
        <button class="timerButton" onclick="timefunction()" id="submit">SET</button><!-- Set button -->
        <button class="timerButton" onclick="resetTitle()" title="Click to reset timer">RESET</button> <!-- Reset button-->
        <button id="musicNote" value="true" title="For Alert Sound">
            <span class="material-icons md-music" id="alertsound" onclick="musicFunction()">volume_up
            </span>
        </button>
        </div>
        <audio id="audioFunction()">
            <source src="mixkit-positive-interface-beep-221.wav" type="audio/mpeg">
        </audio>
    </div>
    </div>
        <!--Quote-->
        <div class="quote-container">
            <p id="quote"></p>
            <small id="author"></small>
    </div>
    <!-- Login Form-->
    <div class="form-container">
                <img src="images/logo-black.png" width="90px" height="60px" id="sslogo"> <span id="closeForm">X</span>
                <h1 id="form-title">Login</h1>
            <div class="form-tabs">
                <span id="logintab">Login</span>
                <span id="signuptab">Signup</span>
            </div>
            <div class="main-form">
                <!--Login Form-->
                <form action="login.php" class="login-form" method="post">
                    <div class="form-input">
                        <label for="email">Email</label> <br>
                        <input type="email" class="form-control" id="email" name ="email" placeholder="Enter email" required> 
                    </div>
                    <div class="form-input">
                        <label for="password">Password</label><br>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required minlength="6"> 
                    </div>
                    <button type="submit">Login</button>
                </form>
                <!--Signup Form-->
                <form action="signup.php" class="signup-form" method="post">
                    <div class="form-input">
                        <label for="username">Username</label><br>
                        <input type="text" class="form-control" id="username" name ="username" placeholder="Enter username" Required> 
                    </div>
                    <div class="form-input">
                        <label for="email">Email</label><br>
                        <input type="email" class="form-control" id="email" name ="email" placeholder="Enter email" Required>
                    </div>
                    <div class="form-input">
                        <label for="password">Password</label><br>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" Required>
                    </div>
                    <div class="form-input">
                        <label for="cpassword">Confirm Password</label><br>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Re-enter the password" Required>
                    </div>
                    <button type="submit">Signup</button>
                </form>
            </div>
    </div>
   <!-- Stats  -->    
   <div class="stats-container">
   <span id="closeStats">X</span>
    <table class="stats-table">
        <tr id="table-heading">
            <th>DATE</th>
            <th>Total Study Time</th>
            <th>Total Break Time</th>
        </tr>
        <?php
        include 'condatabase.php';
        $email = $_SESSION['email'];
        $usersql = "SELECT `username` FROM `signup` WHERE email = '$email'";
        $results =  mysqli_query($conn, $usersql);
        $userarray =mysqli_fetch_array($results);
        $username = $userarray[0];
        
        $sql="SELECT * FROM $username";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result))
        {
        echo "<tr>";
        echo "<td>".$row['dt']."</td>"; 
        echo "<td>".$row['studytimecount']." min"."</td>";
        echo "<td>".$row['breaktimecount']." min"."</td>";
        echo "</tr>";
        }
        mysqli_close($conn);
        ?>
    </table>
   </div>      

<!-- Spotify Music Player  --> 
<img  id="spotify" src="images/spotifylogo.png" width="60px" height="60px"
    onclick="showMusicPlayer()" title="Open Spotify Music Player" >
    <div id="musicplayer">
        <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/37i9dQZF1DX8Uebhn9wzrS?utm_source=generator&theme=0" width="40%" height="100" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy" ></iframe>
        <span class="material-icons md-38" title="Close" onclick="closeMusicPlayer()">close</span> 
    </div>  
<script src="functions.js"></script> 
<?php 
if(isset($_SESSION['loggedin'])) {
    if($_SESSION['loggedin']==false){
        echo "<script>document.querySelector('.account').style.display = 'none';
        document.querySelector('#loginbtn').style.display = 'block';</script>";
        
    }else{
        echo "<script>document.querySelector('.account').style.display = 'block';
        document.querySelector('#loginbtn').style.display = 'none';</script>";
    }
}
?>
<?php  
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
            exit;
        }
        else{
             if (isset($_COOKIE["usecookie"]) && $_COOKIE["usecookie"]== "true"){
                        include 'condatabase.php';
                        $sessionStudyTime =  $_COOKIE["sessionStudyTime"];
                        $sessionBreakTime = $_COOKIE["sessionBreakTime"];
                        $sessionDate = $_COOKIE["sessionDate"]; 
                         $email = $_SESSION['email'];
                         
                          $usersql = "SELECT `username` FROM `signup` WHERE email = '$email'";
                        $results =  mysqli_query($conn, $usersql);
                        $userarray =mysqli_fetch_array($results);
                        $username = $userarray[0];
                         
                        $sql = "SELECT * FROM $username WHERE dt = '$sessionDate'";
                        $result = mysqli_query($conn, $sql);
                    
                        if (mysqli_num_rows($result) > 0){
                            foreach($result as $row){
                                    $stime="SELECT `studytimecount` FROM $username WHERE dt = '$sessionDate'" ; 
                                    $stimeresult = mysqli_query($conn, $stime);
                                    $row =mysqli_fetch_array($stimeresult);
                                    
                                    $sessionStudyTime = $sessionStudyTime +$row[0];
                                
                                    $btime= "SELECT `breaktimecount` FROM $username WHERE dt = '$sessionDate'"; 
                                    $btimeresult = mysqli_query($conn, $btime);
                                    $breakrow =mysqli_fetch_array($btimeresult);
                                    $sessionBreakTime =  $sessionBreakTime + $breakrow[0];
                                    
                                $sql = "UPDATE $username` SET `studytimecount` = '$sessionStudyTime' ,`breaktimecount` = '$sessionBreakTime' WHERE `timecount`.`dt` = '$sessionDate'";
                                    $result = mysqli_query($conn, $sql);
                            }
                        }
                        else{
                            $insertqry ="INSERT INTO $username (`dt`, `studytimecount`, `breaktimecount`) VALUES ('$sessionDate', '$sessionStudyTime' ,'$sessionBreakTime')";
                            $result = mysqli_query($conn, $insertqry);
                        }
          
                }
            }
        ?>
</body>
</html>