<!-- Dark table -->
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
	    <div class="header-body">
            <div class="row">
              <div class="alert alert-danger alert-dismissable" <?=$warning_state1;?> >
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                Echec. Reéssayer!!
              </div>

              <div class="alert alert-warning alert-dismissable" <?=$notSamePassword;?> >
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                Le mot de passe n'est pas identique à la confirmation!!
              </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--7">
  <div class="row mt-5">
    <div class="col">
      <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h2 class="mb-0">Compte Utilisateur</h2>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form role="form" method="post" action="editUser?action=edit&id=<?=$_SESSION['id'];?>">
              
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">Nom : <?=$infos->nom;?></label>
                    </div>
                  </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-username">Prénom(s) : <?=$infos->prenom;?></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Nom d'utilisateur : <?=$infos->username;?></label>
                        </div>
                    </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                    	<label class="form-control-label" for="input-first-name">Droit : <?=$infos->droit;?></label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Changer le mot de passe</label>
                      <input type="password" id="password" name="password" class="form-control form-control-alternative" placeholder="Mot de passe" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-first-name">Confirmer le mot de passe</label>
                      <input type="password" id="passwordConfirmation" name="passwordConfirmation" class="form-control form-control-alternative" placeholder="Mot de passe" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary my-4">Modifier</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>