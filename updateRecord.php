<?php
ini_set("session.save_path", "/home/unn_w21043564/sessionData");
session_start();
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Record Query</title> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="cssMyStyle.css" type = "text/css">	
		<title> Add Record </title>
	</head> 
	<body class="gridContainer1"> 
		<header>
			<h1> Northumbria Music Company </h1>
		</header> 
		<?php
			// to check if user is logged in or not
			if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
				
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
				
				// Start main
				echo "<main>\n";
			
				// Retreiving values
				$recordID = filter_has_var(INPUT_POST,'recordID') ? $_REQUEST['recordID'] : null;
				$recordTitle = filter_has_var(INPUT_POST,'recordTitle') ? $_REQUEST['recordTitle'] : null;
				$recordYear = filter_has_var(INPUT_POST,'recordYear') ? $_REQUEST['recordYear'] : null;
				$recordPrice = filter_has_var(INPUT_POST,'recordPrice') ? $_REQUEST['recordPrice'] : null;
				$catID = filter_has_var(INPUT_POST,'category') ? $_REQUEST['category'] : null;
				$pubID = filter_has_var(INPUT_POST,'publisher') ? $_REQUEST['publisher'] : null;
					
				// Trimming white spaces
				$recordTitle = trim($recordTitle);
				$recordYear = trim($recordYear);
				$recordPrice = trim($recordPrice);
				
				$errors = false;
				//-------------------------- TITLE --------------------------//
				// Checking if title empty
				if (empty($recordTitle)) {
					echo "<p>Please enter a record title</p>\n";
					$errors = true;
				}
				// Checking title length
				else if(strlen($recordTitle) > 100) {
					echo "<p>The record name must be no more than 100 characters</p>\n";
					$errors = true;
				}
				//-------------------------- YEAR --------------------------//
				// Checking if year empty
				if (empty($recordYear)) {
					echo "<p>Please enter a record year</p>\n";
					$errors = true;
				}
				// Checking if year number
				else if(!filter_var($recordYear, FILTER_VALIDATE_INT)) {
					echo "<p>The record year must be a number</p>\n";
					$errors = true;
				}
				// Checking length
				else if(strlen((string)$recordYear) != 4) {
					echo "<p>The record year must be 4 digits</p>\n";
					$errors = true;
				}
				//-------------------------- PRICE --------------------------//
				// Checking if price empty
				if (empty($recordPrice)) {
					echo "<p>Please enter a record price</p>\n";
					$errors = true;
				}
				// Checking if price number
				else if(!filter_var($recordPrice, FILTER_VALIDATE_FLOAT)) {
					echo "<p>The record price must be a number</p>\n";
					$errors = true;
				}
				//-------------------------- ERRORS --------------------------//
				// Checking if $errors is true
				if ($errors) {
					echo "<p>Please try <a href='recordsList.php'>again</a></p>\n";
					// End main
					echo "</main>\n";
				}
				else {
					try {
						// make db connection
						require_once("functions.php");
						$dbConn = getConnection();
						
						// SQL UPDATE query
						$sqlUpdate = "UPDATE nmc_records SET
						recordTitle = '".$recordTitle."', 
						recordYear = '$recordYear', 
						pubID = '$pubID', 
						catID = '$catID',
						RecordPrice = '$recordPrice'
						WHERE recordID = '$recordID'";
							  
						$dbConn->exec($sqlUpdate);
						
						echo "<h2>Record Updated! </h2>\n";
						echo "<a href='recordsList.php' class='btn'> Edit another record </a><br>";
					}
					catch (Exception $e){
						echo "<p>Record not updated: " . $e->getMessage() . "</p>\n";
					}
				}
				// End main
				echo "</main>\n";
			}
			else {
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
				echo "<h2>Login to access this page</h2>\n";
				echo "<a href = 'loginForm.html' class='btn'> Login </a><br>";
				echo "</main>\n";
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