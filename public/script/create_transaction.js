$(document).ready(function(){
 
    $( '#form-create-transaction' ).on( 'submit', function(event) {
 
        //.....
        //show some spinner etc to indicate operation in progress
        //.....
		event.preventDefault();
 
 
		$.post( 
			$( this ).prop( 'action' ),{
				"_token": $( this ).find( 'input[name=_token]' ).val(),
                "cashier_number": $( '#cashier_number' ).val(),
                "barcode": $( '#barcode' ).val(),
                "quantity": $( '#quantity' ).val()
			},
			function( data ) {
                //do something with data/response returned by server
                var parsedResponse = data;
                alert(parsedResponse);
				$('tbody').append('<tr><td>' + parsedResponse.barcode + '</td></tr>');
            },
            'json'
        );
        
        $('#add').click(function(e){
			e.preventDefault();
			$("tbody").load("hello");
		});
       
        /**$.ajax({
			type: 'post',
			dataType: 'json',
			url: "transactions",
			data:{
				cashier_number : $( '#cashier_number' ).val(),
				barcode : $( '#barcode' ).val(),
				quantity : $( '#quantity' ).val(),
				
			},
			
			success: function(response){
				var parsedResponse = JSON.parse(response);
				$('tbody').append('<tr><td>' + parsedResponse.barcode + '</td></tr>');
			}
			
		}); **/
 
        //.....
        //do anything else you might want to do
        //.....
 
        //prevent the form from actually submitting in browser
        
    } );
 });

