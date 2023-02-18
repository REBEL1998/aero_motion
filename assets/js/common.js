function submitForm(formSelector){
	
	var flagReturn = true;
	
	$(formSelector + ' .validate-control').each(function(){
		
		$(this).removeClass('error-control');
		$(this).next(".select2.select2-container").removeClass('error-control');
		$(this).parent().children('.error-msg').removeClass('err-show');
		
		var required = $(this).attr('data-required');
		var dataValidate = $(this).attr('data-validate');
		
		
		if( $(this).is("input") ) {
			var strValue = $(this).val();
			var flagNotEmpty = true;
			if( required == 'Y' ) {
				if( isEmpty(strValue) ) {
					$(this).addClass('error-control');
					$(this).parent().children('.error-msg.data-empty').addClass('err-show');
					flagNotEmpty = false;
					flagReturn = false;
				}
			}
			
			if(  dataValidate !== undefined && dataValidate != '' ) {
				switch( dataValidate ) {
					case "valid-email":
						if( flagNotEmpty && !isEmail(strValue) ) {
							$(this).addClass('error-control');
							$(this).parent().children('.error-msg.data-invalid').addClass('err-show');
							flagReturn = false;
						}
						break;
				}
			}
		}
		
		if( $(this).is("select") ) {
			var strValue = $(this).val();
			if( required == 'Y' ) {
				if( isEmpty(strValue) ) {
					$(this).addClass('error-control');
					if( $(this).hasClass('select2-control') ) {
						$(this).next(".select2.select2-container").addClass('error-control');
					}
					else {
						$(this).addClass('error-control');
					}
					$(this).parent().children('.error-msg.data-empty').addClass('err-show');
					flagNotEmpty = false;
					flagReturn = false;
					
				}
			}
		}

	});

	return flagReturn;
}

/* Check value is empty */
function isEmpty(strValue){
	strValue = strValue.trim();
	
	if( strValue.length <= 0 ) {
		return true;
	}
	return false;
}

/* Check value is email */
function isEmail(strValue){
	
	var regExpEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@(([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(regExpEmail.test(strValue)){
		return true;
	}

	return false;
}

function cta_confirm(url, msg){
	if( msg == '' ) {
		msg = 'Are you sure?';
	}
	if( confirm(msg) ) {
		location.href = url;
	}
}
