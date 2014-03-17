showHide = function() {
	$('.hide').hide();
	$('.click').click( function(){
		//do stuff here
		$('.click ul').first().show();
	});
}
