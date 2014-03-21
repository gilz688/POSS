$(function(){
	$('#datepicker').datepicker();
	$("#generate").click(salesreport);
});

function salesreport(){
		start=$("#start").val();
		end=$("#end").val();
		$.ajax({
                type: 'post',
                dataType: 'json',
                url: siteloc + "/report/sales",
                data: {
            		start : start,
            		end : end
            	},
                beforeSend: function() { 
                    $("#spinner").html("<img src='../image/blue.gif' width='25px' height='25px'/> Please wait...");
                },
                success: function(response) {
                    var tablebody = "";
                    var tableheader = "";
                    var table = "";
                    for(i=0; i<response.header.length;i++){
                        tableheader = tableheader + "<th>" + response.header[i] + "</th>";
                    }
                    tableheader = "<thead>" + tableheader + "</thead>";
                    for(i=0; i<response.rows.length;i++){
                        tablebody += "<tr>";
                        for(j=0; j<response.header.length;j++){
                            tablebody += "<td>";
                            tablebody += response.rows[i][response.header[j]];
                            tablebody += "</td>";
                        }
                        tablebody += "</tr>";
                    }
                    tablebody = "<tbody>" + tablebody + "</tbody>";
                    table = '<table class ="table table-hover">' + tableheader + tablebody + '</table>';
                    $('#spinner').html("");
                    $("#report").html(table);
                },
                error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
                }
            });
		return false;
}