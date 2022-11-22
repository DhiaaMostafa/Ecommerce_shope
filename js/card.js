
	$(document).ready(function(){	$.ajax({
			url: 'php/card.php',
			type: 'post',
			
			dataType: 'json',
			success:function(response){
			
				var len = response.length;
				for( var i = 0; i<len; i++){
                    var div="<tr><td class='product-col'><img src='"+response[i]['image']+"' alt=''/><div class='title_card_table_prodect'>"+response[i]['disc']+"</div></td><td class='price-col'>$<span class='price-col-span'>"+response[i]['price']+"</span></td><td class='quantity-col'><div class='pro-qty input_card_number'><input type='text' value='"+response[i]['count']+"'/></div></td><td class='total'>$<span class='total-col-span'>"+response[i]['count']*response[i]['price']+"</span></td><td class='card-close'><span>x</span></td></tr>";
			
                    $(".product_card_add").empty();
                    $(".product_card_add").append(div);}}});});