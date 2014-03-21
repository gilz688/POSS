function htmltable(table){
	var tablebody = "";
    var tableheader = "";
    for(i=0; i<table.header.length;i++){
    	tableheader = tableheader + "<th>" + table.header[i] + "</th>";
    }
    
    tableheader = "<thead>" + tableheader + "</thead>";
    for(i=0; i<table.rows.length;i++){
    	tablebody += "<tr>";
        for(j=0; j<table.header.length;j++){
            tablebody += "<td>";
            tablebody += table.rows[i][table.header[j]];
            tablebody += "</td>";
        }
        tablebody += "</tr>";
    }
    
    tablebody = "<tbody>" + tablebody + "</tbody>";
    return '<table class ="table table-hover">' + tableheader + tablebody + '</table>';
}