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
                $("#list").html(generatetable(data,response.options)+response.links);
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

    function generatetable(categories,options){
        var tableheader = "<tr><th>Category Name</th><th>Description</th><th>Options</th></tr>";
        var tablebody = "";
        for(var i=0;i<categories.length;i++){
            tablebody = tablebody + '<tr><td><a href="../itemcategories/' + categories[i].id + '">' + categories[i].name + '</a></td><td>'+ categories[i].description + "</td>";
            tablebody = tablebody + '<td>' + options[i] + '</td></tr>';
        }
        return '<table class="table table-hover"><thead>' + tableheader + '</thead><tbody>' + tablebody + '</tbody></table>';
    }

    function removeCategory(id){
        $('#confirmDelete').modal('show');
        $('button#confirm').click(function(){
            submitDelete(id);            
        });     
    }
    
     function submitDelete(id){
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
            url: siteloc + "/itemcategories/" + id,
            data: {
                _method : 'DELETE',
            },
            success: function(response) {
                $('#confirmDelete').modal('hide');
                retrieve(1);
                toastr.success('Item category successfully deleted.')
            },
            error: function(xhr, status, error) {
                toastr.error(error);
            }
        });
    }
