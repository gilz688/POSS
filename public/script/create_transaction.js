$(function() {
	toastr.options = {
            "closeButton": false,
            "debug": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
    };

	$("#add").click(function(){
		var barcode = $("#barcode").val();
		var quantity = $("#quantity").val();
		$("#barcode").val("");
		$("#quantity").val("");
		addItem(barcode,quantity);
	});

	$("#done").click(done);
	$("#new").click(newTransaction);
});

function addItem(barcode,quantity){
	$.ajax({
			type: 'post',
			dataType: 'json',
			url: siteloc + "/api/transaction",
			data:{
				barcode : barcode,
				quantity : quantity,	
			},
			
			success: function(response){
				if(response.error == null){
					$('tbody#top').append(
						'<tr id="' + response.barcode + '" class="bc">'
						+ '<td>' + response.itemName + '</td>'
						+ '<td><input id="itemQuantity" placeholder="' + response.quantity + '" class="form-control input-md"></input></td>'
						+ '<td>' + response.price + '</td>'
						+ '<td class="amt">' + response.amount + '</td>'
						+ '<td><a class="btn btn-small btn-danger" onclick="deleteItem(' + response.barcode + ')"><i class="glyphicon glyphicon-trash"></i>DELETE</a></td>'
						+ '</tr>'
					);
					
					var total = 0;
					$.map( $(".amt"), function(n){ total += parseFloat($(n).html()); });
					$('#total').html(total);
				}
				else{
					toastr.clear();
					toastr.error(response.error);
				}
			}
		});
}

function deleteItem(barcode){
	$.ajax({
		type : 'post',
			dataType : 'json',
			url : siteloc + "/api/transactionItemDelete",			
			data : {
				barcode : barcode				
			},
			success : function(response){
				$('#' + barcode).html('');
			}
	});
}

function done(){
		$.ajax({
			type : 'post',
			dataType : 'json',
			url : siteloc + "/api/done",			
			data : {
				payment : $("#payment").val(),
				total : parseFloat($("#total").html()),
				change : payment - total,
				
			},
			success : function(response){
				if(response.error != null){
					$('#error').html('<div class="alert alert-danger col-sm-12">' + response.error + '</div>');
				}
				else{
					var total = parseFloat($("#total").html());
					var payment_view = $("#payment").val();
					$("#received").html(payment_view);
					$("#change").html(payment_view-total);
					$('#payment').val('');
				}

			}
		});

		$('#error').html('');
}

function newTransaction(){
	$('tbody#top').html("");
	$('#total').html('');
	$('#received').html('');
	$('#change').html('');
	$('#error').html('');
}