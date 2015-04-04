function prepareView(question){
	$("#questionImage").html('<img src="'+question.picture+'" height="158px" width="158px" style="background-size: 100% 100%;"/>');
	$("#questionAnswers").html("");
	var form=$('<form/>',{"name":"gameAnswers","method":"POST","id":"gameAnswers"});
	var table=$('<table/>');
	var tr;
    for(var i in question.answers){
    	tr=$('<tr>');
    	$(tr).append('<td><input type="radio" name="answer" value="'+question.answers[i]+'" id="answer'+i+'"/></td><td><label for="answer'+i+'">'+question.answers[i]+'</td>');
    	$(table).append(tr);
    }
    $(form).append(table);
    $("#questionAnswers").html(form);
}


function showScore(question){
	$("#questionAnswers").html('votre score est : '+question.score);
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
