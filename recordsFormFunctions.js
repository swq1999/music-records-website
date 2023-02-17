window.addEventListener('load', function(){
	"use strict";
	
	const oForm = document.getElementById('orderForm'); // form
	let totalPrice = 0; // total record price 
	let shipping = 0; // shipping cost
	
	// d. total cost
	oForm.addEventListener("change", calculateTotal); // for calculating when changes are made in the form
	
	function calculateTotal() {
		
		// Item Price
		totalPrice = 0;
		const items = oForm.querySelectorAll('span.chosen');
		const itemCount = items.length;
		
		for (let i=0; i<itemCount; i++)
		{
			const item = items[i];
			const itemCheckbox = item.querySelector('input[data-price][type=checkbox]');
			
			if (itemCheckbox.checked)
			{
				totalPrice +=  parseFloat(itemCheckbox.dataset.price);
			}
		}
		
		// Shipping
		const deliveryPage = document.getElementById('collection');
		shipping = 0;
		const ships = deliveryPage.querySelectorAll('p')[1].getElementsByTagName('input');
		const shipCount = ships.length;
		
		for (let i=0; i<shipCount; i++)
		{
			const ship = ships[i];
			if (ship.checked)
			{
				shipping += parseFloat(ship.dataset.price);
			}
			
			// Grand Total
			let grand = 0;
			grand += parseFloat(totalPrice) + parseFloat(shipping);
			oForm.total.value = grand;	
		}
	}
	
	// a. Terms and conditions 
	oForm.addEventListener("click", termsCheck);
	function termsCheck() {
		
		const terms = document.getElementById('termsText'); // terms text
		
		const normal = terms.getAttribute('style');

		if (oForm.termsChkbx.checked == true)
		{
			terms.setAttribute("style", "color: black; font-weight: none");
		}
		else
		{
			terms.style = "color: #FF0000; font-weight: bold";
		}
	}
	
	// b.& c. Form submit button disabled 
	oForm.submit.setAttribute("style","background-color:gray;color:white;cursor:not-allowed"); // submit btn style
	oForm.addEventListener("change", checkForm);
	
	function checkForm(evt)
	{
		let valFailed = false;
		
		//T&C
		if (oForm.termsChkbx.checked == false){valFailed = true;}
		// forename
		else if (oForm.forename.value.trim() == ""){valFailed = true;}
		// surname
		else if (oForm.surname.value.trim() == ""){valFailed = true;}
		//total 
		else if (oForm.total.value == 0){valFailed = true;}
		
		// to check if an item is selected
		const items = oForm.querySelectorAll('span.chosen');
		const itemCount = items.length;
		let altered = false;
		
		for (let i=0; i<itemCount; i++)
		{
			const item = items[i];
			const itemCheckbox = item.querySelector('input[type=checkbox]');							
			if (itemCheckbox.checked)
			{
				altered = true;
				break;
			}
		}
		
		if (altered == false)
		{
			valFailed = true;
		}
		
		// valFailed
		if (valFailed == true) 
		{ 
			oForm.submit.disabled = true;
			oForm.submit.setAttribute("style","background-color:gray;color:white;cursor:not-allowed");
			evt.preventDefault(); // stops the submission if something isn't right in the form
		}
		else if (valFailed == false) 
		{
			oForm.submit.disabled = false;
			oForm.submit.setAttribute("style","background-color:#3471a0;color:white;cursor:pointer");
		}	
	}
});