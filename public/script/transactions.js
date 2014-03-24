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
            url: siteloc + "/transactions",
            data: {
                page: page
            },
            beforeSend: function() {
                $("#list").fadeOut("fast", function(){
                    $(".loader").show();
                });
            },
            success: function(response) {
                var data = JSON.parse(response.transactions);
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

    function generatetable(transactions,options,names){
        var tableheader = "<tr><th>Timestamp</th><th>Cashier Number</th><th>Creator</th><th>Options</th></tr>";
        var tablebody = "";
        for(var i=0;i<transactions.length;i++){
            tablebody = tablebody + '<tr><td>' + transactions[i].created_at + '</td><td>'+ transactions[i].cashier_number + '</td><td>'+ names[i] + "</td>";
            tablebody = tablebody + '<td>' + options[i] + '</td></tr>';
        }
        return '<table class="table table-hover" ><thead>' + tableheader + '</thead><tbody>' + tablebody + '</tbody></table>';
    }

    function voidTransaction(id){
        alert("Void transaction with id of "+id);
    }
    
    function viewInvoice(id){
        alert("View invoice for transaction with id of "+id);
    }
