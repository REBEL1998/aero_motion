// contact form 
function submitInquiry() {
	
    var userName = $("#txtUserName").val().trim();
    var phoneNumber = $("#txtPhoneNum").val().trim();
    var userEmail = $("#txtUserEmail").val().trim();
    var subject = $("#txtSubject").val().trim();
    var message = $("#txtMessage").val().trim();
   
	if ( userName == '' || userEmail == '' || message == '') return false;
   
	$.ajax({
		url: calledURI + '?action=addInquiry',
		type: "post",
		data: {
			userName: userName,
			phoneNumber: phoneNumber,
			userEmail: userEmail,
			subject: subject,
			message: message
		},
		success: function(result) {
			if (result) {

				swal({
					title: "Thanks",
					text: "Thanks for Conatct us we contact soon ....",
					timer: 3e3,
					showConfirmButton: !1
				})

				setTimeout(function() {
					window.location.href = calledURI;
				}, 4000);

			} else {
				swal({
					title: "Fail to Send",
					text: " Please try again later ....",
					timer: 3e3,
					showConfirmButton: !1
				})
			}
		}
	})

}