
<?php require './view/includes/header.php'; ?>

<div class="container" id="mainContainer">
	<div id="questionBloc">
		<div id="gameAdvice">
			<p>
			Observez l'image et trouvez le titre de la publication de la page correspondante
			</p>
		</div>
		<div id="questionContainer">
			<div id="questionImage"></div>
			<div id="questionAnswers"></div>
		</div>
		<div>
			<button type="button" class="btn btn-danger center-block" id="startGame">Démarrer le jeu</button>
			<button type="button" class="btn btn-danger center-block" id="btn_nextQuestion">Suivant</button>
		</div>
	</div>
	<div id="footerBloc"></div>
</div>

<?php require './view/includes/footer.php'; ?>