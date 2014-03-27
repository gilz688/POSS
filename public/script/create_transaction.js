$(document).ready(function(){
 
    $( '#add' ).click( function(event) {
		
        //.....
        //show some spinner etc to indicate operation in progress
        //.....
		
 
 /*
		$.post( 
			$( this ).prop( 'action' ),{
				"_token": $( this ).find( 'input[name=_token]' ).val(),
                "cashier_number": $( '#cashier_number' ).val(),
                "barcode": $( '#barcode' ).val(),
                "quantity": $( '#quantity' ).val()
			},
			function( data ) {
                //do something with data/response returned by server
               // var parsedResponse = jQuery.parseJSON(data);
                alert(parsedResponse);
				$('tbody').append('<tr><td>' + parsedResponse.barcode + '</td></tr>');
            },
            'json'
        ); */
       
        $.ajax({
			type: 'post',
			dataType: 'json',
			url: "/transactions",
			data:{
				cashier_number : $( '#cashier_number' ).val(),
				barcode : $( '#barcode' ).val(),
				quantity : $( '#quantity' ).val(),
				
			},
			
			success: function(response){
				//var parsedResponse = JSON.parse(response);
				
				$('tbody#top').append(
					'<tr><td>' + response.itemName + '</td>'
					+ '<td>' + response.price + '</td>'
					+ '<td>' + response.quantity + '</td>'
					+ '<td>' + response.amount + '</td></tr>'
					
				);
			}
			
		}); 
		
		//$( '#cashier_number' ).val('');
		$( '#barcode' ).val('');
		$( '#quantity' ).val('');
 
        //.....
        //do anything else you might want to do
        //.....
 
        //prevent the form from actually submitting in browser
        //event.preventDefault();
    } );
 });

