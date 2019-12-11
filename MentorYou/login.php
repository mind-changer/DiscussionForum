<?php include('functions.php') 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
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

            

            <div class = dropdown> 
                <button class="btn" ><a href="register.php">Register</a></button>
                
            </div>

            

        </div>
    

	<div class="main" style="margin-left: 200px;">
		<form method="post" action="login.php">

			<?php echo display_error(); ?>
			<?php echo $logout_success;?>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username" >
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="login_btn">Login</button>
			</div>
			<p>
				Not yet a member? <a href="register.php">Sign up</a>
			</p>
		</form>
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