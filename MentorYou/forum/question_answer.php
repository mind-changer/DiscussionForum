<?php
include('forum_functions.php');


if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

$urlQid=$_SERVER['QUERY_STRING'];
$urlQid=explode("=",$urlQid);
$urlQid=(int)$urlQid[1];
//echo $urlQid;

if(isset($_POST['up'])){

    if($_POST['up']=='true'){
        
        $que="UPDATE `Question` SET upvote=upvote+1 WHERE `PKquestion_id`=".$urlQid;

        if(mysqli_query($db,$que)){
            echo "data don";
        }

        echo($urlQid);
    }
}
if(isset($_POST['answer'])){

    $q="SELECT MAX(`PKanswer_id`) FROM Answer WHERE `FKquestion_id`=".$urlQid;

    if($r=mysqli_query($db,$q)){

        $Aid=mysqli_fetch_assoc($r);
        $answer=$_POST['answer'];
        print_r($Aid);
        
        if(empty($Aid['MAX(`PKanswer_id`)'])){
            
            $sql="INSERT INTO Answer(`PKanswer_id`,`answer_desc`,`FKuser_id`,`FKquestion_id`) VALUES(1,'$answer',$user,$urlQid);";

            if(mysqli_query($db,$sql)){
                echo "inserted2";
            }
        }

        else{
            $Aid=(int)$Aid['MAX(`PKanswer_id`)'];
            $quer="INSERT INTO Answer(`PKanswer_id`,`answer_desc`,`FKuser_id`,`FKquestion_id`) VALUES($Aid+1,'$answer',$user,$urlQid);";
            if(mysqli_query($db,$quer)){
                echo "inserted";
            }
        }
        
    }
}

function count_answers(){
    global $db,$urlQid;

    $sql = "SELECT COUNT(*) FROM Answer_details WHERE `FKquestion_id`=$urlQid;";
    if($r=mysqli_query($db,$sql)){
        $ansCount=mysqli_fetch_assoc($r);
        echo $ansCount['COUNT(*)']. " replies";
    }
}

function display_answer(){
    
    global $db,$urlQid;

    $sql = "SELECT * FROM `Answer_details` WHERE `FKquestion_id`=$urlQid ORDER BY `date` DESC;"; 
    
    if ($res = mysqli_query($db, $sql)) { 
        if (mysqli_num_rows($res) > 0) { 
            
            while ($ar = mysqli_fetch_array($res)) { 
                
                echo"<br><br>";

                echo"<div class=a-box>";

                    echo "<div class=a-content>".$ar['answer_desc'];
                    echo"</div>";
                    echo"<span class=a-username>".$ar['user_name'];
                    echo"</span>";
                    echo "<span class=a-timestamp>".$ar['date'];
                    echo"</span>";

                echo"</div>";

                //echo"<br><br>";
                    
            } 
            
        } 
        else { 
            echo "No records are found."; 
        } 
    } 
}

?>

<!DOCTYPE html>
<html>
<head>
<title>get question title from database</title>
<script src = "../js/jquery.js"></script>
<script type = "text/javascript" src = "../js/script.js"></script>
<link rel="stylesheet" href="../style.css">
<link href="https://fonts.googleapis.com/css?family=Handlee&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
</head>

<body>
    <form action="question_answer.php" method="post">
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
                
                <button class="btn"><a class="btn">notif</a></button>

                <div class="content">
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
    <?php echo display_question_answer();?>
    <button type="button" id="reply-btn">REPLY</button>
    <textarea id="reply-textarea"></textarea>
    <button id="save-btn" type="button">Save</button>
    <br>
    <?php count_answers();?>

    <?php echo display_answer();?>
    <br>
    
    </form>
    </div>


    <script>
    $("#reply-textarea").hide();
    $('#save-btn').hide();

    var isBtnPressed=false;

    window.onload=$('.upvote-q-btn').click(function(){
       
        var count=document.getElementById('qa-upvote-count');
        var intcount =parseInt(count.innerHTML);

       if(!isBtnPressed){

        count.innerHTML=intcount+1;
        console.log(intcount);
        isBtnPressed=true;
        document.getElementById('upvote-q-btn').innerHTML='DOWNVOTE';

       }
       else{

        count.innerHTML=intcount-1;
        isBtnPressed=false;
        document.getElementById('upvote-q-btn').innerHTML='UPVOTE';
        
       }
    
    $.ajax({
        url: window.location.href,
        type: "POST",
        data: {'up': isBtnPressed},
        cache: false,
        success: function(data){
            alert(data);
        }
    });
    });

    

    $("#reply-btn").click(function(){
        $("#answers-block").hide();
        $("#reply-textarea").show();
        $("#reply-btn").hide();
        $("#save-btn").show();
    });
    $("#save-btn").click(function(){

        var answer = $("#reply-textarea").val();
        //console.log(answer);
        $.ajax({
            url: window.location.href,
            type: "POST",
            data: {'answer': answer},
            cache: false,
            success: function(data){
                
                alert(data);
                $("#answers-block").show();
                $("#reply-textarea").hide();
                $("#reply-btn").show();
                $("#save-btn").hide();
                window.location.reload(true);
            }
        });
        
    });
    </script>
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