/**
* Mark an input field as error one
*/
function markErrorField(id){
	var div = $('#' + id).get();
	$("label[for='"+id+"']").css('color', 'red');
	$('#' + id).css('border', '1px solid red');
	$('#' + id).css('background-color', '#FFEBEB');
}

/**
* Reset an input field from marked as error to normal state
*/
function unmarkErrorField(id){
	var div = $('#' + id).get();
	$("label[for='"+id+"']").css('color', 'black');
	$('#' + id).css('border', '1px solid black');
	$('#' + id).css('background-color', 'white');
}

function resetMarkedErrorFields(){
	unmarkErrorField('b_firstname');
	unmarkErrorField('b_lastname');
	unmarkErrorField('b_address');
	unmarkErrorField('b_city');
	unmarkErrorField('address_book_B_state');
	unmarkErrorField('b_country');
	unmarkErrorField('b_zipcode');
	unmarkErrorField('b_phone');
	unmarkErrorField('s_firstname');
	unmarkErrorField('s_lastname');
	unmarkErrorField('s_address');
	unmarkErrorField('s_city');
	unmarkErrorField('address_book_S_state');
	unmarkErrorField('s_country');
	unmarkErrorField('s_zipcode');
	unmarkErrorField('s_phone');
	unmarkErrorField('firstname');
	unmarkErrorField('lastname');
	unmarkErrorField('address');
	unmarkErrorField('city');
	unmarkErrorField('address_book_state');
	unmarkErrorField('country');
	unmarkErrorField('zipcode');
	unmarkErrorField('phone');
}