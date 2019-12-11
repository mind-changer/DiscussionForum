<?php

include('functions.php');

if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

?>
<!DOCTYPE html>
<html>

<head>
<title>Home</title>
<script src = "../js/jquery.js"></script>
<script type = "text/javascript" src = "../js/script.js"></script>
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css?family=Handlee&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body style="border-style: groove;border-color: white; border-width: 15px;border-radius: 15px;position:absolute;
  top:0;
  bottom:0;
  right:0;
  left:0;
  overflow:auto;">
	    <div class = header style="border:none;background: none;">
            
            <button class="btn" style="background: none; font-weight: light;font-family: 'Great Vibes', cursive;font-size: 36px;"><a>MentorYou</a></button>


        </div>
    
    <div class="main" style="margin-left: 200px">
    <!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						echo($_SESSION['user']['user_name']);
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<!--<img src="images/user_profile.png"  >-->

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['user_name']; ?></strong>

					<small>
						
						<a href="login.php?logout='1'" style="color: red;">logout</a>
						<a href="forum/forum.php" style="color: red">go to forum</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
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
