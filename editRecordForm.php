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
		<title> Edit Record Form </title>
	</head> 
	<body class="gridContainer1"> 
		<header>
			<h1> Northumbria Music Company </h1>
		</header> 
		<?php
			// to check if user is logged in or not
			if (isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
				$recordID = filter_has_var(INPUT_GET,'recordID') ? $_REQUEST['recordID'] : null;
				$pubIDNew = null;
				$pubNameNew = null;
				$catIDNew = null;
				$catDescNew = null;
				
				if (empty($recordID)) {
					echo "<p>Please <a href='recordsList.php'>select</a> a record</p>\n";
				}
				else {
					try {
						// make db connection
						require_once("functions.php");
						$dbConn = getConnection();
						
						// SQL SELECT query
						$sqlQuery = "SELECT recordID, recordTitle, recordYear, pubID, catID, recordPrice
								FROM nmc_records
								WHERE recordID = '$recordID'";
								
						$queryResult = $dbConn->query($sqlQuery);
						$rowObj = $queryResult->fetchObject();
						
						// sanitizing recordTitle before outputting it to the user
						$theTitle = "{$rowObj->recordTitle}";
						$sanitizedTitle = htmlspecialchars($theTitle, ENT_NOQUOTES);
						
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
						echo "<main class='editMain'>\n";
						
						// Form code
						echo 
						"<h2>Updating '{$rowObj->recordTitle}'</h2>
						<div class='editRecordForm'>
							<form id='UpdateRecord' action='updateRecord.php' method='post'>
								<label> ID </label><input type='text' name='recordID' value = '{$rowObj->recordID}' readonly><br>
								<label> Title </label><input type='text' name='recordTitle' value = '".$sanitizedTitle."' required><br>
								<label> Year </label><input type='text' name='recordYear' value = '{$rowObj->recordYear}' required><br>		
								<label> Price </label><input type='text' name='recordPrice' value = '{$rowObj->recordPrice}' required><br>";
								
								// Publisher
								$sqlQuery2 = "SELECT pubID, pubName FROM nmc_publisher";
								$queryResult2 = $dbConn->prepare($sqlQuery2);
								$queryResult2->execute(array(':pubID' => $pubIDNew, ':pubName' => $pubNameNew));	
								
								echo "<label> Publisher </label>";
								echo "<select name = 'publisher'>";
								while($rowObj2 = $queryResult2->fetchObject()) {
									if($rowObj->pubID == $rowObj2->pubID)
									{
										$selected = 'selected';
									}
									else
									{
										$selected = '';
									}
									echo "<option value='{$rowObj2->pubID}'$selected>{$rowObj2->pubName}</option>";
								}
								echo "</select><br>";
								
								// Category
								$sqlQuery3 = "SELECT catID, catDesc FROM nmc_category";
								$queryResult3 = $dbConn->prepare($sqlQuery3);
								$queryResult3->execute(array(':catID'=>$catIDNew, ':catDesc'=>$catDescNew));
								
								echo "<label> Category </label>";
								echo "<select name = 'category'>";
								while($rowObj3 = $queryResult3->fetchObject()) {
									if($rowObj->catID == $rowObj3->catID)
									{
										$selected = 'selected';
									}
									else
									{
										$selected = '';
									}
									echo "<option value = '{$rowObj3->catID}'$selected>{$rowObj3->catDesc}</option>";
								}
								echo "</select><br>";
								echo "<input type='submit' value='Update Record'>
							</form>
						</div>
						";
						echo "</main>\n";
					}
					
					catch (Exception $e){
						echo "<p>Record details not found: ".$e->getMessage()."</p>\n";
					}
				}
			}
			else {
				echo 
				"
					<nav>
						<div class='navbar'>
							<a href='homepage.php'>Home</a>
							<a href='recordsList.php'>Edit Record</a>
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

