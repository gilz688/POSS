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
    	var items = $.map( $(".bc"), function(n){ return $(n).attr("id"); });
		var cashier_number = $('#cashier_number').val();
		//var itemsJson = JSON.stringify(items);
		
		$.ajax({
			url : siteloc + '/api/done',
			dataType : 'json',
			type : 'post',
			data : {
				cashier_number : cashier_number,
				items : items
			},
			success : function(data){
				window.location.replace(siteloc + "/transactions");
				alert("samok");
			},
			error : function(xhr,error,x){
				alert(error);
			}
		});
		var total = parseFloat($("#total").html());
		var payment = $("#payment").val();
		$("#received").html(payment);
		$("#change").html(payment-total);
	});

	$("#new").click(function(){
		$('tbody#top').html("");
	});
		
		
		


});
 

