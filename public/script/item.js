   $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var page = 1;
        retrieve(page);
    });

    function retrieve(page) {
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: siteloc + "/items",
            data: {
                page: page
            },
            beforeSend: function() {
                $("#list").fadeOut("fast", function(){
                    $(".loader").show();
                });
            },
            success: function(response) {
                var data = JSON.parse(response.items);
                $("#list").html(generatetable(data,response.options,response.names)+response.links);
                $(".loader").hide("fast",function(){
                    $("#list").fadeIn("fast");
                });
            },
            error: function(xhr, status, error) {
                $(".loader").hide();
                alert(error);
            }
        });
        return false;
    }

    function generatetable(items,options,name){
        var tableheader = "<tr><th>Item Name</th><th>Label</th><th>Category</th><th>Options</th></tr>";
        var tablebody = "";
        for(var i=0;i<items.length;i++){
            tablebody = tablebody + '<tr><td><a href="../items/' + items[i].barcode + '">' + items[i].itemName + '</a></td><td>'+ items[i].label + '</td><td>' + name[i] + "</td>";
            tablebody = tablebody + '<td>' + options[i] + '</td></tr>';
        }
        return '<table class="table table-hover" ><thead>' + tableheader + '</thead><tbody>' + tablebody + '</tbody></table>';
    }
	function removeItem(barcode){
        $('#confirmDelete').modal('show');
        $('button#confirm').click(function(){
            submitDelete(barcode);            
        });     
    }
    
     function submitDelete(barcode){
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
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: siteloc + "/items/" + barcode,
            data: {
                _method : 'DELETE',
            },
            success: function(response) {
                $('#confirmDelete').modal('hide');
                retrieve(1);
                toastr.success('Item  successfully deleted.')
            },
            error: function(xhr, status, error) {
                toastr.error('Item  successfully deleted.')
            }
        });
    }
	
		/*
	     function submitEdit($barcode){
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
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: siteloc + "/items.edit/" + barcode,
            data: {
                _method : 'POST',
            },
            success: function(response) {
				//$('#edit').modal('hide');
                retrieve(1);
                toastr.success('Item  successfully updated.')
            },
            error: function(xhr, status, error) {
                toastr.error('Error!Invalid input.')
            }
        });
    }
	
	function addItem(){
		$("#barcode").val("");
		$("#itemName").val("");
		$("#price").val("");
		$("#quantity").val("");
		$("#itemDescription").val("");
		$("#label").val("");
		$("#category_id").val("");
        $('#addItem').modal('show');
        $('button#confirm').click(function(){
		
            submitAdd();            
        });     
    }
	function submitAdd(){
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
		var barcode = $("#barcode").val();
		var itemName = $("#itemName").val();
		var price = $("#price").val();
		var quantity = $("#quantity").val();
		var itemDescription = $("#itemDescription").val();
		var label = $("#label").val();
		var category_id = $("#category_id").val();
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: siteloc + "/items/" ,
            data: {
                _method : 'POST',
				barcode: barcode,
				itemName: itemName,
				price: price,
				quantity: quantity,
				itemDescription: itemDescription,
				label: label,
				category_id: category_id
            },
            success: function(response) {
                $('#addItem').modal('hide');
                retrieve(1);
                toastr.success('Item  successfully added.')
            },
            error: function(xhr, status, error) {
                toastr.error('Item  successfully added.')
            }
        });
    }
	*/
