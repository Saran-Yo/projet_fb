

<?php require './view/includes/header.php'; ?>


<section>
  <div class="jumbotron" style="margin-top:-20px;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-lg-12">
          <h1>Find404</h1>
          <p>Toujours plus amusant, toujours plus intéressant !</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="panel panel-default">
          <div class="panel-heading">A propos de Find404</div>
          <div class="panel-body">
            <h1 class="page-header"><small>Instructions</small></h1>
            <blockquote>
                  Observez l'image puis sélectionnez la phrase qui correspond à l'image, tout simplement !<p> <br/> A vous de jouer !</p>
            </blockquote>
            <h1 class="page-header"><small>Aimez, partagez et envoyez !</small></h1>
            <div id="fb-root"></div>
            <table class="table">
              <tr>
                <td>
                  <div class="fb-like" data-href="https://find404.herokuapp.com/" data-layout="standard" data-action="like" data-show-faces="true" data-share="false" style="width:132px;"></div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="fb-share-button" data-href="https://find404.herokuapp.com/" data-layout="button"></div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="fb-send" data-href="https://find404.herokuapp.com/" data-colorscheme="light"></div>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="panel panel-default" id="tables">
          <div class="panel-heading">Meilleurs scores</div>
            <div class="panel-body">
              <table class="table table-hover" id="scoreTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Score</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="panel panel-default">
            <div class="panel-heading">&nbsp;</div>
            <div class="panel-body" id="questionContainer">
              <div class="row">
                <div class="class=col-lg-6">
                  <div id="questionImage"></div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="class=col-lg-6">
                  <div id="questionAnswers"></div>
                </div>
              </div>
            </div>
            <div class="panel-heading">
              <div class="row" id="buttonContainer">
                <button type="button" class="btn btn-primary col-md-12" id="startGame">Démarrer le jeu</button>
                <button type="button" class="btn btn-primary col-md-12" id="btn_nextQuestion">Suivant</button>
                <button type="button" class="btn btn-primary col-md-12" id="btn_replay">Rejouer</button>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.row-->
    </div>
  </section>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Votre message</h4>
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