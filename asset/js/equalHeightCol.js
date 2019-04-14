
		var heightest = $(".item").eq(0).outerHeight();
		$(".item").each(function(){
			if(heightest < $(".item").outerHeight()){
				heightest = $(".item").outerHeight();
			}
		});
		$(".item").each(function(){
			$(".item").css("height", heightest-42);
		});