
//Item module
function addItem(){
	var barcode = $("#barcode").val();
	var itemName = $("#itemName");
	var price = $("#price");
	var quantity = $("#quantity");
	var itemDescription = $("#itemDescription");
	var label = $("#label");
	var category_id = $("#category_id");
	
	$.ajax({
			type: "POST",
			url: siteloc,
			data: {
				barcode: barcode,
				itemName: itemName,
				price : price,
				quantity: quantity,
				itemDescription: itemDescription,
				label: label,
				category_id: category_id
			},
			success: function(msg){
				if(msg -> passes()){
					$("#additem-dialog").modal('hide');
				}
				else{
					if(!($("div#tooltip").hasClass("alert alert-danger"))){
						$("div#tooltip".removeClass().addClass("alert alert-danger"));
					}
					$("div#tooltip").html('<strong>WARNING: </strong>' + msg);
				}
			},
			error: function(){
				alert("failure");
			}
	});
	
	function showAddItemForm(){
		$("#barcode").val();
		$("#itemName").val();
		$("#price").val();
		$("#quantity").val();
		$("#itemDescription").val();
		$("#label").val();
		$("#category_id").val();
		$("additem-dialog").dialog("open");
	}
}