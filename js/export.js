function export() {
  $.ajax({
           type: "POST",
           url: 'http://AuctionSite/php/module/myfpdf.php',
           data: {  exportEl = $('#export').val()},
           success:function(html) {
             alert(html);
           }
      });
 }
 ////
 // $('#export').click(function() {
 //
