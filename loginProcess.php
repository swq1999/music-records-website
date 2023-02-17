<?php
ini_set("session.save_path", "/home/unn_w21043564/sessionData");
session_start();
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="cssMyStyle.css" type = "text/css">	
		<title> Login process </title>
	</head>
	<body class="gridContainer1"> 
		<header>
			<h1> Northumbria Music Company </h1>
		</header> 
			<?php
				// Retrieve the username and the password from the form 
				$username = filter_has_var(INPUT_POST, 'username') 
				? $_POST['username']: null;
				$password = filter_has_var(INPUT_POST, 'password') 
				? $_POST['password']: null;
				
				// trimming white spaces
				$username = trim($username);
				
				// checking if empty username
				if (empty($username)) {
					echo "<p>Please enter a username</p>";
					echo "<a href = 'loginForm.html'> Try again </a>";
				}
				// checking if empty password
				else if (empty($password)) {
					echo "<p>Please enter a password</p>";
					echo "<a href = 'loginForm.html'> Try again </a>";
				}
				else
				{
					try 
					{
						// Making database connection
						require_once("functions.php");
						$dbConn = getConnection();

						/* to get the password hash for the username entered by the user*/
						$querySQL = "SELECT firstname, surname, passwordHash FROM nmc_users 
						WHERE username = :username";

						// Prepare the sql statement using PDO
						$stmt = $dbConn->prepare($querySQL);

						// Execute the query using PDO
						$stmt->execute(array(':username' => $username));

						// Check if a record was returned by the query. 
						$user = $stmt->fetchObject();
						if ($user) 
						{
							$passwordHash = $user->passwordHash;
							// Code to verify the password attempt
							if (password_verify($password, $passwordHash)) 
							{	
								$_SESSION['logged-in'] = true;
								$_SESSION['firstname'] = "{$user->firstname}";
								$_SESSION['surname'] = "{$user->surname}";
								
								echo 
								"
									<nav>
										<div class='navbar'>
											<a href='homepage.php'>Home</a>
											<a href='recordsList.php'>Edit Record</a>
											<a href='orderRecordsForm.php'>Order Record</a>
											<a href='credits.php'>Credits</a>
											<div class='logoutBtn'>
												<a href = 'logout.php'> Logout </a><br>
											</div>
										</div>
									</nav>\n
								";
								echo "<main>\n";
								echo "<h2>Login successful</h2>";
								echo "<p>Welcome back, {$user->firstname}!</p>";
								echo "<a href = 'recordsList.php' class='btn'> Edit a record </a><br>";
								echo "</main>\n";
							}
							else
							{
								echo 
								"
									<nav>
										<div class='navbar'>
											<a href='homepage.php'>Home</a>
											<a href='recordsList.php'>Edit Record</a>
											<a href='orderRecordsForm.php'>Order Record</a>
											<a href='credits.php'>Credits</a>
											<div class='loginBtn'>
												<a href = 'loginForm.html'> Login </a><br>
											</div>
										</div>
									</nav>\n
								";
								echo "<main>\n";
								echo "<h2>Login failed:</h2>\n";
								echo "<p>Username or password was incorrect.</p>\n";
								echo "<a href = 'loginForm.html' class='btn'> Try again </a>";
								echo "</main>\n";
							}
						}
						else 
						{
							echo 
								"
									<nav>
										<div class='navbar'>
											<a href='homepage.php'>Home</a>
											<a href='recordsList.php'>Edit Record</a>
											<a href='orderRecordsForm.php'>Order Record</a>
											<a href='credits.php'>Credits</a>
											<div class='loginBtn'>
												<a href = 'loginForm.html'> Login </a><br>
											</div>
										</div>
									</nav>\n
								";
								echo "<main>\n";
								echo "<h2>Login failed:</h2>";
								echo "<p>Username or password was incorrect.</p>";
								echo "<a href = 'loginForm.html' class='btn'> Try again </a>";
								echo "</main>\n";
						}
					} 
					catch (Exception $e) 
					{
						echo "There was a problem: " . $e->getMessage();
					}
					catch (ErrorException $e) 
					{
						echo "There was a problem: " . $e->getMessage();
					}
				}
			?>
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
