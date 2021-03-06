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
            url: siteloc + "/users",
            data: {
                page: page
            },
            beforeSend: function() {
                $("#list").fadeOut("fast", function(){
                    $(".loader").show();
                });
            },
            success: function(response) {
                var data = JSON.parse(response.users);
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

    function generatetable(users,options){
        var tableheader = "<tr><th>Username</th><th>Role</th><th>Options</th></tr>";
        var tablebody = "";
        for(var i=0;i<users.length;i++){
            tablebody = tablebody + "<tr><td>" + users[i].username +"</td><td>"+ users[i].role + "</td>";
            tablebody = tablebody + "<td>" + options[i] +"</td></tr>";
        }
        return '<table class="table table-hover" ><thead>' + tableheader + '</thead><tbody>' + tablebody + '</tbody></table>';
    }

    function removeUser(id){
        $('#confirmDelete').modal('show');
        $('button#confirm').click(function(){
            submitDelete(id);            
        });   
    }
    
    function editUser(id){
        alert("Edit user with id of "+id);
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
            url: siteloc + "/users/" + id,
            data: {
                _method : 'DELETE',
            },
            success: function(response) {
                $('#confirmDelete').modal('hide');
                retrieve(1);
                toastr.success('User successfully deleted.')
            },
            error: function(xhr, status, error) {
                toastr.error(error);
            }
        });
    }

	//script for delete confirmation
	