<?php
	$_SESSION = array();
	
	ini_set("session.save_path", "/home/unn_w21043564/sessionData");
	session_start();
	// Set the cookie expiration date to one hour ago
	$params = session_get_cookie_params();
	setcookie(session_name(), "", time() - 3600,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
	); 
	session_destroy();
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="cssMyStyle.css" type = "text/css">
		<title> Logout </title>
	</head> 
	<body class="gridContainer1">
		<header>
			<h1> Northumbria Music Company </h1>
		</header> 
		<nav>
			<div class="navbar">
				<a href="homepage.php">Home</a>
				<a href="recordsList.php">Edit Record</a>
				<a href="orderRecordsForm.php">Order Record</a>
				<a href="credits.php">Credits</a>
				<div class="loginBtn">
					<a href = "loginForm.html"> Login </a><br>
				</div>
			</div>
		</nav>
		<main>
			<h2>Successfully logged out </h2>
			<a href ='homepage.php' class='btn'> Return to Homepage </a><br>
		</main>
		<footer>	
			<h4>Contact us:</h4>
			<p>
				Email: musiccompany@northumbria.ac.uk <br>
				Phone: +44123456789 <br>
			</p>	
			<p>&copy; 2022 Northumbria Music Company. All Rights Reserved.</p>
		</footer>
	<body>	
</html>