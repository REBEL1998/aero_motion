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


function addspecification(){
	var count  = $('.contact_incress').length + 1;
	var html = '<div class="form-group row contact_incress">';
	html+='<label class="col-form-label col-sm-2 text-sm-right">Item '+count+'</label>';
	html+='<div class="col-sm-4">';
	html+='<input type="text" class="form-control validate-control" value="" data-required="Y" name="txtSpecificationName[]" autocomplete="off">';
	html+='</div>';
	html+='<div class="col-sm-4">';
	html+='<input type="text" class="form-control validate-control" value="" data-required="Y" name="txtSpecificationValue[]" autocomplete="off">';
	html+='</div>';
	html+='<div class="col-sm-1">';
	html+='<a class="btn btn-danger" id="remove"><i class="fas fa-minus" style="color:white"></i></a>';
	html+='</div>';
	html+= '</div>';
	$('.addContact').append(html);
}

$(document).ready(function(){
	$('.addContact').on('click','#remove',function(){
		$(this).closest('.contact_incress').remove();
	});
});

function setSliderImage( productId = "", index = 0 ){
	$("#carousel-"+productId + " .carousel-item").removeClass("active");
	$("#carousel-"+productId + " .sub-carousel-item").removeClass("active");
	$("#sub-carousel-"+productId + "-"+index).addClass("active");
	$("#main-carousel-"+productId + "-"+index).addClass("active");
}