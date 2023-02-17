<?php
ini_set("session.save_path", "/home/unn_w21043564/sessionData");
session_start();
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Homepage</title> 
		<link href = "cssMyStyle.css" rel = "stylesheet" type = "text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
	</head> 
	<body class="gridContainer"> 
		<header>
			<h1> Northumbria Music Company </h1>
		</header> 
		<nav>
			<div class="navbar">
				<a class="active" href="homepage.php">Home</a>
				<a href="recordsList.php">Edit Record</a>
				<a href="orderRecordsForm.php">Order Record</a>
				<a href="credits.php">Credits</a>
				<?php
					// to set the color of the login/logout button
					if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
						echo 
						"
							<div class='logoutBtn'>
								<a href ='logout.php'> Logout </a><br>
							</div>
						";
					}
					else {
						echo
						"
							<div class='loginBtn'>
								<a href = 'loginForm.html'> Login </a><br>
							</div>
						";
					}
				?>
			</div>
		</nav>
		<main>
			<section>
				<h2>About us</h2>
				<p>
					We offer a variety of music records online with delivery and pickup options available. 
					<a href="orderRecordsForm.php">Order now!</a><br>
					Our socials: <a href="https://www.facebook.com/NorthumbriaUni/">Facebook</a>,
								 <a href="https://twitter.com/Northumbriauni">Twitter</a>,
								 <a href="https://www.instagram.com/northumbriauni/">Instagram</a>,
								 <a href="https://www.youtube.com/Northumbriauni">YouTube</a>.
				</p>
			</section>
		</main>
		<aside>
			<h2>Special Offers!</h2>
			<div id="offers">
				<script type="text/javascript" src="offers.js"></script>
			</div>
		</aside>
		<footer>	
			<h4>Contact us:</h4>
			<p>
				Email: musiccompany@northumbria.ac.uk <br>
				Phone: +44123456789 <br>
			</p>	
			<p>&copy; 2022 Northumbria Music Company. All Rights Reserved.</p>
		</footer>
	</body> 
</html>
