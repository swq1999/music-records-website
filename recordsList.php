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
		<title> Records List </title>
	</head> 
	<body class="gridContainer1"> 
		<header>
			<h1> Northumbria Music Company </h1>
		</header> 
		<?php
			if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {		
				try {
					// make db connection
					require_once("functions.php");
					$dbConn = getConnection();
					
					// SQL Select Statement
					$sqlQuery = "SELECT nmc_records.recordID, nmc_records.recordTitle, nmc_records.recordYear, 
							nmc_records.pubID, nmc_records.catID, nmc_category.catDesc, nmc_records.recordPrice
							FROM nmc_records
							INNER JOIN nmc_category
							ON nmc_category.catID = nmc_records.catID
							ORDER BY recordTitle";
					
					// Executing SQL statement
					$queryResult = $dbConn->query($sqlQuery);
					
					echo 
					"
						<nav>
							<div class='navbar'>
								<a href='homepage.php'>Home</a>
								<a class='active' href='recordsList.php'>Edit Record</a>
								<a href='orderRecordsForm.php'>Order Record</a>
								<a href='credits.php'>Credits</a>
								<div class='logoutBtn'>
									<a href = 'logout.php'> Logout </a><br>
								</div>
							</div>
						</nav>\n
					";
					echo "<main>\n";
					echo "<h2>Select a record to edit:</h2>\n";
					
					// Fetching all rows
					while ($rowObj = $queryResult->fetchObject()) {
						
						// sanitizing recordTitle before outputting it to the user
						$theTitle = "{$rowObj->recordTitle}";
						$sanitizedTitle = htmlspecialchars($theTitle, ENT_NOQUOTES);
						
						echo 
						"<div class='records'>\n
							<span class='recordID'>{$rowObj->recordID}</span>\n
							<span class='recordTitle'>
								<a href='editRecordForm.php?recordID={$rowObj->recordID}'>".$sanitizedTitle."</a>
							</span>
							<span class='catDesc'>{$rowObj->catDesc}</span>\n
							<span class='catID'>{$rowObj->catID}</span>\n
							<span class='pubID'>{$rowObj->pubID}</span>\n
							<span class='recordPrice'>{$rowObj->recordPrice}</span>\n
						</div>\n";
					}
					
					echo "</main>\n";
				}
				catch (Exception $e){
					echo "<p>Query failed: ".$e->getMessage()."</p>\n";
				}
			}
			else {
				echo 
				"
					<nav>
						<div class='navbar'>
							<a href='homepage.php'>Home</a>
							<a class='active' href='recordsList.php'>Edit Record</a>
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