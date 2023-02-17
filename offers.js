window.addEventListener('load', function () {
    "use strict";
	//console.log("hi there!");
	const URL = 'getOffers.php';
	
	const fetchData = function() {
		fetch(URL)
		.then(
			// Step 1. function needed here to process the response into JSON data     
			function (response) {
			return response.json();
			}
		)
		.then( 
			// Step 2. function needed here to do something with the JSON data
			function (json) {
				document.getElementById("offers").innerHTML = "<h3> Record Title: " + json.recordTitle + "</h3>";
				document.getElementById("offers").innerHTML += "<p>Category: <em>" + json.catDesc + "</em></p>";
				document.getElementById("offers").innerHTML += "<p>Price: &pound;<em>" + json.recordPrice + "</em></p>";
			}
		)
		.catch(
			// Step 3. function needed here to do something if there is an error
			function (err) {
				console.log("Something went wrong!", err);
			}
		); 
		// end of fetch request
	};
	setInterval(fetchData, 5000);
	fetchData(); // to display data right away
	
});