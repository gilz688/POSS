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
            url: siteloc + "/itemcategories",
            data: {
                page: page
            },
            beforeSend: function() {
                $("#list").fadeOut("fast", function(){
                    $(".loader").show();
                });
            },
            success: function(response) {
                var data = JSON.parse(response.categories);
                $("#list").html(generatetable(data)+response.links);
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