<?php

session_start();
$db = mysqli_connect('localhost', 'root', '', 'mentoryou');

if(!$db)
{
    die('Could not connect to database: ' . mysqli_connect_error());
}

#variable declaration
$username = "";
$name = "";
$email = "";
$errors = array();
$logout_success ="";

#call register() function if register_btn is clicked
if(isset($_POST['register_btn'])){
    register();
}

#register function
function register(){
    global $db, $errors, $username, $name, $email;

    $username = e($_POST['username']);
    $name = e($_POST['name']);
    $email = e($_POST['email']);
    $password_1 = e($_POST['password_1']);
    $password_2 = e($_POST['password_2']);

    #validation
    if(empty($username)){
        array_push($errors, "Username is required");
    }
    if(empty($name)){
        array_push($errors, "Name is required");
    }
    if(empty($email)){
        array_push($errors, "Email is required");
    }
    if(empty($password_1)){
        array_push($errors, "Password is required");
    }
    if($password_1 != $password_2){
        array_push($errors, "Password doesn't match");
    }
     #sql query when no errors
    if(count($errors)==0){
        $password = md5($password_1); #encrypt password as hash
        
        $query = "INSERT INTO User(`user_name`, `password`, `name`, `email_id`) VALUES('$username', '$password', '$name', '$email')";
        mysqli_query($db, $query);

        $logged_in_user_id = mysqli_insert_id($db);

        $_SESSION['user']= getUserById($logged_in_user_id);
        $_SESSION['success']="You are now logged in";
        header('location:index.php');
    }
}
function getUserById($id){
	global $db;
	$query = "SELECT * FROM `User` WHERE `PKuser_id`=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}






// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM User WHERE `user_name`='$username' AND `password`='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success']  = "You are now logged in ";
			header('location: index.php');
			
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

if(isset($_GET['logout'])){
	
    session_unset();
    session_destroy();
	//echo "<h1 class = checkLogOut>LOGGED OUT SUCCESSFULLY</h1>";
	$logout_success="LOGGED OUT SUCCESSFULLY<br>";
}
?>