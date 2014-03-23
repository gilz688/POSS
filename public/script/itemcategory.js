   $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var page = 1;
        itemcategories(page);
    });

    function itemcategories(page) {
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: siteloc + "/itemcategories",
            data: {
                page: page
            },
            beforeSend: function() {
                $("#loader").html("<img src='" + siteloc + "/image/loader.gif' /> Please wait...");
            },
            success: function(response) {
                $("#loader").html("");
                var data = JSON.parse(response.categories);
                $("#list").html(generatetable(data));
            },
            error: function(xhr, status, error) {
                alert(error);
            }
        });
        return false;
    }

    function generatetable(categories){
        var tableheader = "<tr><th>Category Name</th><th>Description</th><th>Options</th></tr>";
        var tablebody = "";
        for(var i=0;i<categories.length;i++){
            tablebody = tablebody + "<tr><td>" + categories[i].name +"</td><td>"+ categories[i].description + "</td>";
            tablebody = tablebody + '<td><form action="itemcategories/"' + categories[i].id + '" style="float: left;">';
            tablebody += '<input type="submit" method="post" value="DELETE" class="btn btn-danger"><type name="_method" type="hidden" value="DELETE">';
            tablebody += '&nbsp; <a class="btn btn-small btn-success"><i class="glyphicon glyphicon-edit"></i>    EDIT</a>';
            tablebody += '</form></td></tr>';
        }
        return '<table class="table table-hover" ><thead>' + tableheader + '</thead><tbody>' + tablebody + '</tbody></table>';
    }