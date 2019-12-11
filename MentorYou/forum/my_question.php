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
<title>Ask a Question</title>
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
        <?php echo display_my_questions();?>
    
    </div>

    
    <script >
        


    /*$.ajax({
        url: "forum_functions.php",
        type: "POST",
        data: {
            
        },
        cache: false,
        success: function () {alert(arr);setCookie(qid);}
    });
}
//function setCookie(/*cname, cvalue, exdays*///qid) {
  //var d = new Date();
  //d.setTime(d.getTime() + (exdays*24*60*60*1000));
  //var expires = "expires="+ d.toUTCString();

  //document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  //document.cookie = qid;
//}

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