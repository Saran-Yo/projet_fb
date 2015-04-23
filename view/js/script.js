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
});


$("#dontPublishScore").click(function(){
	$("#myModal").modal("hide");
});

$("#btn_replay").click(function(){
	replay();
});


function askToPublishScore(question){
	$.ajax({
			url: "./index.php?ctrl=HomeController&action=publishActionStatus"
		}).done(function(data) {
			if(data=="false"){
				$("#publishScore").css({"display":"none"});
				$("#myModal_userComment").css({"disabled":"disabled"});
			}
	});
	$("#scoreBox").html('Votre score est<br/><span style="font-size:20px;font-weight:bold;">'+question.score+'</span>');
	$("#myModal_userComment").val("");
	$("#myModal").modal("show");
}


function showScore(question){
	$("#questionAnswers").html('');
	$("#btn_nextQuestion").hide();
	$("#btn_replay").css({"display":"block"});
	$("#questionContainer").html("");
	getBestScores();
	if(question.score>=5)
		$("#questionContainer").fireworks();
	askToPublishScore(question);
}


function getBestScores(){
	$.ajax({
			url: "./index.php?ctrl=HomeController&action=getBestScores"
		}).done(function(data) {
			data=JSON.parse(data);
			var thead=$('<thead>');
			$(thead).append('<tr><th>#</th><th>Nom</th><th>Score</th></tr>');
			var tbody=$('<tbody>');
			var tr;
			for(var i=0;i<data.length;++i){
				if(i==0)
					tr=$('<tr class="danger">');
				else
					tr=$('<tr>');
				$(tr).append('<td>'+(i+1)+'</td><td>'+data[i]["first_name"]+' '+data[i]["last_name"]+'</td><td>'+data[i]["score"]+'</td>');
				$(tbody).append(tr);
			}
			$("#scoreTable").html('');
			$("#scoreTable").append(thead);
			$("#scoreTable").append(tbody);
          
	});
}


function replay(){
	window.location.href="./index.php?ctrl=HomeController&action=home";
}


$(document).ready(function(){

	getBestScores();

	window.fbAsyncInit = function() {
        FB.init({
          appId      : '680552975386696',
          xfbml      : true,
          version    : 'v2.3',
          oauth      : true
        });
        
        /*FB.ui({
          method: 'pagetab',
          redirect_uri: 'https://find404.herokuapp.com/'
        }, function(response){});*/
			

      };

	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/fr_FR/sdk.js";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));



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
