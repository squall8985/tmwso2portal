function messageBox(header, message) {
	$(function () {
	    $("#dialog").dialog({
	        title: header,
			open: function() {
		      var markup = message;
		      $(this).html(markup);
		    },
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
}