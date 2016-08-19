// Linux/Unix EndpointSource #start#
$(document).ready(function() {
	basicFieldEndpointSourceServerPlace = $('#fieldgroup-basic-endpoint-source .field-server-place');
	fieldServerSourceToggle = $('#fieldgroup-specific-endpoint-source .toggle-server');
	fieldTheServerSource = $('#fieldgroup-basic-endpoint-source .input-server');
	fieldTheServerNodeNameSource = $('#fieldgroup-basic-endpoint-source .field-server-node-name');
	fieldTheServerEndpointServerConfigDnsAddressSource = $('#fieldgroup-basic-endpoint-source .field-endpoint-server-config-dns-address');
	fieldAServerSource = function() {
		return $('#fieldgroup-specific-endpoint-source .input-server');
	};
	fieldsetMultipleServersSource = $('#fieldgroup-specific-endpoint-source .fieldset-multiple-servers');
	fieldServiceAddressSource = $('#fieldgroup-specific-endpoint-source .field-service-address');
	fieldServiceAddressSourceToggle = $('#fieldgroup-specific-endpoint-source .toggle-service-address');
	buttonAddEndpointSourceServer = $('#fieldgroup-specific-endpoint-source #add-endpoint-source-server-button');
	fieldTheExternalServerSource = $('#fieldgroup-basic-endpoint-source .input-external-server');
	fieldClusterIdSource = $('#fieldgroup-specific-endpoint-source .field-cluster-id');
	fieldClusterVirtualNodeNameSource = $('#fieldgroup-specific-endpoint-source .field-cluster-virtual-node-name');
	fieldEndpointClusterConfigIdSource = $('#fieldgroup-specific-endpoint-source .field-endpoint-cluster-config-id');
	fieldEndpointClusterConfigDnsAddressSource = $('#fieldgroup-specific-endpoint-source .field-endpoint-cluster-config-dns-address');
});
$(document).ready(function() {
	fieldServerSourceToggle.change(function() {
		toggleFieldServerSource(this.value);
	});
	fieldServiceAddressSourceToggle.change(function() {
		toggleFieldServiceAddressSource(this);
	});
	fieldServerSourceToggle.filter(':checked').trigger('change');
	// fieldServiceAddressSourceToggle.trigger('change');
	basicFieldEndpointSourceServerPlace.change(function() {
		console.log(global.sourceServerQuantity);
		toggleFieldServerSource('');
	});
});
function toggleFieldServerSource(value) {
	if (value == '') {
		value = global.sourceServerQuantity;
	}
	if (value == SERVER_QUANTITY_ONE) {
		if (global.sourceServerPlace != SERVER_PLACE_EXTERNAL) {
			fieldServerSourceToggle.parent().parent().fadeIn('slow');
			fieldTheServerSource.parent().fadeIn('slow');
			fieldTheServerNodeNameSource.parent().fadeIn('slow');
			fieldTheServerEndpointServerConfigDnsAddressSource.parent().fadeIn('slow');
		}
		fieldAServerSource().val('');
		fieldsetMultipleServersSource.fadeOut('slow');
		buttonAddEndpointSourceServer.fadeOut('slow');
		fieldServiceAddressSourceToggle.parent().fadeIn('slow');
		fieldServiceAddressSourceToggle.trigger('change');
		fieldClusterIdSource.val('');
		fieldClusterVirtualNodeNameSource.val('');
		fieldClusterVirtualNodeNameSource.parent().fadeOut('slow');
		fieldEndpointClusterConfigIdSource.val('');
		fieldEndpointClusterConfigDnsAddressSource.val('');
		fieldEndpointClusterConfigDnsAddressSource.parent().fadeOut('slow');

		if (global.sourceServerPlace != SERVER_PLACE_INTERNAL) {
			fieldServerSourceToggle.parent().parent().fadeOut('slow');
		}

		global.sourceServerQuantity = SERVER_QUANTITY_ONE;
	} else if (value == SERVER_QUANTITY_MANY) {
		if (fieldTheServerSource.val() != '') {
			fieldAServerSource().first().val(fieldTheServerSource.val());
		}
		fieldTheServerSource.val('');
		fieldTheServerSource.parent().fadeOut('slow');
		fieldTheServerNodeNameSource.val('');
		fieldTheServerNodeNameSource.parent().fadeOut('slow');
		fieldTheServerEndpointServerConfigDnsAddressSource.val('');
		fieldTheServerEndpointServerConfigDnsAddressSource.parent().fadeOut('slow');
		if (global.sourceServerPlace != SERVER_PLACE_EXTERNAL) {
			fieldServerSourceToggle.parent().parent().fadeIn('slow');
			fieldsetMultipleServersSource.fadeIn('slow');
			buttonAddEndpointSourceServer.fadeIn('slow');
			fieldClusterVirtualNodeNameSource.parent().fadeIn('slow');
			fieldEndpointClusterConfigDnsAddressSource.parent().fadeIn('slow');
		}
		if (global.sourceServerPlace != SERVER_PLACE_INTERNAL) {
			fieldsetMultipleServersSource.fadeOut('slow');
			buttonAddEndpointSourceServer.fadeOut('slow');
		}
		fieldServiceAddressSourceToggle.prop('checked', false);
		fieldServiceAddressSourceToggle.trigger('change');
		fieldServiceAddressSourceToggle.parent().fadeOut('slow');

		if (global.sourceServerPlace != SERVER_PLACE_INTERNAL) {
			fieldServerSourceToggle.parent().parent().fadeOut('slow');
			fieldAServerSource().val('');
			fieldsetMultipleServersSource.fadeOut('slow');
			buttonAddEndpointSourceServer.fadeOut('slow');
			fieldClusterIdSource.val('');
			fieldClusterVirtualNodeNameSource.val('');
			fieldClusterVirtualNodeNameSource.parent().fadeOut('slow');
			fieldEndpointClusterConfigIdSource.val('');
			fieldEndpointClusterConfigDnsAddressSource.val('');
			fieldEndpointClusterConfigDnsAddressSource.parent().fadeOut('slow');
		}

		global.sourceServerQuantity = SERVER_QUANTITY_MANY;
	}
}
function toggleFieldServiceAddressSource(field) {
	if ($(field).prop('checked')) {
		fieldServiceAddressSource.parent().fadeIn('slow');
	} else {
		fieldServiceAddressSource.val('');
		fieldServiceAddressSource.parent().fadeOut('slow');
	}
}
// Linux/Unix EndpointSource #stop#
