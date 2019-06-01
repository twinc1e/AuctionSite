var time = document.getElementById("timeleftHidden").value;
var hour, min, second;
var hourText = document.getElementById("hour"),
 minText = document.getElementById("min"),
 secondText = document.getElementById("second");

if(time.length == 7){/*h-mm-ss*/
	hour = Number(time.substring(0,1));
	min = Number(time.substring(2,4));
	second = Number(time.substring(5,7));
}else if(time.length == 8){/*hh-mm-ss - 1day*/
	hour = Number(time.substring(0,2));
	min = Number(time.substring(3,5));
	second = Number(time.substring(6,8));
}else if(time.length == 9){/*hhh-mm-ss - >1day*/
	hour = Number(time.substring(0,3));
	min = Number(time.substring(4,6));
	second = Number(time.substring(7,9));
}else{/*hhh-mm-ss - >1month*/
	hour = Number(time.substring(0,4));
	min = Number(time.substring(5,7));
	second = Number(time.substring(8,10));
}

var intervalId = setInterval(
	function(){
	if(second == 0){
		if(hour == 0 && min == 0 && second == 0){
			clear();
		}else{
			second = 59;
			if(min==0){
				min = 59;
				hour-=1;
			}else{
				min-=1;
			}
		}
	}else{
		second -=1;
	}
	//
	if(String(hour).length == 2 || String(hour).length == 3 || String(hour).length == 4){
		hourText.innerHTML = hour;
	}else{
		hourText.innerHTML = 0+String(hour);
	}

	if(String(min).length == 2){
		minText.innerHTML = min;
	}else{
		minText.innerHTML = 0+String(min);
	}

	if(String(second).length == 2){
		secondText.innerHTML = second;
	}else{
		secondText.innerHTML = 0+String(second);
	}
},1000);

var clear = function(){
	clearInterval(intervalId);
	(function(){
			//
			//
			$.ajax({
			   type: "POST",
			   url: "win.php",
				data: {
					user_id: $(".bidhistory table tbody tr #user_id").eq(0).val(),
					item_id: $("input[name='itemId']").eq(0).val()
				},
			   success: function(msg){
			   		if($("#hms")!=undefined){
						$("#hms").remove();
					}
					if(($('#biddingForm'))!=undefined){
						$('#biddingForm').remove();
					}

			   		if(msg == "winner"){
						$('.itemdesc').append("<p id='winner'><span>Победитель: </span>"+$(".bidhistory table tbody tr").find("td").eq(0).html()+"</p>");
					}else if(msg == "nowinner"){
						$('.itemdesc').append("<p id='winner'><span>Победитель: </span>-</p>");
					}
			   }
		});
	}());
}

$(function(){
	setInterval(function(){
		$.get("http://auctionsite/php/module/itemLoadBidHistory.php",
		{ //item_id:$(".itemIdAjax").val() }, function(data){
      item_id:$(".itemdesc").attr("id") }, function(data){
  			$('.bidhistory').eq(0).html(data);
		});
	},1000);
});
