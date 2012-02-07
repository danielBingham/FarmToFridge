/***************************************************************
 * IMAGE CROPPING
 ***************************************************************/

function handleCoordinates(c) {
	if(c.w == 0 || c.h == 0) {
		$("input[name=x]").attr('value', 0);
		$("input[name=y]").attr('value', 0);
	}
	else {
		$("input[name=x]").attr('value', c.x);
		$("input[name=y]").attr('value', c.y);
	}
	if(c.w > 0) {
		$("input[name=width]").attr('value', c.w);
	}
	else {
		$("input[name=width]").attr('value', 300);
	}
	if(c.h > 0) {
		$("input[name=height]").attr('value', c.h);
	}
	else {
		$("input[name=height]").attr('value', 300);
	}
}

$(document).ready(function(e) {
	
	// JCrop
	$("#cropbox").Jcrop({
			onChange: handleCoordinates,
			onSelect: handleCoordinates,
			minSize: [300, 300],
			setSelect: [0,0, 300, 300],
			boxWidth: 640,
			boxHeight: 480,
			aspectRatio: 1
	});
	
	
});

