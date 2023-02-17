<?php
ini_set("session.save_path", "/home/unn_w21043564/sessionData");
session_start();
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Credits</title> 
		<link href = "cssMyStyle.css" rel = "stylesheet" type = "text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
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
				<a class="active" href="credits.php">Credits</a>
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
				<h2>Student Details:</h2>
				<p>
					Name: Syed Wajahat Quadri<br>
					Student ID: (REMOVED)<br>
					Email: (REMOVED)
				</p>
			</section>
		</main>
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
