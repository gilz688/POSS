
//add item
$(funtion(){
	$("#additem-dialog").dialog({
		autoOpen: false,
		width: 500,
		height: 700,
		resizable: false,
		modal: true
	});
	
	$("#addItemDialog").button();
	$("#addItemDialog").button().bind("click", showAddItemForm);
	$("#submitAddItem").button();
	$("#submitAddItem").button().bind("click", addItem);
})