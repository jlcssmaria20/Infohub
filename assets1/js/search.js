$(document).ready(function() {
	listRecords();
	$('#multiSelectSearch').change(function() {
		$('#location').val($('#multiSelectSearch').val());
		var searchQuery = $('#location').val();
		listRecords(searchQuery);
	});
});
function listRecords(searchQuery='') {
	$.ajax({
		url : '/live_search',
		type : 'POST',
		// contentType: "application/json",//note the contentType defintion
 	    // dataType: "json",
		data:"query="+searchQuery,
		success : function (result) {
		//console.log(result);
		$('ul.webinar-list-item').html(result);
		},
		error : function () {
		   console.log ('error');
		}
	  });
}