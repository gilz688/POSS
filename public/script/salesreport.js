$(function() {
    $('#datepicker').datepicker();
    $("#generate").click(salesreport);
});

function salesreport() {
    start = $("#start").val();
    end = $("#end").val();
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: siteloc + "/report/sales",
        data: {
            start: start,
            end: end
        },
        beforeSend: function() {
            $("#chart").fadeOut("slow");
            $("#report").fadeOut("slow", function(){
                $("#loader").show();
            });
        },
        success: function(response) {
            var tablebody = "";
            var tableheader = "";
            var table = "";
            for (i = 0; i < response.header.length; i++) {
                tableheader = tableheader + "<th>" + response.header[i] + "</th>";
            }
            tableheader = "<thead>" + tableheader + "</thead>";
            for (i = 0; i < response.rows.length; i++) {
                tablebody += "<tr>";
                for (j = 0; j < response.header.length; j++) {
                    tablebody += "<td>";
                    tablebody += response.rows[i][response.header[j]];
                    tablebody += "</td>";
                }
                tablebody += "</tr>";
            }
            tablebody = "<tbody>" + tablebody + "</tbody>";
            table = '<table class ="table table-hover">' + tableheader + tablebody + '</table>';
            $('#loader').hide("fast");
            $("#report").html(table);
            $("#report").fadeIn("slow");
            showChart();
            $("#chart").fadeIn("slow");
        },
        error: function(xhr, status, error) {
            $('#loader').hide();
            var err = eval("(" + xhr.responseText + ")");
            alert(status);
        }
    });
    return false;
}

function showChart() {
    var labels = $("#report > table td:first-child").map(function() {
        return $(this).text();
    }).get();

    var sales = $("#report > table td:nth-child(4)").map(function() {
        return parseFloat($(this).text());
    }).get();

    var lineChartData = {
        labels: labels,
        datasets: [
            {
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                data: sales
            }
        ]

    }

    var ctx = $("#canvas").get(0).getContext("2d");
    var barChart = new Chart(ctx).Bar(lineChartData);
}