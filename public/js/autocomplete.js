/**
 * Autocompletion fro the field order-application-number.
 */
$(function() {
	$("#order-application-number").autocomplete({
		minLength: 3,
		limit: 5,
		source : [{
			url:"/order/ajax/provide-applications?data[technical_short_name]=%QUERY%",
			type:'remote'
		}],	 
	});
	$("#order-service-invoice-position-basic-number").autocomplete({
		minLength: 3,
		limit: 5,
		valueKey:'number',
		source : [{
			url:"/order/ajax/provide-service-invoice-positions-basic?data[number]=%QUERY%&data[application_technical_short_name]=" + $('#order-application-number').val(),
			type:'remote'
		}],	 
	});
});
