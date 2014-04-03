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

    itemsuggestion();

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
						'<tr id="' + response.barcode + '" class="bc"><td>' + response.itemName + '</td>'
						+ '<td>' + response.price + '</td>'
						+ '<td>' + response.quantity + '</td>'
						+ '<td class="amt">' + response.amount + '</td>'
						+ '<td> <a class="btn btn-danger" id="removeBtn" onClick="deleteItem(' + response.barcode + ',' + response.amount + ')">Remove</a></td>' 

						+ '</tr>'
					);
					
				updateTotal();
				}
				else{
					toastr.clear();
					toastr.error(response.error);
				}
			}
		});
	var select = $("#barcode")[0].selectize;
	select.clear();
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
				updateTotal();
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


function deleteItem(barcode,amount){
	$.ajax({
		type : 'post',
			dataType : 'json',
			url : siteloc + "/api/transactionItemDelete",			
			data : {
				barcode : barcode				
			},
			success : function(response){
				$('#' + barcode).remove();
				
				var total = parseFloat($("#total").html());
				$('#total').html(total - amount);
			}
	});
}


 

function updateTotal(){
	var total = 0;
	$.map( $(".amt"), function(n){ total += parseFloat($(n).html()); });
	$('#total').html(total);
}


function itemsuggestion(){
	$('#barcode').selectize({
        valueField: 'barcode',
        labelField: 'itemName',
        searchField: ['itemName'],
        maxOptions: 5,
        maxItems: 1,
        options: [],
        create: false,
        render: {
            option: function(item, escape) {
                return '<div><div>' + item.barcode + '</div><div>' + escape(item.itemName) + '</div></div>';
            }
        },
        optgroups: [
            {value: 'item', label: 'Items'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['itemName'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: siteloc + '/api/item',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        },
        onChange: function(){
            
        }
    });
}
