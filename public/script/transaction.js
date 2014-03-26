$(".modal-wide").on("show.bs.modal", function(){
	var height = $(window).height() -200;
	$(this).find(".modal-body").css("max-height", height);
	
});
