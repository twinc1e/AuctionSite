if($('.error').length!=0 || $('.notice').length!=0){
	setTimeout(function(){
		$.ajax({
		   type: "POST",
		   url: "asset/hideMsg.php",
			data: {
				clear: 1 
			},
		   success: function(msg){
		   		$('.error').fadeOut(500, function(){
					$(this).remove();
				});
				$('.notice').fadeOut(500, function(){
					$(this).remove();
				});
		   }
		});
	},10000);
}
	
$("#closeMsg").click(function(){
	$.ajax({
	   type: "POST",
	   url: "asset/hideMsg.php",
		data: {
			clear: 1 
		},
	   success: function(msg){
	   		$('.error').fadeOut(500, function(){
				$(this).remove();
			});
			$('.notice').fadeOut(500, function(){
				$(this).remove();
			});
	   }
	});
});	
	

	
	
