// store script

jQuery.ajaxSetup({
	beforeSend: function() {
		$('#loading').show();
	},
	complete: function(){
		$('#loading').hide();
		setFooter();
	},
	success: function() {}
});

$(function() {
	$("#searchform").on('submit', function(e) {
		e.preventDefault();
		loadDirectoryPart('search', $("#search").val());
    });
});
	
function loadDirectoryPart(part, data)
{
	disableAllDirectoryMenu();
	
	switch( part )
	{
		case 'featured':
			$("#link-shome").addClass('active');
			$("#directorycontainer").load("/directory/" + part);
		break;
		case 'top':
			$("#link-stop").addClass('active');
			$("#directorycontainer").load("/directory/" + part);
		break;
		case 'last':
			$("#link-snew").addClass('active');
			$("#directorycontainer").load("/directory/" + part);
		break;
		case 'category':
			$("#link-scategory").addClass('active');
			$("#directorycontainer").load("/directory/" + part + "?id=" + data);
		break;
		case 'search':
			$("#link-shome").addClass('active');
			$("#directorycontainer").load("/directory/" + part + "?keyword=" + data);
		break;
	}
}

function disableAllDirectoryMenu()
{
	$("#link-shome").removeClass('active');
	$("#link-stop").removeClass('active');
	$("#link-snew").removeClass('active');
	$("#link-scategory").removeClass('active');
}