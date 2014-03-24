	
function swapSpecials(location){
		var locationSelector = location.attr('id');
		$('.specialsSelector').removeClass('locSelected');
		$('#'+locationSelector).addClass('locSelected');
		$('.flyerSpecial').hide();
		$('.flyerFrom'+locationSelector).show();
}

$(document).ready(function(){
	//specials page script only
	swapSpecials($('#sfo'));
	$('.specialsSelector').click(function(){
		swapSpecials($(this));
	});
});