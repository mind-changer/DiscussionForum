<?php
include('forum_functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
?>


<!DOCTYPE html>
<html>

<head>
<title>MY PROFILE</title>
<script src = "../js/jquery.js"></script>
<script type = "text/javascript" src = "../js/script.js"></script>
<link rel="stylesheet" href="../style.css">
<link href="https://fonts.googleapis.com/css?family=Handlee&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
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
    <form action="profile.php" method="post" id="user-info">   
    <div class = user-info>
        <div class= intro >Hello <?php echo ucfirst($_SESSION['user']['name'])."!";?></div>
        <div class= prof-photo></div>
        <div class = prof-username>Username: <?php echo ucfirst($_SESSION['user']['user_name']);?></div>
        <div class = short-bio>
            Short Bio:<br><p style="background: url('../images/tex2res5.png');background-color: gray;"><?php echo $_SESSION['user']['short_bio'];?></p>
        </div>
        <textarea class=short-bio id="short-bio-textarea" name="textarea">
        </textarea>
     
        <button class=edit-bio type="button" name=edit_bio id=edit-bio>edit bio</button>
        <button class=save-bio type="submit" name=save_bio id=save-bio>Save bio</button>
    
    </div>
    </form>

    <div class =ask-question>
        <a href="ask_question.php">Ask a Question</a>
    </div>

    <div class = my-questions>
        <a href="my_question.php">My Questions</a>
    </div>
    </div>
    <script>
    $("#short-bio-textarea").hide();
    $("#save-bio").hide();
    $(document).ready(function(){
        $("#edit-bio").click(function(){
            var a=$("p").text();
            //console.log(a);
            $("#short-bio-textarea").val(a);
            $("p").hide();
            //$("#short-bio-textarea").val()=$("p").text();
            $("#short-bio-textarea").show();
            
            $("#save-bio").show();
            $("#edit-bio").hide();
        });
        $("#save-bio").click(function(){
            var b=$("#short-bio-textarea").val();
            $.ajax({
                url: "forum_functions.php",
                method: "POST",
                data: {
                    Shortbio: b
                },
                cache: false,
                success: function(){

                }
            });
            //document.getElementByTagName("p").innerHTML=b;
            console.log(b);
            //$("p").text(b);
            console.log(typeof b);
            $("p").show();
            $("#short-bio-textarea").hide();
            
            $("#save-bio").hide();
            $("#edit-bio").show();
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