<!DOCTYPE html>
<?php include('functions.php') ?>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<script src = "js/jquery.js"></script>
	<script type = "text/javascript" src = "js/script.js"></script>
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
                <button class="btn" ><a href="login.php">Login</a></button>
                
            </div>

            

        </div>
    


<div class="main" style="margin-left: 200px";>
<form method="POST" action="register.php">
<?php echo display_error(); ?>
	<div class="input-group">
		
		<input placeholder="Username" type="text" name="username" value="<?php echo $username?>">
	</div>
	<div class="input-group">
		
		<input placeholder="Name" type="text" name="name" value="<?php echo $name?>">
	</div>
	<div class="input-group">
		
		<input placeholder="Email" type="email" name="email" value="">
	</div>
	<div class="input-group">
		
		<input placeholder="Password" type="password" name="password_1">
	</div>
	<div class="input-group">
		
		<input placeholder="Confirm password" type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
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