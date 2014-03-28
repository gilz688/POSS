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
						'<tr><td>' + response.itemName + '</td>'
						+ '<td>' + response.price + '</td>'
						+ '<td>' + response.quantity + '</td>'
						+ '<td>' + response.amount + '</td></tr>'
						
					);
					
				}
				else{
					$('#error').html('<div class="alert alert-danger col-sm-12">' + response.error + '</div>');
				}
				
				
			}
			
		}); 
		
		//$( '#cashier_number' ).val('');
		$( '#barcode' ).val('');
		$( '#quantity' ).val('');
		$('#error').html('');
		
		
		
		event.preventDefault();

    } );
    
    
    
    
    $( '#done' ).click( function(event) {
		var cashier_number = $('#cashier_number').val();
		var cashier_number = $('#cashier_number').val();
		var cashier_number = $('#cashier_number').val();
		$.ajax({
			url : siteloc + '/api/transactionStore',
			dataType : 'json',
			type : 'post',
			data : {
				cashier_number : cashier_number,
				items : JSON:stringify(items)
			},
			success : function(data){
				
			}
		});
		
		
		


    } );
    
    
 });

