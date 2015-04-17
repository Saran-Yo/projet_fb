function prepareView(question){
	$("#questionImage").html('<img src="'+question.picture+'" height="158px" width="158px" style="background-size: 100% 100%;"/>');
	$("#questionAnswers").html("");
	var form=$('<form/>',{"name":"gameAnswers","method":"POST","id":"gameAnswers"});
	var table=$('<table/>',{"css":{"border-collapse":"separate","border-spacing":"2.5em"}});
	var tr;
    for(var i in question.answers){
    	tr=$('<tr>');
    	$(tr).append('<td><input type="radio" name="answer" value="'+question.answers[i]+'" id="answer'+i+'"/></td><td><label for="answer'+i+'" style="cursor:pointer;font-size:20px;">'+question.answers[i]+'</td>');
    	$(table).append(tr);
    }
    $(form).append(table);
    $("#questionAnswers").html(form);
}




function publishScore(userComment){
	$.ajax({
			url: "./index.php?ctrl=HomeController&action=publishScore",
			data:{
				userComment:userComment
			}
	}).done(function(data) {
		
	});
}


$("#publishScore").click(function(){
	$("#myModal").modal("hide");
	var userComment=$("#myModal_userComment").val();
	publishScore(userComment);
	window.location.href="./index.php?ctrl=HomeController&action=home";
});


$("#dontPublishScore").click(function(){
	window.location.href="./index.php?ctrl=HomeController&action=home";
});


function askToPublishScore(question){
	$("#scoreBox").html('Votre score est<br/><span style="font-size:20px;font-weight:bold;">'+question.score+'</span>');
	$("#myModal_userComment").val("");
	$("#myModal").modal("show");
}


function showScore(question){
	$("#questionAnswers").html('votre score est : '+question.score);

	//if(question.score>=2)
	//	$("#mainContainer").fireworks();
	askToPublishScore(question);
}

$(document).ready(function(){
	
	/*setTimeout(function() {
   		$("#mainContainer").fireworks();
	});*/

	$("#startGame").click(function(){
		$.ajax({
			url: "./index.php?ctrl=HomeController&action=initGame"
		}).done(function(data) {
			var question=JSON.parse(data);
			if(question.finished!='true')
				prepareView(question);
			else
				showScore(question);
			$("#startGame").hide();
			$("#btn_nextQuestion").show();

		});
	});
	
	$("#btn_nextQuestion").click(function(){
		$.ajax({
			url: "./index.php?ctrl=HomeController&action=nextQuestion",
			data:
				$("#gameAnswers").serialize(),
			type:"POST"
		}).done(function(data) {
			var question=JSON.parse(data);
			if(question.finished==undefined)
				prepareView(question);
			else
				showScore(question);
		});
	});

});
