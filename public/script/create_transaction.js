$(document).ready(function(){
 
    $( '#add' ).click( function(event) {       
        $.ajax({
			type: 'post',
			dataType: 'json',
			url: siteloc + "/api/transaction",
			data:{
				cashier_number : $( '#cashier_number' ).val(),
				barcode : $( '#barcode' ).val(),
				quantity : $( '#quantity' ).val(),
				
			},
			
			success: function(response){
				if(response.error == null){
					$('tbody#top').append(
						'<tr id="' + response.barcode + '" class="bc"><td>' + response.itemName + '</td>'
						+ '<td>' + response.price + '</td>'
						+ '<td>' + response.quantity + '</td>'
						+ '<td class="amt">' + response.amount + '</td></tr>'
						
					);
					
					var total = 0;
					$.map( $(".amt"), function(n){ total += parseFloat($(n).html()); });
					$('#total').html(total);
				}
				else{
					$('#error').html('<div class="alert alert-danger col-sm-12">' + response.error + '</div>');
				}
				//$(".amt")
				
			}
			
		}); 
		
		//$( '#cashier_number' ).val('');
		$( '#barcode' ).val('');
		$( '#quantity' ).val('');
		$('#error').html('');
		
		event.preventDefault();

    } );
    
    
    
    
    $( '#done' ).click( function(event) {
    	
    	//var items = Session::get('purchaseditems');
    	//alert(items);
    	//var items = $.map( $(".bc"), function(n){ return $(n).attr("id"); });
		//var cashier_number = $
		//var itemsJson = JSON.stringify(items);
		//alert('clicked!');
		
		$.ajax({
			type : 'post',
			dataType : 'json',
			url : siteloc + "/api/done",			
			data : {
				cashier_number : $('#cashier_number').val(),
			},
			success : function(response){
				//window.location.replace(siteloc + "/transactions");
				//if(data.resp == 'OK'){
					alert("yehey");
				//}
				//else{
				//	alert('hahay');
				//}
				
			}
		});
		var total = parseFloat($("#total").html());
		var payment = $("#payment").val();
		$("#received").html(payment);
		$("#change").html(payment-total);
		$('#payment').val('');
		
		event.preventDefault();
	});

	$("#new").click(function(){
		$('tbody#top').html("");
		$('#total').html('');
		$('#received').html('');
		$('#change').html('');
		$('#error').html('');
		
		
	});
		
		
		


});
 

