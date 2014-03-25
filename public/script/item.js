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

    function generatetable(items,options,names){
        var tableheader = "<tr><th>Barcode</th><th>Item Name</th><th>Category</th><th>Label</th><th>Options</th></tr>";
        var tablebody = "";
        for(var i=0;i<items.length;i++){
            tablebody = tablebody + '<tr><td><a href="../items/' + items[i].barcode + '">' + items[i].itemName + '</a></td><td>'+ items[i].category_id+ '</td><td>' + items[i].label + "</td>";
            tablebody = tablebody + '<td>' + options[i] + '</td></tr>';
        }
        return '<table class="table table-hover" ><thead>' + tableheader + '</thead><tbody>' + tablebody + '</tbody></table>';
    }

    function removeItem(barcode){
        alert("Delete item with barcode of "+barcode);
    }
    
    function editItem(barcode){
        alert("Edit item  with barcode of "+barcode);
    }
	
