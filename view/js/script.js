$(document).ready(function(){
	$("#taskMenu").addClass("active");

	$(".viewDetails").click(function(){
		var taskToShow=$(this).attr("taskToShow");
		var id=taskToShow.split("_")[1];
		var div=$("#task_"+id);
		if($(this).hasClass("isOpen")){
			$(this).removeClass("isOpen");
			$(div).slideUp(function(){
				$("#icon_"+id).removeClass("fa-angle-double-up");
				$("#icon_"+id).addClass("fa-angle-double-down");
				$("#view_"+id).html("Voir détails");
			});
		}else{
			$(this).addClass("isOpen");
			$(div).slideDown(function() {
				$("#icon_"+id).removeClass("fa-angle-double-down");
				$("#icon_"+id).addClass("fa-angle-double-up");
				$("#view_"+id).html("");
			});
			
		}
	});

});
