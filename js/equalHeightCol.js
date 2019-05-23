function equalHeightCol()
{
		var heightest = $(".item").eq(0).outerHeight();
		$(".item").each(function(){
			if(heightest < $(".item").outerHeight()){
				heightest = $(".item").outerHeight();
			}
		});
		$(".item").each(function(){
			$(".item").css("height", heightest-42);
		});
}
		$("button").click(function(e) {
		    e.preventDefault();
		    $.ajax({
		        type: "POST",
		        url: "/pages/test/",
		        data: {
		            id: $(this).val(), // < note use of 'this' here
		            access_token: $("#access_token").val()
		        },
		        success: function(result) {
		            alert('ok');
		        },
		        error: function(result) {
		            alert('error');
		        }
		    });
		});
