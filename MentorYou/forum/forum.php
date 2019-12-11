<?php
//include ('../functions.php');
include ('forum_functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

//echo session_id();
?>
<!DOCTYPE html>
<html>
<head>
<title>MentorYou forum</title>
<script src = "../js/jquery.js"></script>
<script type = "text/javascript" src = "../js/script.js"></script>
<link rel="stylesheet" href="../style.css">
<link href="https://fonts.googleapis.com/css?family=Handlee&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto|Share+Tech+Mono&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>

    
        <div class = header>
            
            <button class="btn" style="background: none; font-weight: light;font-family: 'Great Vibes', cursive;font-size: 36px;"><a>MentorYou</a></button>

            

            <div class = dropdown> 
                <button class="btn" ><a><?php echo display_header_username();?></a></button>
                <div class="content">
                    <a href="profile.php">Profile</a>
                    <a href="../login.php?logout='1'">Logout</a>
                </div>
            </div>

            <div class="dropdown">
                
                <button type="button" class="btn"><a>notif</a></button>

                <div class="content" id="notif-content">
                    <?php echo display_notification();?>
                </div>

            </div>

        </div>
    


    <div class = tags>
        <a href="forum.php?tag=1">Find Trending</a><br>
        <a href="forum.php?tag=2">IOT</a><br>
        <a href="forum.php?tag=3">Cyber Security</a><br>
        <a href="forum.php?tag=4">Data Science</a><br>
    </div>
    
    <div class="main">
    <?php if(!isset($_GET['tag'])){echo display_forum_questions();}
       
       if(isset($_GET['tag'])){
    if($_GET['tag']==1){
            

        $sql = "SELECT * FROM `Question_details` ORDER BY `upvote` DESC"; 
        if ($res = mysqli_query($db, $sql)) { 
            if (mysqli_num_rows($res) > 0) { 
                
                while ($row = mysqli_fetch_array($res)) { 
                    
                echo "<br><br>";
                echo "<div class = question-box >";
                //echo "<div class = upvote-count>".$row['upvote']."</div>";
                echo "<a href=forum.php?qid=".$row['PKquestion_id']." class = question>".$row['question_title']."</a><br>";
                echo "<span class = question-username>".$row['user_name']."</span>";
                //echo "<span class = replies>6 replies</span>";
                echo "<span class = question-date>".$row['date']."</span>";
                echo "</div>";
                        
                } 
                //echo "</table>"; 
                //mysqli_free_res($res); 
            } 
            else { 
                echo "No records are found."; 
            } 
        } 
    }

    if($_GET['tag']==2){
            

        $sql = "SELECT * FROM `Question_details` WHERE `tag_name`='iot' ORDER BY `upvote` DESC;"; 
        if ($res = mysqli_query($db, $sql)) { 
            if (mysqli_num_rows($res) > 0) { 
                
                while ($row = mysqli_fetch_array($res)) { 
                    
                echo "<br><br>";
                echo "<div class = question-box >";
                //echo "<div class = upvote-count>".$row['upvote']."</div>";
                echo "<a href=question_answer.php?qid=".$row['PKquestion_id']." class = question>".$row['question_title']."</a><br>";
                echo "<span class = question-username>".$row['user_name']."</span>";
                //echo "<span class = replies>6 replies</span>";
                echo "<span class = question-date>".$row['date']."</span>";
                echo "</div>";
                        
                } 
                //echo "</table>"; 
                //mysqli_free_res($res); 
            } 
            else { 
                echo "No records are found."; 
            } 
        } 
    }

    if($_GET['tag']==3){
            

        $sql = "SELECT * FROM `Question_details` WHERE `tag_name`='cyber_security' ORDER BY `upvote` DESC;"; 
        if ($res = mysqli_query($db, $sql)) { 
            if (mysqli_num_rows($res) > 0) { 
                
                while ($row = mysqli_fetch_array($res)) { 
                    
                echo "<br><br>";
                echo "<div class = question-box >";
                //echo "<div class = upvote-count>".$row['upvote']."</div>";
                echo "<a href=question_answer.php?qid=".$row['PKquestion_id']." class = question>".$row['question_title']."</a><br>";
                echo "<span class = question-username>".$row['user_name']."</span>";
                //echo "<span class = replies>6 replies</span>";
                echo "<span class = question-date>".$row['date']."</span>";
                echo "</div>";
                        
                } 
                //echo "</table>"; 
                //mysqli_free_res($res); 
            } 
            else { 
                echo "No records are found."; 
            } 
        } 
    }

    if($_GET['tag']==4){
            

        $sql = "SELECT * FROM `Question_details` WHERE `tag_name`='data_science' ORDER BY `upvote` DESC;"; 
        if ($res = mysqli_query($db, $sql)) { 
            if (mysqli_num_rows($res) > 0) { 
                
                while ($row = mysqli_fetch_array($res)) { 
                    
                echo "<br><br>";
                echo "<div class = question-box >";
                //echo "<div class = upvote-count>".$row['upvote']."</div>";
                echo "<a href=question_answer.php?qid=".$row['PKquestion_id']." class = question>".$row['question_title']."</a><br>";
                echo "<span class = question-username>".$row['user_name']."</span>";
                //echo "<span class = replies>6 replies</span>";
                echo "<span class = question-date>".$row['date']."</span>";
                echo "</div>";
                        
                } 
                //echo "</table>"; 
                //mysqli_free_res($res); 
            } 
            else { 
                echo "No records are found."; 
            } 
        } 
    }
}

if(isset($_GET['qid'])){
    if($_GET['qid']!=NULL){
        $qid=$_GET['qid'];
    }
    $query="SELECT * FROM `Question_details` WHERE `PKquestion_id`=$qid";
    $res=mysqli_query($db,$query);
    $arr=mysqli_fetch_assoc($res);
    
} 
    
    ?>
    
    <script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementsByClassName("header")[0];
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
</body>
</html>