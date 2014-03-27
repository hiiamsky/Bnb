
$(document).ready(function(){
	$(document).on("click","#btnBooking",function(evt){
		//alert("btnBooking");
		//$.mobile.changePage('Booking/BookingList.php');
		document.location.href="Booking/BookingList.php";
	});
	$(document).on("click","#btnLogout",function(evt){
		//alert("Logout");
		// $.mobile.changePage('Logout/Logout.php',{dataUrl:"Logout/Logout.php"});
		document.location.href="Logout/Logout.php";
		
	});
});