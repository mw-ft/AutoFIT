/**
 * Clearing and enabling/disabling of fields dependending on other fields.
 */
// Billing #start#
$(document).ready(function() {
	fieldApplicationNumber = $('#order-application-number');
	fieldEnvironmentSeverity = $("#order-environment-severity");
	fieldEnvironmentName = $("#order-environment-name");
	fieldInvoicePositionBasic = $("#order-service-invoice-position-basic-number");
	fieldInvoicePositionPersonal = $("#order-service-invoice-position-personal-number");
});
$(document).ready(function() {
	fieldApplicationNumber.on('autocompletechange', function() {
		console.log('autocompletechange');
		fieldApplicationNumber.trigger('change');
	});
	fieldApplicationNumber.change(function() {
		console.log('change');
		updateApplicationDependentFields(this.value);
	});
	fieldEnvironmentName.on('autocompletechange', function() {
		console.log('autocompletechange');
		fieldEnvironmentSeverity.trigger('change');
	});
	fieldEnvironmentSeverity.change(function() {
		console.log('change');
		updateEnvironmentDependentFields(this.value);
	});
});
function updateApplicationDependentFields(value) {
	fieldEnvironmentSeverity.val('');
	fieldEnvironmentName.val('');
	fieldInvoicePositionBasic.val('');
	fieldInvoicePositionPersonal.val('');
}
function updateEnvironmentDependentFields(value) {
	fieldInvoicePositionBasic.val('');
	fieldInvoicePositionPersonal.val('');
}
// Billing #stop#

// EndpointSource basic #start#
$(document).ready(function() {
	fieldEndpointSourceServerPlace = $('#fieldgroup-basic-endpoint-source .field-server-place');
	fieldEndpointSourceCustomerName = $('#fieldgroup-basic-endpoint-source .field-customer-name');
	fieldEndpointSourceApplicationNumber = $('#fieldgroup-basic-endpoint-source .field-application-number');
	fieldEndpointSourceServerName = $('#fieldgroup-basic-endpoint-source .input-server');
	fieldEndpointSourceExternalServerName = $('#fieldgroup-basic-endpoint-source .input-external-server');

	fieldEndpointSourceServerPlace.change(function() {
		toggleEndpointSourceDependentFields(this.value);
	});
	fieldEndpointSourceServerPlace.filter(':checked').trigger('change');
});
function toggleEndpointSourceDependentFields(value) {
	if (value == '') {
		value = global.sourceServerPlace;
	}
	if (value == SERVER_PLACE_INTERNAL) {
		fieldEndpointSourceCustomerName.val('');
		fieldEndpointSourceCustomerName.parent().fadeOut('slow');
		fieldEndpointSourceApplicationNumber.parent().fadeIn('slow');
		fieldEndpointSourceExternalServerName.val('');
		fieldEndpointSourceExternalServerName.parent().fadeOut('slow');
		if (global.sourceServerQuantity != SERVER_QUANTITY_MANY) {
			fieldEndpointSourceServerName.parent().fadeIn('slow');
		}

		global.sourceServerPlace = SERVER_PLACE_INTERNAL;
	} else if (value == SERVER_PLACE_EXTERNAL) {
		fieldEndpointSourceApplicationNumber.val('');
		fieldEndpointSourceApplicationNumber.parent().fadeOut('slow');
		fieldEndpointSourceServerName.val('');
		fieldEndpointSourceServerName.parent().fadeOut('slow');
		if (global.sourceServerQuantity != SERVER_QUANTITY_MANY) {
			fieldEndpointSourceExternalServerName.parent().fadeIn('slow');
		}
		fieldEndpointSourceCustomerName.parent().fadeIn('slow');

		global.sourceServerPlace = SERVER_PLACE_EXTERNAL;
	}
}
// EndpointSource basic #stop#

// EndpointTarget basic #start#
$(document).ready(function() {
	fieldEndpointTargetServerPlace = $('#fieldgroup-basic-endpoint-target .field-server-place');
	fieldEndpointTargetCustomerName = $('#fieldgroup-basic-endpoint-target .field-customer-name');
	fieldEndpointTargetApplicationNumber = $('#fieldgroup-basic-endpoint-target .field-application-number');
	fieldEndpointTargetServerName = $('#fieldgroup-basic-endpoint-target .input-server');
	fieldEndpointTargetExternalServerName = $('#fieldgroup-basic-endpoint-target .input-external-server');

	fieldEndpointTargetServerPlace.change(function() {
		toggleEndpointTargetDependentFields(this.value);
	});
	fieldEndpointTargetServerPlace.filter(':checked').trigger('change');
});
function toggleEndpointTargetDependentFields(value) {
	if (value == '') {
		value = global.targetServerPlace;
	}
	if (value == SERVER_PLACE_INTERNAL) {
		fieldEndpointTargetCustomerName.val('');
		fieldEndpointTargetCustomerName.parent().fadeOut('slow');
		fieldEndpointTargetApplicationNumber.parent().fadeIn('slow');
		fieldEndpointTargetExternalServerName.val('');
		fieldEndpointTargetExternalServerName.parent().fadeOut('slow');
		if (global.targetServerQuantity != SERVER_QUANTITY_MANY) {
			fieldEndpointTargetServerName.parent().fadeIn('slow');
		}

		global.targetServerPlace = SERVER_PLACE_INTERNAL;
	} else if (value == SERVER_PLACE_EXTERNAL) {
		fieldEndpointTargetApplicationNumber.val('');
		fieldEndpointTargetApplicationNumber.parent().fadeOut('slow');
		fieldEndpointTargetServerName.val('');
		fieldEndpointTargetServerName.parent().fadeOut('slow');
		if (global.targetServerQuantity != SERVER_QUANTITY_MANY) {
			fieldEndpointTargetExternalServerName.parent().fadeIn('slow');
		}
		fieldEndpointTargetCustomerName.parent().fadeIn('slow');

		global.targetServerPlace = SERVER_PLACE_EXTERNAL;
	}
}
// EndpointTarget basic #stop#
