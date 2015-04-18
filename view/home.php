

<?php require './view/includes/header.php'; ?>

 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.3&appId=680552975386696";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="container" id="mainContainer">
	<div id="questionBloc" class="row">
		<div id="gameAdvice" class="row">
			<p>
			Observez l'image et trouvez le titre de la publication de la page correspondante
			</p>
      <div class="fb-like" data-href="https://find404.herokuapp.com" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" style="width:132px;"></div>
      <div class="fb-send" data-href="https://find404.herokuapp.com" data-colorscheme="light"></div>
		</div>
		<div id="questionContainer" class="row">
      <div id="questionImage"></div>
      <div id="questionImageContainer">
          <img src="./view/img/frame.png" id="frame"/>
      </div>
			<div id="questionAnswers"></div>
		</div>
		<div class="row" id="buttonContainer">
			<button type="button" class="btn btn-danger col-md-12" id="startGame">Démarrer le jeu</button>
			<button type="button" class="btn btn-danger col-md-12" id="btn_nextQuestion">Suivant</button>
		</div>
	</div>
	<div id="footerBloc" class="row"></div>
</div>











<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">find404</h4>
      </div>
      <div class="modal-body">
      		<div class="row">
      			<div class="col-md-8">
     				<textarea rows="5" cols="50" id="myModal_userComment"></textarea>
     			</div>
     			<div class="col-md-4" id="scoreBox">

     			</div>
     		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="dontPublishScore">Fermer</button>
        <button type="button" class="btn btn-primary" id="publishScore">Publier sur Facebook</button>
      </div>
    </div>
  </div>
</div>

<?php require './view/includes/footer.php'; ?>